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
		$this->name = esc_html__( 'Woo Subcategories', 'fabb-divi-subcategories-module' );
		$this->settings_modal_toggles  = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Subcategories Settings', 'fabb-divi-subcategories-module' ),

				),
			)
		);

		$this->advanced_fields = array(
			'fonts'                 => array(
				'text'   => array(
					'label'           => esc_html__( 'Title', 'fabb-divi-subcategories-module' ),
					'css'             => array(
						'color'       => "{$this->main_css_element} h2.woocommerce-loop-category__title",
						'text-align'       => "{$this->main_css_element} h2.woocommerce-loop-category__title",
					),
					'line_height'     => array(
						'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
					),
					'font_size'       => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug'     => 'text',
					'sub_toggle'      => 'p',
				)

			),
			'background'            => array(
				'settings' => array(
					'color' => 'alpha',
				),
			),
			'margin_padding' => array(
				'css' => array(
					'important' => 'all',
				),
			),
			'text'                  => array(
				'css' => array(
				'main'  => "{$this->main_css_element} h2.woocommerce-loop-category__title",
				),
				'use_background_layout' => true,
				'sub_toggle'  => 'p',
				'options' => array(
					'text_orientation' => array(
						'default'          => 'left',
					),
					'background_layout' => array(
						'default' => 'light',
						'hover'   => 'tabs',
					),
				),
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
					'label'             => esc_html__( 'Show Numbers', 'fabb-divi-subcategories-module' ),
					'type'              => 'yes_no_button',
					'options'           => array(
						'on'  => esc_html__( 'Yes', 'fabb-divi-subcategories-module' ),
						'off' => esc_html__( 'No', 'fabb-divi-subcategories-module' ),
					),
					'toggle_slug'     => 'main_content',
					'default'        => 'off'
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
					'label'             => esc_html__( 'Hide Empty Categories', 'fabb-divi-subcategories-module' ),
					'type'              => 'yes_no_button',
					'options'           => array(
						'off'  => esc_html__( 'No', 'fabb-divi-subcategories-module' ),
						'on' => esc_html__( 'Yes', 'fabb-divi-subcategories-module' ),
					),
					'toggle_slug'     => 'main_content',
					'default'         => 'on'
				)


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

		$hide          = $this->props['hide_empty'] == 'on' ? 1 : 0;
		$hide_empty = "hide_empty=\"{$hide}\" ";
		$columns    = "columns=\"{$this->props['columns']}\" ";

		return "[product_categories ids=\"$id_list\" $hide_empty $columns]";
	}

	public function render( $attrs, $content = null, $render_slug ) {
		return $this->_render_module_wrapper(do_shortcode($this->generate_shortcode()));
	}
}

new FABB_WooSubcategories;
