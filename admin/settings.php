<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

add_action( 'admin_menu', 'cfr_settings_init' );
function cfr_settings_init() {
	add_options_page( __( 'Checkout Freemius Settings', 'checkout-freemius-rewamped' ), __( 'Checkout Freemius', 'checkout-freemius-rewamped' ), 'manage_options', 'checkout-freemius-settings', 'cfr_settings_page' );
}

function cfr_settings_page() {
	$tabs = array(
		'general' => __( 'General', 'checkout-freemius-rewamped' ),
		'help'    => __( 'help', 'checkout-freemius-rewamped' ),
	);
	$tabs = apply_filters( 'cfr_settings_tabs', $tabs );
	if ( isset( $_GET['tab'] ) ) {

		$active_tab = $_GET['tab'];

	} else {
		$active_tab = 'general';
	}
	?>
    <div class="wrap">
        <h2><?php _e( 'Settings', 'checkout-freemius-rewamped' ); ?></h2>
        <!--<div class="description">This is description of the page.</div>-->
		<?php settings_errors(); ?>

        <h2 class="nav-tab-wrapper">
			<?php
			foreach ( $tabs as $tab => $value ) {
				?>
                <a href="<?php echo esc_url( admin_url( 'options-general.php?page=checkout-freemius-settings&tab=' . $tab ) ); ?>"
                   class="nav-tab <?php echo $active_tab === $tab ? 'nav-tab-active' : ''; ?>"><?php echo $value ?></a>
			<?php } ?>
        </h2>

        <form method="post" action="options.php">
			<?php

			switch ( $active_tab ) {
				case 'help':
					settings_fields( 'cfr-help' );
					do_settings_sections( 'cfr-help' );
					break;
				case 'general':
					settings_fields( 'cfr-general' );
					do_settings_sections( 'cfr-general' );
					break;

			}
			submit_button( __( 'Save Changes', 'checkout-freemius-rewamped' ), 'primary', 'cfr_settings' );
			?>
        </form>


    </div>
	<?php
}

add_action( 'admin_init', 'cfr_register_settings' );
function cfr_register_settings() {
	add_settings_section( 'cfr-help', '', 'cfr_help', 'cfr-help' );
	add_settings_section( 'cfr-general', '', '', 'cfr-general' );

	register_setting( 'cfr-help', 'help' );
	register_setting( 'cfr-general', 'cfr-general' );

	add_settings_field( 'cfr-shop-page', __( 'shop page', 'checkout-freemius-rewamped' ), 'cfr_general_shop', 'cfr-general', 'cfr-general' );


}

function cfr_help() { ?>
    <div class="help-block">
        <h3><?php _e( 'Shortcodes', 'checkout-freemius-rewamped' ); ?></h3>
        <div class="help-list">
            <p>[freemius_checkout] <?php _e( 'with their params:', 'checkout-freemius-rewamped' ); ?></p>
            <div class="help-details">
                <p>plugin_id:</p>
                <p>plan_id:</p>
                <p>pricing_id:</p>
                <p>public_key:</p>
                <p>image:</p>
                <p>name:</p>
                <p>button:</p>
                <p>button_id:</p>
                <p>button_class:</p>
            </div>
        </div>
    </div>
	<?php
}

function cfr_general_shop() {
	$shop_pages  = get_pages();
	$cfr_general = get_option( 'cfr-general' );
	?>

    <select name="cfr-general[cfr-shop-page]">
        <option><?php _e( 'Choose your shop page', 'checkout-freemius-rewamped' ); ?></option>
		<?php
		foreach ( $shop_pages as $shop_page ) {
			?>
            <option value="<?php echo $shop_page->ID; ?>" <?php selected( $cfr_general['cfr-shop-page'], $shop_page->ID ); ?>><?php echo $shop_page->post_title; ?></option>
			<?php
		}
		?>
    </select>
	<?php
}