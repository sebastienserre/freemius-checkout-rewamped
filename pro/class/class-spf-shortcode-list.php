<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

/**
 * Class Spf_Shortcode_List
 */
class Spf_Shortcode_List {
	public function __construct() {
		add_shortcode( 'sfs_product_list', array( $this, 'sfspro_sc_product_list' ) );
	}

	public function sfspro_sc_product_list( $atts ) {
		$atts = shortcode_atts(
			array(
				'number'    => 5,
				'thumbnail' => 'true',
				'excerpt'   => 'true',
			),
			$atts,
			'sfs_product_list'
		);

		$args = array(
			'posts_per_page' => intval( $atts['number'] ),
			'post_type'      => 'freemius-cpt',
		);

		$products = new WP_Query( $args );

		ob_start();

		$this->sfspro_sc_render( $atts, $products );
		$html = ob_get_clean();
		wp_reset_postdata();

		return $html;
	}

	public function sfspro_sc_render( $atts, $products ) {

		if ( $products->have_posts() ) {
			while ( $products->have_posts() ) {
				$products->the_post();
				?>
				<div class="sfs_products_list">
					<h3><a href="<?php echo esc_url( get_the_permalink() ); ?>"
					       title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h3>
					<?php
					if ( 'true' === $atts['thumbnail'] && has_post_thumbnail() ) {
						?>
						<div class="freemius_checkout_product_thumbnail">
							<?php echo get_the_post_thumbnail( get_the_ID(), 'post-thumbnail' ); ?>
						</div>
						<?php
					}
					if ( 'true' === $atts['excerpt'] ) {
						?>
						<div class="freemius_checkout_product_excerpt">
							<?php the_excerpt(); ?>
						</div>
						<?php
					}
					?>
					<a href="<?php the_permalink(); ?>"
					   title="<?php the_title(); ?>"><?php _e( 'Read More', 'checkout-freemius-rewamped' ) ?></a>


				<?php
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

							?>
							<div style="clear: both"></div>
							<div class="buy_section">
								<button id="purchase"
								        class="purchase"><?php printf( esc_html__( 'From %d $', 'checkout-freemius-rewamped' ), $price ); ?></button>

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

							</div>
							<?php
						}
					}
				}


			}
		}
		}
}
			new Spf_Shortcode_List();
