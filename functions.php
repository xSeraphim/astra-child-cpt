<?php

function wpr_add_style() {
    wp_enqueue_style('wpr-academy-style', get_stylesheet_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'wpr_add_style');

function wpr_add_nav_sticky() {
    echo '
    <div class="sticky-nav">
	    <a href="tel:+40743078300" class="cta">Contact US NOW</a>
    </div>';
}
add_action('astra_head_top', 'wpr_add_nav_sticky');

//Engineer CPT
function register_engineer_cpt() {
	$taxargs = array(
		'labels' =>	array(
		'name'              => __( 'Role', '' ),
		'singular_name'     => __( 'Role', '' ),
		'search_items'      => __( 'Search Roles', '' ),
		'all_items'         => __( 'All Roles', '' ),
		'parent_item'       => __( 'Parent Role', '' ),
		'parent_item_colon' => __( 'Parent Role:', '' ),
		'edit_item'         => __( 'Edit Role', '' ),
		'update_item'       => __( 'Update Role', '' ),
		'add_new_item'      => __( 'Add new Role', '' ),
		'new_item_name'     => __( 'New Role', '' ),
		),
		'hierarchical'	=> true,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
		'rewrite' => array(
			'slug' => 'role',
		)

	);
	register_taxonomy('role', array('role'), $taxargs);

	$args = array(
		'label'               => __( 'Engineers', '' ),
		'labels'              => array(
			'name'                  => __( 'Engineers', '' ),
			'singular_name'         => __( 'Engineer', '' ),
			'featured_image'        => __( 'Engineer Image', '' ),
			'set_featured_image'    => __( 'Set Engineer Image', '' ),
			'remove_featured_image' => __( 'Remove Engineer Image', '' ),
			'use_featured_image'    => __( 'Use Engineer Image', '' ),
			'add_new_item'          => 'Add new Engineer',
			'add_new'               => 'Add Engineer',
			'edit_item'             => 'Edit Engineer',
			'view_item'             => 'View Engineer',
			'view_items'            => 'View Engineers',
		),
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => true,
		'has_archive'         => true,
		'show_in_menu'        => true,
		'exclude_from_search' => false,
		'map_meta_cap'        => true,
		'hierarchical'        => true,
		'query_var'           => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
		'taxonomies'          => array( 'role' ),
		'menu_position'       => 4,
		'menu_icon'           => 'dashicons-groups',
	);
	register_post_type( 'engineer', $args );

	add_theme_support( 'post-thumbnails', array( 'engineer' ) );

}
add_action( 'init', 'register_engineer_cpt' );

// Software CPT
function register_software_cpt() {
	$taxargs = array(
		'labels' =>	array(
		'name'              => __( 'Country', '' ),
		'singular_name'     => __( 'Country', '' ),
		'search_items'      => __( 'Search Country', '' ),
		'all_items'         => __( 'All Countries', '' ),
		'parent_item'       => __( 'Parent Country', '' ),
		'parent_item_colon' => __( 'Parent Country:', '' ),
		'edit_item'         => __( 'Edit Country', '' ),
		'update_item'       => __( 'Update Country', '' ),
		'add_new_item'      => __( 'Add new Country', '' ),
		'new_item_name'     => __( 'New Country', '' ),
		),
		'hierarchical'	=> true,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
		'rewrite' => array(
			'slug' => 'country',
		)

	);
	register_taxonomy('country', array('country'), $taxargs);

	$args = array(
		'label'               => __( 'Software', '' ),
		'labels'              => array(
			'name'                  => __( 'Software', '' ),
			'singular_name'         => __( 'Software', '' ),
			'featured_image'        => __( 'Software Image', '' ),
			'set_featured_image'    => __( 'Set Software Image', '' ),
			'remove_featured_image' => __( 'Remove Software Image', '' ),
			'use_featured_image'    => __( 'Use Software Image', '' ),
			'add_new_item'          => 'Add new Software',
			'add_new'               => 'Add Software',
			'edit_item'             => 'Edit Software',
			'view_item'             => 'View Software',
			'view_items'            => 'View all Software',
		),
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => true,
		'has_archive'         => true,
		'show_in_menu'        => true,
		'exclude_from_search' => false,
		'map_meta_cap'        => true,
		'hierarchical'        => true,
		'query_var'           => true,
		'supports'            => array( 'title', 'editor', 'custom-fields' ),
		'taxonomies'          => array( 'country' ),
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-shield',
	);
	register_post_type( 'software', $args );


}
add_action( 'init', 'register_software_cpt' );