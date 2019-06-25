<?php

/**
 * Class Freemius_Checkout_Widget
 */
class Freemius_Checkout_Widget_Pro extends WP_Widget {
	public function __construct() {
		$widget_args = array(
			'classname'   => 'Freemius Checkout Widget Pro',
			'description' => __( 'Display your latest products', 'checkout-freemius-rewamped' ),
		);
		parent::__construct(
			'freemius-checkout-widget-pro',
			'Freemius Checkout Widget Pro',
			$widget_args
		);
		add_action( 'widgets_init', array( $this, 'freemius_checkout_init_widget_pro' ) );
	}

	public function freemius_checkout_init_widget_pro() {
		register_widget( 'Freemius_Checkout_Widget_Pro' );
	}

	/**
	 * @param array $instance
	 *
	 * @return string|void
	 */
	public function form( $instance ) {
		?>
		<p>
			<label for="<?php echo esc_html( $this->get_field_name( 'title' ) ); ?>"> <?php esc_attr_e( 'Title:', 'checkout-freemius-rewamped' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			       value="<?php echo $instance['title']; ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_name( 'number' ); ?>"> <?php esc_attr_e( 'number:', 'checkout-freemius-rewamped' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>"
			       name="<?php echo $this->get_field_name( 'number' ); ?>" type="text"
			       value="<?php echo $instance['number']; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_name( 'thumbnail' ); ?>"> <?php esc_attr_e( 'Display Thumbnail:', 'checkout-freemius-rewamped' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'thumbnail' ); ?>"
			       name="<?php echo $this->get_field_name( 'thumbnail' ); ?>" type="checkbox"
			       value="yes" <?php checked( $instance['thumbnail'], 'yes' ) ?>/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_name( 'button' ); ?>"> <?php esc_attr_e( 'Display buy button:', 'checkout-freemius-rewamped' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'button' ); ?>"
			       name="<?php echo $this->get_field_name( 'button' ); ?>" type="checkbox"
			       value="yes" <?php checked( $instance['button'], 'yes' ) ?>/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_name( 'excerpt' ); ?>"> <?php esc_attr_e( 'Display the Excerpt:', 'checkout-freemius-rewamped' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'excerpt' ); ?>"
			       name="<?php echo $this->get_field_name( 'excerpt' ); ?>" type="checkbox"
			       value="yes" <?php checked( $instance['excerpt'], 'yes' ) ?>/>
		</p>


		<?php

	}

	public function widget( $args, $instance ) {

		if ( empty( $instance['number'] ) ) {
			$instance['number'] = 5;
		}

		$args     = array(
			'posts_per_page' => intval( $instance['number'] ),
			'post_type'      => 'freemius-cpt',
		);
		$products = get_posts( $args );

		echo $args['before_widget'];

		echo $args['before_title'];

		echo apply_filters( 'widget_title', $instance['title'] );

		echo $args['after_title'];

		foreach ( $products as $product ) { ?>

			<h3><a href="<?php echo get_the_permalink( $product->ID ); ?>" title="<?php echo get_the_title( $product->ID ); ?>"><?php echo get_the_title( $product->ID ); ?></a></h3>
			<?php
			if ( 'yes' === $instance['thumbnail'] && has_post_thumbnail( $product->ID ) ) {
				?>
				<div class="freemius_checkout_product_thumbnail">
					<?php echo get_the_post_thumbnail( $product->ID, 'post-thumbnail' ); ?>
				</div>
				<?php
			}
			?>
			<?php
			$excerpt = $product->post_excerpt;
			if ( empty( $excerpt ) && ! empty( $product->post_content ) ) {
				$excerpt = wp_trim_words( $product->post_content, 50, '...' );
			}
			if ( 'yes' === $instance['excerpt'] && ! empty( $excerpt ) ) {
				?>
				<div class="freemius_checkout_product_excerpt">
					<a href="<?php echo get_the_permalink( $product->ID ); ?>" title="<?php echo get_the_title( $product->ID ); ?>"><?php echo $excerpt; ?></a>
				</div>
				<?php
			}

			if ( have_rows( 'freemius_checkout_plans', $product->ID ) ) { // flexible
				while ( have_rows( 'freemius_checkout_plans', $product->ID ) ) { //flexible
					the_row();
					if ( 'freemius_checkout_add_new_plans' === get_row_layout() ) {
						$plugin_plan_id = get_sub_field( 'freemius_checkout_plan_id', $product->ID );
						$pricing_id     = get_sub_field( 'freemius_checkout_pricing', $product->ID );
						if ( have_rows( 'freemius_checkout_pricing', $product->ID ) ) {

							$i = 1;
							while ( have_rows( 'freemius_checkout_pricing', $product->ID ) && $i < 2  ) {
								the_row();

								$plugin_id      = get_field( 'freemius_checkout_public_id', $product->ID );
								$plugin_pub_key = get_field( 'freemius_checkout_public_key', $product->ID );
								$price = get_sub_field( 'freemius_checkout_monthly_price', $product->ID );
								if ( empty( $price ) ) {
									$price = get_sub_field( 'freemius_checkout_annual_price', $product->ID );
								} elseif ( empty( get_sub_field( 'freemius_checkout_annual_price', $product->ID ) ) ){
									$price = get_sub_field( 'freemius_checkout_lifetime_price', $product->ID );
								}


								$i ++;
							}
						}

						?>
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
						</div><?php
					}
				}
			}
		}
	}
}

new Freemius_Checkout_Widget_Pro();


