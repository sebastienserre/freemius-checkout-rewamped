<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

add_action( 'admin_menu', 'cfr_settings_init' );
function cfr_settings_init() {
	add_options_page( __( 'Checkout Freemius Settings', DOMAIN ), __( 'Checkout Freemius', DOMAIN ), 'manage_options', 'checkout-freemius-settings', 'cfr_settings_page' );
}

function cfr_settings_page() {
	$tabs = array(
		'help' => __('help', DOMAIN)
	);
	if ( isset( $_GET['tab'] ) ) {

		$active_tab = $_GET['tab'];

	} else {
		$active_tab = 'general';
	}
	?>
	<div class="wrap">
		<h2><?php _e( 'Settings', DOMAIN ); ?></h2>
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
				case 'general':
					settings_fields( 'general' );
					do_settings_sections( 'compare-general' );
					break;
				case 'awin':
					settings_fields( 'awin' );
					do_settings_sections( 'compare-awin' );
					break;
				case 'zanox':
					settings_fields( 'zanox' );
					do_settings_sections( 'compare-zanox' );
					break;
				case 'help':
					settings_fields( 'compare-help' );
					do_settings_sections( 'compare-help' );
					break;
			}
			submit_button( 'Save Changes', 'primary', 'save_compare_settings' );
			?>
		</form>


	</div>
	<?php
}