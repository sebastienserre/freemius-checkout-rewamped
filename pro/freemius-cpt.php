<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

if ( ! function_exists('freemius_cpt') ) {

// Register Custom Post Type
	function freemius_cpt() {

		$labels = array(
			'name'                  => _x( 'Freemius Products', 'Post Type General Name', 'checkout-freemius-rewamped' ),
			'singular_name'         => _x( 'Freemius Product', 'Post Type Singular Name', 'checkout-freemius-rewamped' ),
			'menu_name'             => __( 'Freemius Products', 'checkout-freemius-rewamped' ),
			'name_admin_bar'        => __( 'Freemius Products', 'checkout-freemius-rewamped' ),
			'archives'              => __( 'Freemius Products Archives', 'checkout-freemius-rewamped' ),
			'attributes'            => __( 'Freemius Products Attributes', 'checkout-freemius-rewamped' ),
			'parent_item_colon'     => __( 'Parent Freemius Products:', 'checkout-freemius-rewamped' ),
			'all_items'             => __( 'All Freemius Products', 'checkout-freemius-rewamped' ),
			'add_new_item'          => __( 'Add New Freemius Products', 'checkout-freemius-rewamped' ),
			'add_new'               => __( 'Add New', 'checkout-freemius-rewamped' ),
			'new_item'              => __( 'New Freemius Product', 'checkout-freemius-rewamped' ),
			'edit_item'             => __( 'Edit Freemius Product', 'checkout-freemius-rewamped' ),
			'update_item'           => __( 'Update Freemius Product', 'checkout-freemius-rewamped' ),
			'view_item'             => __( 'View Freemius Product', 'checkout-freemius-rewamped' ),
			'view_items'            => __( 'View Freemius Products', 'checkout-freemius-rewamped' ),
			'search_items'          => __( 'Search Freemius Product', 'checkout-freemius-rewamped' ),
			'not_found'             => __( 'Not found', 'checkout-freemius-rewamped' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'checkout-freemius-rewamped' ),
			'featured_image'        => __( 'Featured Image', 'checkout-freemius-rewamped' ),
			'set_featured_image'    => __( 'Set featured image', 'checkout-freemius-rewamped' ),
			'remove_featured_image' => __( 'Remove featured image', 'checkout-freemius-rewamped' ),
			'use_featured_image'    => __( 'Use as featured image', 'checkout-freemius-rewamped' ),
			'insert_into_item'      => __( 'Insert into Freemius Products', 'checkout-freemius-rewamped' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Freemius Products', 'checkout-freemius-rewamped' ),
			'items_list'            => __( 'Freemius Products list', 'checkout-freemius-rewamped' ),
			'items_list_navigation' => __( 'Freemius Products list navigation', 'checkout-freemius-rewamped' ),
			'filter_items_list'     => __( 'Filter Freemius Products list', 'checkout-freemius-rewamped' ),
		);
		$rewrite = array(
			'slug'                  => 'freemius-product',
			'with_front'            => true,
			'pages'                 => true,
			'feeds'                 => true,
		);
		$args = array(
			'label'                 => __( 'Freemius Product', 'checkout-freemius-rewamped' ),
			'description'           => __( 'List all Freemius Product on your WP Website', 'checkout-freemius-rewamped' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'excerpt', 'author' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-products',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'rewrite'               => $rewrite,
			'capability_type'       => 'page',
			'show_in_rest'          => true,
		);
		register_post_type( 'freemius-cpt', $args );
	}
	add_action( 'init', 'freemius_cpt', 0 );

}