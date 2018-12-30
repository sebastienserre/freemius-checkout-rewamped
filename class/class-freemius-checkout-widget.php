<?php

/**
 * Class Freemius_Checkout_Widget
 */
class Freemius_Checkout_Widget extends WP_Widget {
	public function __construct() {
		$widget_args = array(
			'classname'   => 'Freemius Checkout Widget',
			'description' => __( 'Add a Button Freemius Checkout every where in WordPress', 'checkout-freemius-rewamped' ),
		);
		parent::__construct(
			'freemius-checkout-widget',
			'Freemius Checkout Widget',
			$widget_args
		);
		add_action( 'widgets_init', array( $this, 'freemius_checkout_init_widget' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'freemius_load_script' ) );
	}

	public function freemius_checkout_init_widget() {
		register_widget( 'Freemius_Checkout_Widget' );
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
		<label for="<?php echo esc_html( $this->get_field_name( 'description' ) ); ?>"> <?php esc_attr_e( 'Description:', 'checkout-freemius-rewamped' ); ?>
		</label>
		<textarea class="widefat" id="<?php echo esc_html( $this->get_field_id( 'description' ) ); ?>"
		          name="<?php echo $this->get_field_name( 'description' ); ?>"
		><?php echo esc_html( $instance['description'] ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_name( 'plugin_id' ); ?>"> <?php esc_attr_e( 'plugin_id:', 'checkout-freemius-rewamped' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'plugin_id' ); ?>"
			       name="<?php echo $this->get_field_name( 'plugin_id' ); ?>" type="text"
			       value="<?php echo $instance['plugin_id']; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_name( 'plan_id' ); ?>"> <?php esc_attr_e( 'plan_id:', 'checkout-freemius-rewamped' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'plan_id' ); ?>"
			       name="<?php echo $this->get_field_name( 'plan_id' ); ?>" type="text"
			       value="<?php echo $instance['plan_id']; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_name( 'pricing_id' ); ?>"> <?php esc_attr_e( 'pricing_id:', 'checkout-freemius-rewamped' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'pricing_id' ); ?>"
			       name="<?php echo $this->get_field_name( 'pricing_id' ); ?>" type="text"
			       value="<?php echo $instance['pricing_id']; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_name( 'public_key' ); ?>"> <?php esc_attr_e( 'public_key:', 'checkout-freemius-rewamped' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'public_key' ); ?>"
			       name="<?php echo $this->get_field_name( 'public_key' ); ?>" type="text"
			       value="<?php echo $instance['public_key']; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_name( 'button_text' ); ?>"> <?php esc_attr_e( 'button text:', 'checkout-freemius-rewamped' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>"
			       name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text"
			       value="<?php echo $instance['button_text']; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_name( 'image' ); ?>"> <?php esc_attr_e( 'image:', 'checkout-freemius-rewamped' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>"
			       name="<?php echo $this->get_field_name( 'image' ); ?>" type="text"
			       value="<?php echo $instance['image']; ?>"/>
		</p>

		<?php
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		echo $args['before_title'];

		echo apply_filters( 'widget_title', $instance['title'] );

		echo $args['after_title'];
		if ( ! empty( $instance['description'] ) ) {
			echo '<p>' . $instance['description'] . '</p>';
		}
		?>
		<button id="purchase" class="purchase"><?php echo $instance['button_text']; ?></button>
		<?php
		//wp_enqueue_script('FreemiusJS');

		?>
		<script src="https://checkout.freemius.com/checkout.min.js"></script>
		<script>
            var handler_purchase = FS.Checkout.configure({
				<?php if ( $instance['plugin_id']){ ?>plugin_id: '<?php echo $instance['plugin_id']; }?>',
				<?php if( $instance['plan_id'] ) { ?>plan_id: '<?php echo $instance['plan_id']; } ?>',
				<?php if( $instance['public_key'] ) { ?> public_key: '<?php echo $instance['public_key']; } ?>',
				<?php if ($instance['image'] ){ ?> image: '<?php echo $instance['image']; } ?>',
				<?php if ($instance['pricing_id'] ){ ?>pricing_id: '<?php echo $instance['pricing_id']; } ?>',
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
		<?php

		//echo do_shortcode('[freemius_checkout name="OpenAgenda pour WordPress Pro" plugin_id="2279" plan_id="3475" pricing_id="2592" public_key="pk_ab0021b682585d81e582568095957" button_id="purchase" button="Essayer gratuitement pendant 14 jours" button_class="edd-add-to-cart button blue edd-submit edd-has-js"]');
		//return ob_get_clean();
	}

	public function freemius_load_script() {
		wp_register_script( 'FreemiusJS', 'https://checkout.freemius.com/checkout.min.js', array( 'jquery' ), SFS_VERSION, true );
	}
}

new Freemius_Checkout_Widget();


