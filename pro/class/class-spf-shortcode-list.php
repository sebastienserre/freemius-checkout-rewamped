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

				</div>
<?php
					}
				}


			}
}
			new Spf_Shortcode_List();
