=== Simple Freemius Shop ===
Contributors: sebastienserre
Tags: freemius, checkout, buy button, e-shop, e-commerce, ecommerce, store, sales, sell, shop, cart, downloadable, downloads, digital downloads, wp-ecommerce
Requires at least: 4.6
Tested up to: 5.0
Stable tag: 1.4.1
Requires PHP: 5.6
License: GPLv3
License URI: https://opensource.org/licenses/GPL-3.0

Sell WordPress Plugins & Themes. Anywhere. Using Freemius Checkout "Buy Now" button.

== Description ==

[Freemius](https://freemius.com/) empowers WordPress plugin/theme developers to sell in minutes, helping them create prosperous subscription based businesses.

With [Freemius Checkout](https://freemius.com/wordpress/checkout/) you can sell your digital WordPress products from anywhere.

This plugin allows anyone selling WordPress plugins or themes to embed a "Buy Now" button anywhere in your site using a simple WordPress shortcode.

When embedded, the user will see a simple "Buy Now" button on the front-end. Clicking the button will open the checkout popup.

This Plugin is a fork of the original one [Checkout-Freemius](https://wordpress.org/plugins/checkout-freemius/) which add the possibility to add a button with WordPress Widget.

This plugin has been rewamped to add it a WordPress Widget.** It is now easiest to share your Freemius Products

= Usage =

The plugin uses **[freemius_checkout]** shortcode to embed the "Buy Now" button.

The shortcode is very customizable, to setup a custom product you can use the following attributes:

* **name** - Your plugin/theme name.
* **plugin_id** - Your plugin/theme ID on freemius.
* **plan_id** - The plan you want to promote using the button.
* **pricing_id** - The plan pricing level.
* **public_key** - Plugin/theme public key.
* **image** - The plugin/theme logo URL. Will be displayed in the popup.
* **button** - The text to display on the button. Default is 'Buy Now'.
* **button_id** - The button tag 'ID' attribute. Default is 'purchase'.
* **button_class** - The button tag 'Class' attribute, to add your own styling.

Example:

`[freemius_checkout name="Press Elements" plugin_id="761" plan_id="1078" pricing_id="928" public_key="pk_fe2850d57f7d4f206aefaa106b91f" button_id="purchase" button="Buy Now"]`

**Pro Version**
* The Pro Version add a CPT which allow you to have a post by product and a custom single template.
* New Widget to list your product where ever you want.
* New Shortcode to display your products where ever you want.

Sell Easily your digital Freemius products with WordPress


== Screenshots ==
1. Freemius Checkout

== Frequently Asked Questions ==

= Why is the checkout button not working? =

The theme needs to use jQuery to display the checkout popup. If it doesn't enqueue jQuery, the button won't open the checkout popup.

= How to have all my products in my WordPress Website ?
Only the pro version allow this feature. You'll find (for the moment) a custom post type with a single template (customizable).

== Changelog ==

= 1.4.1 == 14 jan 2019
* add parameter to get_compare_button()

= 1.3.9 == 18 nov 2018
* BUGFIX: Price was not display if no monthly price

= 1.3.8.1 == 30/09/2018
* BUGFIX: correct certains html markup pb.

= 1.3.8 == 29/09/2018
* BUGFIX: Decimal Price are well displayed
* Correct .pot with defined Pro TextDomain
* Correct French Translation

= 1.3.7 == 21/09/2018
* add .pot for Pro version
* add fr_FR translation for Pro

= 1.3.6 = 2nd of september 2018
* add Customer account shortcode

= 1.3.5 = 1st of september 2018
* add option to select shop page (Pro Version)

= 1.3.4 = 16 august 2018
* Fix bug in JS when several buttons in same page (Pro Version)

= 1.3.1/2/3 =
* Test Freemius Upgrade system :-/

=1.3.0 - 14 august 2018 =
* Add a Shortcode

= 1.2.0 - 13 august 2018 =
* Add a Widget

= 1.1 - 12 August 2018 =
* Add the Pro Version
* Re-organize code

= 1.0 =

* Initial release.
* Freemius checkout widget.
