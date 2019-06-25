<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

/**
 * Display Buy Button where ever you want in your theme templates
 * @return mixed|void $button html with button.
 */
function get_compare_button(){
	if ( have_rows( 'freemius_checkout_plans' ) ) { // flexible
		while ( have_rows( 'freemius_checkout_plans' ) ) { //flexible
			the_row();
			if ( 'freemius_checkout_add_new_plans' === get_row_layout() ) {
				$plugin_plan_id = get_sub_field( 'freemius_checkout_plan_id' );
				$pricing_id     = get_sub_field( 'freemius_checkout_pricing' );
				if ( have_rows( 'freemius_checkout_pricing' ) ) {

					$i = 1;
					while ( have_rows( 'freemius_checkout_pricing' ) && $i < 2 ) {
						the_row();

						$plugin_id      = get_field( 'freemius_checkout_public_id' );
						$plugin_pub_key = get_field( 'freemius_checkout_public_key' );
						$monthly_price          = get_sub_field( 'freemius_checkout_monthly_price' );
						$annual_price          = get_sub_field( 'freemius_checkout_annual_price' );
						$lifetime_price          = get_sub_field( 'freemius_checkout_lifetime_price' );
						if ( !empty( $lifetime_price ) ){
							$price = $lifetime_price;
						}
						if ( !empty( $annual_price ) ){
							$price = $annual_price;
						}
						if ( !empty( $monthly_price ) ){
							$price = $monthly_price;
						}

						$i ++;
					}
				}

				ob_start();
				?>
				<div style="clear: both"></div>
				<div class="buy_section">
					<button id="purchase"
					        class="purchase"><?php printf( esc_html__( 'From %s $', 'checkout-freemius-rewamped' ), $price ); ?></button>

					<script src="https://checkout.freemius.com/checkout.min.js"></script>
					<script>
                        var handler_purchase = FS.Checkout.configure({
							<?php if ( ! empty( $plugin_id ) ){ ?>
                            plugin_id: '<?php echo $plugin_id; } ?>',
							<?php if( ! empty( $plugin_plan_id ) ) { ?>
                            plan_id: '<?php echo $plugin_plan_id; } ?>',
							<?php if( ! empty( $plugin_pub_key ) ) { ?>
                            public_key: '<?php echo $plugin_pub_key; } ?>',
							<?php if ( ! empty( $pricing_id ) ){ ?>
                            pricing_id: '<?php echo $pricing_id[0]['freemius_checkout_pricing_id']; } ?>',
                        });

                        jQuery(document).ready(function ($) {
                            $('.purchase').on('click', function (e) {
                                handler_purchase.open({
                                    name: 'Test Product',
                                    licenses: $('#licenses').val(),
                                    // You can consume the response for after purchase logic.
                                    success: function (response) {
                                        alert(response.user.email);
                                    }
                                });
                                e.preventDefault();
                            })
                        });
					</script>
				</div>
				<?php
				$button = ob_get_clean();
			}
		}
	}

	return apply_filters( 'compare-buy-button', $button );
}