<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

add_action( 'admin_menu', 'cfr_settings_init' );
function cfr_settings_init() {
	add_options_page( __( 'Checkout Freemius Settings', 'simple-freemius-shop' ), __( 'Checkout Freemius', 'simple-freemius-shop' ), 'manage_options', 'checkout-freemius-settings', 'cfr_settings_page' );
}

function cfr_settings_page() {
	$tabs = array(
		'help' => __( 'help', 'simple-freemius-shop' )
	);
	$tabs = apply_filters( 'cfr_settings_tabs', $tabs );
	if ( isset( $_GET['tab'] ) ) {

		$active_tab = $_GET['tab'];

	} else {
		$active_tab = 'general';
	}
	?>
	<div class="wrap">
		<h2><?php _e( 'Settings', 'simple-freemius-shop' ); ?></h2>
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

			}
			submit_button( 'Save Changes', 'primary', 'cfr_settings' );
			?>
		</form>


	</div>
	<?php
}

add_action( 'admin_init', 'cfr_register_settings' );
function cfr_register_settings() {
	add_settings_section( 'cfr-help', '', 'cfr_help', 'cfr-help' );

	register_setting( 'cfr-help', 'help' );


}

function cfr_help() {
	echo 'Test';
}