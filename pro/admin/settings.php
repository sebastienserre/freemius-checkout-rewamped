<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

//add_filter( 'cfr_settings_tabs', 'cfr_pro_setings' );
function cfr_pro_setings( $tab ){
	$tab['pro'] = 'Pro';
	return $tab;
}
