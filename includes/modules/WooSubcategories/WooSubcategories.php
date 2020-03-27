<?php

class FABB_WooSubcategories extends ET_Builder_Module {

	public $slug       = 'fabb_woo_subcategories';
	public $vb_support = 'partial';

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 'Fabrizio Mele',
		'author_uri' => 'https://mele.io',
	);

	public function init() {
		$this->name = esc_html__( 'Woo Subcategories', 'fabb-product-subcategories-divi-module-woo' );
		$this->settings_modal_toggles  = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Subcategories Settings', 'fabb-product-subcategories-divi-module-woo' ),

				),
			)
		);

		$this->advanced_fields = array(
			'fonts'                 => array(
				'header'   => array(
					'label'           => esc_html__( 'Title', 'fabb-product-subcategories-divi-module-woo' ),
					'css'             => array(
						'main'       => "{$this->main_css_element} h2.woocommerce-loop-category__title",
						'important'       => "all",
					),
					'header_level'    => array(
						'default'     => 'h2'
					),

				),
				'number'   => array(
					'label'           => esc_html__( 'Number', 'fabb-product-subcategories-divi-module-woo' ),
					'css'             => array(
						'main'       => "{$this->main_css_element} h2.woocommerce-loop-category__title mark",
						'important'       => "all",
					)

				)

			),

			'text_shadow'           => array(
				// Don't add text-shadow fields since they already are via font-options
				'default' => false,
			),
			'button'                => false,
		);

	}

	public function get_fields() {
		return array(
				'show_numbers' => array(
					'label'             => esc_html__( 'Show Numbers', 'fabb-product-subcategories-divi-module-woo' ),
					'type'              => 'yes_no_button',
					'options'           => array(
						'on'  => esc_html__( 'Yes', 'fabb-product-subcategories-divi-module-woo' ),
						'off' => esc_html__( 'No', 'fabb-product-subcategories-divi-module-woo' ),
					),
					'toggle_slug'     => 'main_content',
					'default'        => 'off',
				),
				'columns' => array(
					'label'           => esc_html__( 'Columns', 'dicm-divi-custom-modules' ),
					'type'            => 'range',
					'description'     => esc_html__( 'How many columns to be shown.', 'dicm-divi-custom-modules' ),
					'toggle_slug'     => 'main_content',
					'default'         => 4,
					'range_settings'   => array(
						'min'  => 1,
						'max'  => 6,
						'step' => 1,
					),
					'unitless' => true,
				),
				'hide_empty' => array(
					'label'             => esc_html__( 'Hide Empty Categories', 'fabb-product-subcategories-divi-module-woo' ),
					'type'              => 'yes_no_button',
					'options'           => array(
						'off'  => esc_html__( 'No', 'fabb-product-subcategories-divi-module-woo' ),
						'on' => esc_html__( 'Yes', 'fabb-product-subcategories-divi-module-woo' ),
					),
					'toggle_slug'     => 'main_content',
					'default'         => 'on',
				),
				'mark_background' => array(
					'label'             => esc_html__( 'Number Background', 'fabb-product-subcategories-divi-module-woo' ),
					'type'              => 'color-alpha',
					'toggle_slug'     => 'number',
					'tab_slug'      => 'advanced',

				),


		);
	}
	public function generate_shortcode(){
		global $wp_query;
		$parent_id = $wp_query->get_queried_object()->term_id; //works only when browsing a product category

		$cat_args = array(
			'taxonomy'   => "product_cat",
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => false,
			'parent'     => $parent_id, // set your parent term id
		);
		$child_categories = get_terms($cat_args);
		$id_list="";
		foreach($child_categories as $cc){
			$id = $cc->term_id;
			$id_list.=$id.",";
		}
		$id_list = substr($id_list, 0, -1);
		if ($id_list == "") return "";


		if($this->props['show_numbers'] == 'off'){
			add_filter('woocommerce_subcategory_count_html','__return_false');
		}

		$hide       = $this->props['hide_empty'] == 'on' ? 1 : 0;
		$hide_empty = "hide_empty=\"{$hide}\" ";
		$column_number   = esc_attr($this->props['columns']);
		$columns    = "columns=\"{$column_number}\" ";

		return "[product_categories ids=\"$id_list\" $hide_empty $columns]";
	}

	public function render( $attrs, $content = null, $render_slug ) {

		if ( '' !== $this->props['mark_background'] ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% h2.woocommerce-loop-category__title mark',
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $this->props['mark_background'] )
				),
			) );
		}
		return $this->_render_module_wrapper(do_shortcode($this->generate_shortcode()));
	}
}

new FABB_WooSubcategories;
