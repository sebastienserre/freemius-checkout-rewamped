<?php
/**
 * Plugin Name: Simple Freemius Shop
 * Description: Sell WordPress Plugins & Themes. Anywhere. Using Freemius Checkout "Buy Now" button.
 * Plugin URI:  https://wordpress.org/plugins/checkout-freemius-rewamped/
 * Version:     1.3.6
 * Author:      Sébastien Serre
 * Author URI:  https://thivinfo.com
 * Text Domain: checkout-freemius-rewamped
 *
 * @fs_premium_only /pro/
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Define Constant
 */
define( 'PLUGIN_VERSION', '1.3.6' );
define( 'FREEMIUS_CHECKOUT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'FREEMIUS_CHECKOUT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'FREEMIUS_CHECKOUT_PLUGIN_DIR', untrailingslashit( FREEMIUS_CHECKOUT_PLUGIN_PATH ) );

function freemius_checkout_load_file() {
	include_once plugin_dir_path( __FILE__ ) . '/class/class-freemius-checkout-widget.php';
	include_once plugin_dir_path( __FILE__ ) . '/inc/checkout-freemius-shortcode.php';
	include_once plugin_dir_path( __FILE__ ) . '/admin/settings.php';

	if ( checkout_fs()->is__premium_only() ) {
		include_once plugin_dir_path( __FILE__ ) . '/pro/freemius-cpt.php';
		include_once plugin_dir_path( __FILE__ ) . '/pro/3rd_party/acf/acf.php';
		include_once plugin_dir_path( __FILE__ ) . '/pro/inc/acf-fields.php';
		include_once plugin_dir_path( __FILE__ ) . '/pro/class/class-freemius-checkout-widget-pro.php';
		include_once plugin_dir_path( __FILE__ ) . '/pro/class/class-spf-shortcode-list.php';
		include_once plugin_dir_path( __FILE__ ) . '/pro/admin/settings.php';

		if ( !function_exists( 'fs_members_dashboard_shortcode' ) ) {
			/**
			 * @url https://github.com/Freemius/freemius-users-dashboard/
			 */
			include_once plugin_dir_path( __FILE__ ) . '/pro/3rd_party/freemius-dashboard.php';
		}
	}
}

add_action( 'plugins_loaded', 'freemius_checkout_load_file' );

if ( checkout_fs()->is__premium_only() ) {
	require_once plugin_dir_path( __FILE__ ) . '/pro/freemius-cpt.php';
	require_once plugin_dir_path( __FILE__ ) . '/pro/freemius-checkout-pro-main.php';
}

register_activation_hook( __FILE__, 'freemius_checkout_flush_rewrites' );

function freemius_checkout_flush_rewrites() {
	if ( checkout_fs()->is__premium_only() ) {
		freemius_cpt();
		flush_rewrite_rules();
	}
}

add_action( 'plugins_loaded', 'sfs_pro_load_textdomain__premium_only' );
/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function sfs_pro_load_textdomain__premium_only() {
	load_plugin_textdomain( TEXTDOMAINPRO, false, basename( dirname( __FILE__ ) ) . '/pro/languages' );
}

// Create a helper function for easy SDK access.
function checkout_fs() {
	global $checkout_fs;

	if ( ! isset( $checkout_fs ) ) {
		// Include Freemius SDK.
		require_once dirname(__FILE__) . '/freemius/start.php';

		$checkout_fs = fs_dynamic_init( array(
			'id'                  => '2428',
			'slug'                => 'checkout-freemius-rewamped',
			'type'                => 'plugin',
			'public_key'          => 'pk_b0ac736e083501c3550df85849737',
			'is_premium'          => true,
			'has_addons'          => false,
			'has_paid_plans'      => true,
			'trial'               => array(
				'days'               => 30,
				'is_require_payment' => true,
			),
			'menu'                => array(
				'slug'           => 'checkout-freemius-settings',
				'first-path'     => 'options-general.php?page=checkout-freemius-settings-pricing',
				'contact'        => false,
				'parent'         => array(
					'slug' => 'options-general.php',
				),
			),
			// Set the SDK to work in a sandbox mode (for development & testing).
			// IMPORTANT: MAKE SURE TO REMOVE SECRET KEY BEFORE DEPLOYMENT.
			'secret_key'          => 'sk_)P2{<eocvgw-6;<W%We>p{ZtT9f_O',
		) );
	}

	return $checkout_fs;
}

// Init Freemius.
checkout_fs();
// Signal that SDK was initiated.
do_action( 'checkout_fs_loaded' );

add_filter('acf/settings/path', 'freemius_checkout_acf_settings_path__premium_only');

function freemius_checkout_acf_settings_path__premium_only( $path ) {

	// update path
	$path = FREEMIUS_CHECKOUT_PLUGIN_PATH . '/pro/3rd_party/acf/';

	// return
	return $path;

}

add_filter('acf/settings/dir', 'freemius_checkout_acf_settings_dir__premium_only');

function freemius_checkout_acf_settings_dir__premium_only( $dir ) {

	// update path
	$dir = FREEMIUS_CHECKOUT_PLUGIN_URL . '/pro/3rd_party/acf/';

	// return
	return $dir;

}

add_action( 'plugins_loaded', 'freemius_checkout_hide_acf__premium_only');
function freemius_checkout_hide_acf__premium_only(){
	add_filter('acf/settings/show_admin', '__return_false');
}

add_action('wp_enqueue_scripts', 'freemius_checkout_pro_css__premium_only');
function freemius_checkout_pro_css__premium_only(){
	wp_enqueue_style('freemius-checkout-pro', FREEMIUS_CHECKOUT_PLUGIN_URL . 'pro/assets/css/freemius-checkout-pro.css');
}
