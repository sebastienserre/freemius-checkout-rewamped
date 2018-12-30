<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

/**
 * Add Freemius Checkout Shortcode
 *
 * Register a new shortcode displaying the Freemius buy button.
 *
 * @since 1.0
 */
function freemius_checkout_shortcode( $atts ) {

	$atts = shortcode_atts(
		array(
			'plugin_id'    => '',
			'plan_id'      => '',
			'pricing_id'   => '',
			'public_key'   => '',
			'image'        => '',
			'name'         => '',
			'button'       => esc_html__( 'Buy Now', 'checkout-freemius-rewamped' ),
			'button_id'    => 'purchase',
			'button_class' => '',
		),
		$atts,
		'freemius_checkout'
	);

	ob_start();
	?>
	<button id="<?php echo esc_attr( $atts['button_id'] ); ?>"
	        class="<?php echo esc_attr( $atts['button_class'] ); ?>"><?php echo $atts['button']; ?></button>
	<script src="https://checkout.freemius.com/checkout.min.js"></script>
	<script>
        (function () {
            var handler_<?php echo esc_attr( $atts['button_id'] ); ?> = FS.Checkout.configure({
				<?php
				if ( $atts['plugin_id'] ) {
					printf( 'plugin_id: %s, ', $atts['plugin_id'] );
				}
				if ( $atts['plan_id'] ) {
					printf( 'plan_id: %s, ', $atts['plan_id'] );
				}
				if ( $atts['pricing_id'] ) {
					printf( 'pricing_id: %s, ', $atts['pricing_id'] );
				}
				if ( $atts['public_key'] ) {
					printf( 'public_key: "%s", ', $atts['public_key'] );
				}
				if ( $atts['image'] ) {
					printf( 'image: "%s", ', $atts['image'] );
				}
				?>

            });

            jQuery('#<?php echo esc_attr( $atts['button_id'] ); ?>').on('click', function (e) {
                handler_<?php echo esc_attr( $atts['button_id'] ); ?>.open({
                    name: '<?php echo $atts['name']; ?>',
                    success: function (response) {
                        //alert( response.user.email );
                    }
                });
                e.preventDefault();
            });
        })();
	</script>
	<?php
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'freemius_checkout', 'freemius_checkout_shortcode' );