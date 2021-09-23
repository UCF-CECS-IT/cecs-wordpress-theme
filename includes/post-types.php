<?php

/**
 * 
 * All custom post types are listed out within this file.
 * 
 * Current additions are:
 * 
 * 		Faculty
 * 		Gallery
 * 		Scholarship
 * 		In The News	
 * 		Faculty Showcase
 */

/**
 * Creates custom post type for recording/displaying faculty info
 *
 * @return void
 */
function faculty_post_type() {

	$labels = array(
		'name'                  => _x( 'Faculty', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Faculty', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Faculty', 'text_domain' ),
		'name_admin_bar'        => __( 'Faculty', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Faculty', 'text_domain' ),
		'taxonomies' 			=> array( 'letter' ),
		'labels'                => $labels,
		'menu_position'     	=> 5,
		'public'            	=> true,
		'has_archive'       	=> true,
		'supports'          	=> array('title', 'thumbnail', 'revisions')
	);
	register_post_type('faculty', $args);

	$expertiseLabels = array(
		'name'                          => 'Expertise',
        'all_items'                     => 'All Areas of Expertise',
        'edit_item'                     => 'Edit Expertise',
        'view_item'                     => 'View Expertise',
        'update_item'                   => 'Update Expertise',
        'add_new_item'                  => 'Add new Expertise',
        'new_item_name'                 => 'New Expertise',
        'search_items'                  => 'Search Areas of Expertise',
        'popular_items'                 => 'Common Areas of Expertise',
        'separate_items_with_commas'    => 'Separate areas of expertise with commas',
        'add_or_remove_items'           => 'Add or remove Areas of Expertise',
        'choose_from_most_used'         => 'Choose from common Areas of Expertise',
        'not_found'                     => 'No areas of expertise found'
	);

	$expertiseArgs = array(
		'hierarchical'          => false,
		'labels'                => $expertiseLabels,
		'show_admin_column' => true
	);

	register_taxonomy('expertise', 'faculty', $expertiseArgs);

	$letterArgs = [
		'labels'            => array(
			'name'                          => 'Letter',
		),
		'show_admin_column' => false,
		'show_ui'           => false,
		'show_in_nav_menus' => false,
		'meta_box_cb'       => false
	];

	register_taxonomy('letter', 'faculty', $letterArgs);

}
add_action( 'init', 'faculty_post_type', 0 );

/**
 * Creates a custom post for displaying photo gallery pages.
 *
 * @return void
 */
function gallery_post_type() {

	$galleryArgs = [
		'labels'            => array(
			'name'              => __( 'Gallery' ),
			'singular_name'     => __( 'Gallery' )
		),
		'menu_position'     => 5,
		'public'            => true,
		'has_archive'       => true,
		'supports'          => array('title', 'thumbnail', 'revisions', 'editor')
	];

	register_post_type('gallery', $galleryArgs);
}
add_action( 'init', 'gallery_post_type', 0 );

/**
 * Creates a custom post for scholarships
 *
 * @return void
 */
function scholarship_post_type() {
	$labels = array(
		'name'                  => _x( 'Scholarship', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Scholarship', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Scholarship', 'text_domain' ),
		'name_admin_bar'        => __( 'Scholarship', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Scholarship', 'text_domain' ),
		'labels'                => $labels,
		'menu_position'     	=> 5,
		'public'            	=> true,
		'has_archive'       	=> true,
		'supports'          	=> array('title', 'thumbnail', 'revisions')
	);

	register_post_type('scholarship', $args);
}
add_action( 'init', 'scholarship_post_type', 0 );

/**
 * Creates a custom post type for news items mentioning CECS
 *
 * @return void
 */
function in_the_news_post_type() {
    register_post_type( 'in-the-news',
        array(
            'labels' => array(
                'name' => __( 'In The News' ),
                'singular_name' => __( 'In The News' )
			),
			'menu_position'     	=> 5,
            'public' => true,
            'has_archive' => true,
            'supports' => array( 'title', 'editor', 'thumbnail' ),
        )
    );
}
add_action( 'init', 'in_the_news_post_type', 0 );

/**
 * Creates a custom post type for the faculty showcase
 *
 * @return void
 */
function faculty_showcase_post_type() {
	register_post_type( 'faculty-showcase',
		array(
			'labels'            => array(
				'name'              => __( 'Faculty Showcase' ),
				'singular_name'     => __( 'Faculty Showcase' )
			),
			'menu_position'     => 6,
			'public'            => true,
			'has_archive'       => true,
			'supports'          => array('title', 'thumbnail', 'revisions', 'custom-fields')
		)
	);

	$deptArgs = [
		'labels'            => array(
			'name'                          => 'Department',
			'all_items'                     => 'All Departments',
			'edit_item'                     => 'Edit Department',
			'view_item'                     => 'View Department',
			'update_item'                   => 'Update Department',
			'add_new_item'                  => 'Add new Department',
			'new_item_name'                 => 'New Department',
			'search_items'                  => 'Search Departments',
			'popular_items'                 => 'Common Departments',
			'separate_items_with_commas'    => 'Separate departments with commas',
			'add_or_remove_items'           => 'Add or remove departments',
			'choose_from_most_used'         => 'Choose from common departments',
			'not_found'                     => 'No department found'
		),
		'show_admin_column' => true,
		'show_ui' => false
	];

	register_taxonomy('department', 'faculty-showcase', $deptArgs);
}
add_action( 'init', 'faculty_showcase_post_type', 0 );

/**
 * Creates a custom post for displaying photo gallery pages.
 *
 * @return void
 */
function announcement_post_type() {

	$announcementArgs = [
		'labels'            => array(
			'name'              => __( 'Announcement' ),
			'singular_name'     => __( 'Announcement' )
		),
		'menu_position'     => 5,
		'public'            => true,
		'has_archive'       => true,
		'supports'          => array('title', 'thumbnail', 'revisions', 'editor')
	];

	register_post_type('announcement', $announcementArgs);
}
add_action( 'init', 'announcement_post_type', 0 );