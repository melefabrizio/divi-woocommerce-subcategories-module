# Product Subcategories Module for Divi and Woocommerce

**Warning: This plugin is unmantained. Feel free to fork & improve it.**

This is an extension plugin for Divi Builder by Elegant Themes and Woocommerce.

This plugin allows you to show dynamical product subcategories inside Divi Theme Builder Templates as a module:
tldr: you can place the [`[product_categories]` Woocommerce shortcode](https://docs.woocommerce.com/document/woocommerce-shortcodes/#section-13)
in any product archive page and make it refer to the current category.

### Features
* Add `[product_categories]` as a Divi module dynamically setting the
`ids` parameter to the current page's children categories
* **Options available**: number of columns, show or hide category count, show or hide
empty categories.
* **Styling**: yes, you can style almost every aspect of the text shown by the shortcode,
even the product count background color.

### Installing

As with any Wordpress plugin, download and install the latest zip from the [releases tab](https://github.com/melefabrizio/divi-woocommerce-subcategories-module/releases),
if you want you can clone this repo and adapt to your liking! It is based on [create-divi-extension](https://github.com/elegantthemes/create-divi-extension) so take
a look at that to get it running and building.

Licensed under MIT License.

### Questions?

The plugin's working is pretty straightforward: as said before it displays `[product_categories parent=$current_page_wc_category]`, where `$current_page_wc_category` is the wocommerce category id of the current page/product. 

If you have other questions please open an issue on this repo, I probably won't answer on requests by email or social networks.
