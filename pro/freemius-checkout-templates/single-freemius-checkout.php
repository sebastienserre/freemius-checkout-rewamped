<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

get_header();
?>

	<!-- copy from here -->
	<div class='freemius_checkout_main_content'>
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();


				?>
				<div class="freemius_checkout_thumbnail">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail();
					}
					?>
				</div>
				<div class="freemius_checkout_content">
					<h3><?php the_title(); ?></h3>
					<?php
					the_content();
					?>
				</div>
				<div class="freemius_checkout_price_section">
					<?php
					if ( have_rows( 'freemius_checkout_plans' ) ) { // flexible
						while ( have_rows( 'freemius_checkout_plans' ) ) { //flexible
							the_row();
							if ( 'freemius_checkout_add_new_plans' === get_row_layout() ) {
								$plugin_plan_id = get_sub_field( 'freemius_checkout_plan_id' );
								$pricing_id     = get_sub_field( 'freemius_checkout_pricing' );

								if ( have_rows( 'freemius_checkout_pricing' ) ) {

									while ( have_rows( 'freemius_checkout_pricing' ) ) {
										the_row();
										$plugin_id      = get_field( 'freemius_checkout_public_id' );
										$plugin_pub_key = get_field( 'freemius_checkout_public_key' );

										?>
										<div class="freemius_checkout_plan">
											<div class="freemius_checkout_plan_details freemius_checkout_title">
												<?php if ( ! empty( get_sub_field( 'freemius_checkout_name' ) ) ) { ?>
													<h4><?php the_sub_field( 'freemius_checkout_name' ); ?></h4>
												<?php } ?>
												<?php
												if ( ! empty( get_sub_field( 'freemius_checkout_trial' ) ) ) {
												$trial = get_sub_field( 'freemius_checkout_trial' );
												?>
												<p><?php printf( esc_html__( '%d days trial', 'checkout-freemius-rewamped' ), $trial ); ?></p>
											</div>
											<?php } ?>
											<div class="freemius_checkout_plan_details freemius_checkout_price">
												<?php
												if ( ! empty( get_sub_field( 'freemius_checkout_monthly_price' ) ) ) {
													?>
													<div class="freemius_checkout_price_block">
														<h4><?php _e( 'Monthly Price', 'checkout-freemius-rewamped' ); ?></h4>
														<p><?php the_sub_field( 'freemius_checkout_monthly_price' ); ?>
															€</p>
													</div>
													<?php
												}
												if ( ! empty( get_sub_field( 'freemius_checkout_annual_price' ) ) ) {
													?>
													<div class="freemius_checkout_price_block">
														<h4><?php _e( 'Annual Price', 'checkout-freemius-rewamped' ); ?></h4>
														<p><?php the_sub_field( 'freemius_checkout_annual_price' ); ?>
															€</p>
													</div>
													<?php
												}
												if ( ! empty( get_sub_field( 'freemius_checkout_lifetime_price' ) ) ) {
													?>
													<div class="freemius_checkout_price_block">
														<h4><?php _e( 'Lifetime Price', 'checkout-freemius-rewamped' ); ?></h4>
														<p><?php the_sub_field( 'freemius_checkout_lifetime_price' ); ?>
															$</p>
													</div>
													<?php
												}
												?>
											</div>
											<!-- Freemius Button Script -->
											<button id="purchase"
											        class="purchase freemius-checkout-purchase"><?php _e( 'Buy it!', 'checkout-freemius-rewamped' ) ?></button>
											<?php

											?>
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
                                                    pricing_id: '<?php echo $pricing_id; } ?>',
                                                    currency: 'eur',
                                                });
											</script>

											<!-- Freemius Button Script -->
										</div>
										<?php
									}
								}
							}
						}
						?>
																	<script>
                                                jQuery(document).ready(function ($) {
                                                    $('.purchase').on('click', function (e) {
                                                        handler_purchase.open({
                                                            name: 'Test Product',
                                                            licenses: $('#licenses').val(3),
                                                            // You can consume the response for after purchase logic.
                                                            success: function (response) {
                                                                alert(response.user.email);
                                                            }
                                                        });
                                                        e.preventDefault();
                                                    })
                                                });
											</script>
						<?php
					}
					?>
				</div>
				<?php
			}
		}
		?>
	</div>
	<!-- To here -->
<?php
get_footer();
