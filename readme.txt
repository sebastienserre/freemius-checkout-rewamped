=== Freemius Checkout Rewamped ===
Contributors: sebastienserre
Tags: freemius, checkout, buy button
Requires at least: 4.0
Tested up to: 4.9
Stable tag: 1.1.1
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


**This plugin has been rewamped to add it a WordPress Widget.** It is now easiest to share your Freemius Products
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
* The Pro Version add une CPT which allow you to have a post by product, a custom single template.

Sell Easily your digital Freemius products with WordPress


== Screenshots ==
1. Freemius Checkout

== Frequently Asked Questions ==

= Why is the checkout button not working? =

The theme needs to use jQuery to display the checkout popup. If it doesn't enqueue jQuery, the button won't open the checkout popup.

= What are the plugin requirements? =

**Minimum Requirements**

* WordPress version 4.0 or greater.
* PHP version 5.6 or greater.
* MySQL version 5.0 or greater.

**Recommended Requirements**

* The latest WordPress version.
* The latest PHP version.
* MySQL version 5.7 or greater.

== Changelog ==

= 1.1 - 12 August 2018 =
* Add the Pro Version
* Re-organize code

= 1.0 =

* Initial release.
* Freemius checkout widget.
