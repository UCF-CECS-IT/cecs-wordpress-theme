<?php 

/**
 * Registers staff spotlight CPT
 *
 * @since 1.0.27
 */
function cecs_register_staff_spotlight_post_type() {
	$singular = 'Staff Spotlight';
	$plural = 'Staff Spotlights';
	$taxonomies = array(
		'post_tag',
		'category',
	);
	$icon = 'dashicons-awards';

	$labels = array(
		'name'                  => _x( $plural, 'Post Type General Name', 'cecs-theme' ),
		'singular_name'         => _x( $singular, 'Post Type Singular Name', 'cecs-theme' ),
		'menu_name'             => __( $plural, 'cecs-theme' ),
		'name_admin_bar'        => __( $singular, 'cecs-theme' ),
		'archives'              => __( $plural . ' Archives', 'cecs-theme' ),
		'parent_item_colon'     => __( 'Parent ' . $singular . ':', 'cecs-theme' ),
		'all_items'             => __( 'All ' . $plural, 'cecs-theme' ),
		'add_new_item'          => __( 'Add New ' . $singular, 'cecs-theme' ),
		'add_new'               => __( 'Add New', 'cecs-theme' ),
		'new_item'              => __( 'New ' . $singular, 'cecs-theme' ),
		'edit_item'             => __( 'Edit ' . $singular, 'cecs-theme' ),
		'update_item'           => __( 'Update ' . $singular, 'cecs-theme' ),
		'view_item'             => __( 'View ' . $singular, 'cecs-theme' ),
		'search_items'          => __( 'Search ' . $plural, 'cecs-theme' ),
		'not_found'             => __( 'Not found', 'cecs-theme' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'cecs-theme' ),
		'featured_image'        => __( 'Featured Image', 'cecs-theme' ),
		'set_featured_image'    => __( 'Set featured image', 'cecs-theme' ),
		'remove_featured_image' => __( 'Remove featured image', 'cecs-theme' ),
		'use_featured_image'    => __( 'Use as featured image', 'cecs-theme' ),
		'insert_into_item'      => __( 'Insert into ' . $singular, 'cecs-theme' ),
		'uploaded_to_this_item' => __( 'Uploaded to this ' . $singular, 'cecs-theme' ),
		'items_list'            => __( $plural . ' list', 'cecs-theme' ),
		'items_list_navigation' => __( $plural . ' list navigation', 'cecs-theme' ),
		'filter_items_list'     => __( 'Filter ' . $plural . ' list', 'cecs-theme' ),
	);

	$args = array(
		'label'                 => __( $plural, 'cecs-theme' ),
		'description'           => __( $plural, 'cecs-theme' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', ),
		'taxonomies'            => $taxonomies,
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
		'menu_icon'             => $icon,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);

	register_post_type( 'staff-spotlight', $args );
}

add_action( 'init', 'cecs_register_staff_spotlight_post_type', 0 );