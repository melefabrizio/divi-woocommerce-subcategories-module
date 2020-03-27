<?php

class FABB_DiviSubcategoriesModule extends DiviExtension {

	/**
	 * The gettext domain for the extension's translations.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $gettext_domain = 'fabb-product-subcategories-divi-module-woo';

	/**
	 * The extension's WP Plugin name.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $name = 'product-subcategories-divi-module-woo';

	/**
	 * The extension's version
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * FABB_DiviSubcategoriesModule constructor.
	 *
	 * @param string $name
	 * @param array  $args
	 */
	public function __construct( $name = 'product-subcategories-divi-module-woo', $args = array() ) {
		$this->plugin_dir     = plugin_dir_path( __FILE__ );
		$this->plugin_dir_url = plugin_dir_url( $this->plugin_dir );

		parent::__construct( $name, $args );
	}
}

new FABB_DiviSubcategoriesModule;
