<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.

if ( ! function_exists( 'freemius_cpt' ) ) {

// Register Custom Post Type
	function freemius_cpt() {

		$labels  = array(
			'name'                  => _x( 'Freemius Products', 'Post Type General Name', 'checkout-freemius-rewamped-pro' ),
			'singular_name'         => _x( 'Freemius Product', 'Post Type Singular Name', 'checkout-freemius-rewamped-pro' ),
			'menu_name'             => __( 'Freemius Products', 'checkout-freemius-rewamped-pro' ),
			'name_admin_bar'        => __( 'Freemius Products', 'checkout-freemius-rewamped-pro' ),
			'archives'              => __( 'Freemius Products Archives', 'checkout-freemius-rewamped-pro' ),
			'attributes'            => __( 'Freemius Products Attributes', 'checkout-freemius-rewamped-pro' ),
			'parent_item_colon'     => __( 'Parent Freemius Products:', 'checkout-freemius-rewamped-pro' ),
			'all_items'             => __( 'All Freemius Products', 'checkout-freemius-rewamped-pro' ),
			'add_new_item'          => __( 'Add New Freemius Products', 'checkout-freemius-rewamped-pro' ),
			'add_new'               => __( 'Add New', 'checkout-freemius-rewamped-pro' ),
			'new_item'              => __( 'New Freemius Product', 'checkout-freemius-rewamped-pro' ),
			'edit_item'             => __( 'Edit Freemius Product', 'checkout-freemius-rewamped-pro' ),
			'update_item'           => __( 'Update Freemius Product', 'checkout-freemius-rewamped-pro' ),
			'view_item'             => __( 'View Freemius Product', 'checkout-freemius-rewamped-pro' ),
			'view_items'            => __( 'View Freemius Products', 'checkout-freemius-rewamped-pro' ),
			'search_items'          => __( 'Search Freemius Product', 'checkout-freemius-rewamped-pro' ),
			'not_found'             => __( 'Not found', 'checkout-freemius-rewamped-pro' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'checkout-freemius-rewamped-pro' ),
			'featured_image'        => __( 'Featured Image', 'checkout-freemius-rewamped-pro' ),
			'set_featured_image'    => __( 'Set featured image', 'checkout-freemius-rewamped-pro' ),
			'remove_featured_image' => __( 'Remove featured image', 'checkout-freemius-rewamped-pro' ),
			'use_featured_image'    => __( 'Use as featured image', 'checkout-freemius-rewamped-pro' ),
			'insert_into_item'      => __( 'Insert into Freemius Products', 'checkout-freemius-rewamped-pro' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Freemius Products', 'checkout-freemius-rewamped-pro' ),
			'items_list'            => __( 'Freemius Products list', 'checkout-freemius-rewamped-pro' ),
			'items_list_navigation' => __( 'Freemius Products list navigation', 'checkout-freemius-rewamped-pro' ),
			'filter_items_list'     => __( 'Filter Freemius Products list', 'checkout-freemius-rewamped-pro' ),
		);
		$rewrite = array(
			'slug'       => 'freemius-product',
			'with_front' => true,
			'pages'      => true,
			'feeds'      => true,
		);
		$args    = array(
			'label'               => __( 'Freemius Product', 'checkout-freemius-rewamped-pro' ),
			'description'         => __( 'List all Freemius Product on your WP Website', 'checkout-freemius-rewamped-pro' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'excerpt', 'author' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-products',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
			'show_in_rest'        => true,
		);
		register_post_type( 'freemius-cpt', $args );
	}

	add_action( 'init', 'freemius_cpt', 0 );

}