<?php
define( 'UCFWP_THEME_DIR', trailingslashit( get_template_directory() ) );


// Deprecated functions
include_once UCFWP_THEME_DIR . 'includes/deprecated.php';

// Activation checks
include_once UCFWP_THEME_DIR . 'includes/activate.php';

// Theme foundation
include_once UCFWP_THEME_DIR . 'includes/utilities.php';
include_once UCFWP_THEME_DIR . 'includes/config.php';
include_once UCFWP_THEME_DIR . 'includes/meta.php';
include_once UCFWP_THEME_DIR . 'includes/galleries.php';
include_once UCFWP_THEME_DIR . 'includes/media-backgrounds.php';
include_once UCFWP_THEME_DIR . 'includes/nav-functions.php';
include_once UCFWP_THEME_DIR . 'includes/header-functions.php';
include_once UCFWP_THEME_DIR . 'includes/footer-functions.php';
include_once UCFWP_THEME_DIR . 'includes/pagination-functions.php';

// Custom 
include_once UCFWP_THEME_DIR . 'includes/CECS.php';

// Custom Post Type
include_once UCFWP_THEME_DIR . 'includes/post-types.php';
include_once UCFWP_THEME_DIR . 'includes/staff-spotlight.php';

// Custom Functions
include_once UCFWP_THEME_DIR . 'includes/faculty.php';
include_once UCFWP_THEME_DIR . 'includes/kmdg-translation.php';
include_once UCFWP_THEME_DIR . 'includes/news.php';
include_once UCFWP_THEME_DIR . 'includes/in-the-news.php';
include_once UCFWP_THEME_DIR . 'includes/faculty-showcase.php';

// Plugin extras/overrides

if ( class_exists( 'UCF_People_PostType' ) ) {
	include_once UCFWP_THEME_DIR . 'includes/person-functions.php';
}

if ( class_exists( 'UCF_Section_Common' ) ) {
	include_once UCFWP_THEME_DIR . 'includes/section-functions.php';
}

if ( class_exists( 'UCF_Alert_Common' ) ) {
	include_once UCFWP_THEME_DIR . 'includes/ucf-alert-functions.php';
}

if ( class_exists( 'UCF_Pegasus_List_Common' ) ) {
	include_once UCFWP_THEME_DIR . 'includes/pegasus-list-functions.php';
}

if ( class_exists( 'UCF_Events_Common' ) ) {
	include_once UCFWP_THEME_DIR . 'includes/events-functions.php';
}

if ( class_exists( 'UCF_Acad_Cal_Common' ) ) {
	include_once UCFWP_THEME_DIR . 'includes/acad-cal-functions.php';
}

if ( class_exists( 'UCF_Post_List_Common' ) ) {
	include_once UCFWP_THEME_DIR . 'includes/post-list-functions.php';
	include_once UCFWP_THEME_DIR . 'includes/custom-plugin-layouts.php';
	include_once UCFWP_THEME_DIR . 'includes/gallery-post-list-layout.php';
	include_once UCFWP_THEME_DIR . 'includes/staff-spotlight-post-list-layout.php';
}

add_filter( 'http_request_host_is_external', '__return_true' );