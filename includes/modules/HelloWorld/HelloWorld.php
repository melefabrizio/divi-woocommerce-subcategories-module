<?php

class FABB_HelloWorld extends ET_Builder_Module {

	public $slug       = 'fabb_hello_world';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 'Fabrizio Mele',
		'author_uri' => 'https://mele.io',
	);

	public function init() {
		$this->name = esc_html__( 'Hello World', 'fabb-divi-subcategories-module' );
	}

	public function get_fields() {
		return array(
			'content' => array(
				'label'           => esc_html__( 'Content', 'fabb-divi-subcategories-module' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear inside the module.', 'fabb-divi-subcategories-module' ),
				'toggle_slug'     => 'main_content',
			),
		);
	}

	public function render( $attrs, $content = null, $render_slug ) {
		return sprintf( '<h1>%1$s</h1>', $this->props['content'] );
	}
}

new FABB_HelloWorld;
