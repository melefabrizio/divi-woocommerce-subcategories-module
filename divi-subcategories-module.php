<?php
/*
Plugin Name: Woocommerce Subcategories Module for Divi
Plugin URI:  https://github.com/melefabrizio/divi-woocommerce-subcategories-module
Description: Place your Woocommerce subcategories dynamically as a Divi Module
Version:     1.0
Author:      Fabrizio Mele
Author URI:  https://mele.io
License:     MIT
License URI: https://spdx.org/licenses/MIT.html
Text Domain: fabb-divi-subcategories-module
Domain Path: /languages

MIT License

Copyright (c) 2020 Fabrizio Mele

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/


if ( ! function_exists( 'fabb_initialize_extension' ) ):
/**
 * Creates the extension's main class instance.
 *
 * @since 1.0.0
 */
function fabb_initialize_extension() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/DiviSubcategoriesModule.php';
}
add_action( 'divi_extensions_init', 'fabb_initialize_extension' );
endif;
