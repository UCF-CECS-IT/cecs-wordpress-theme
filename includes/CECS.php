<?php

/**
 * Removes the auto tagging because that is an irritating feature.
 */
// remove_filter ('the_content', 'wpautop'); 

function cecs_get_subnav_markup() {
    get_template_part( ucfwp_get_template_part_slug( 'nav' ), 'sub' );
    $retval = trim( ob_get_clean() );

    return apply_filters( 'cecs_get_subnav_markup', $retval );
}

/**
 * Registers a new Wordpress menu to call in the subnav args
 *
 * @return void
 */
function register_my_menus() {
    register_nav_menus(
      array(
        // 'header-menu' => __( 'Header Menu' ),
        'sub-menu' => __( 'Sub Menu' )
       )
    );
}
add_action( 'init', 'register_my_menus' );

/**
 * Loads page- or template-specific scripts for the CECS theme
 *
 * @return void
 */
function load_cecs_scripts() {
    // global $post;

    if ( get_page_template_slug() == 'page-templates/page-builder.php' ) {
        wp_enqueue_script( 'builder', get_template_directory_uri() . '/static/js/builder.js' );
    }

    if ( is_archive() && get_post_type() == 'faculty-showcase' ) {
        wp_enqueue_script( 'showcase-filter', get_template_directory_uri() . '/static/js/showcase-filter.js' );
    }

    // Required for all pages


    // if ( is_page() || is_single() )
    // {
    //     post_name is the post slug which is more consistent for matching to here
    //     switch($post->post_name) 
    //     {
    //         case 'home':
    //             wp_enqueue_script('home', get_template_directory_uri() . '/js/home.js', array('jquery'), '', false);
    //             break;
    //     }
    // } 
}
add_action( 'wp_enqueue_scripts', 'load_cecs_scripts' );

/**
 * Sets the search page query to return 12 posts by default to ensure even
 * rows of cards. Also excludes the home page from results.
 *
 * @param WP_Query $query
 * @return WP_Query
 */
function limit_search( $query ) {
 
    if ( $query->is_search && ! is_admin() ) {
        $query->set( 'post_type', array( 'post','page' ) );

        $query->set( 'posts_per_page', 12 );

        //Exclude posts by ID
        $post_ids = array(
            73, // Home page
        );
        $query->set( 'post__not_in', $post_ids );
    }
 
    return $query;
} 
add_filter( 'pre_get_posts', 'limit_search' );

/**
 * Generates the default <picture> tag contents used as a fallback in most
 * header templates. Currently one mobile and one desktop version provided.
 *
 * @return void
 */
function cecs_fallback_media() {
    $full = get_stylesheet_directory_uri() . '/static/img/fallback.jpg';
    $mobile = get_stylesheet_directory_uri() . '/static/img/fallback-mobile.jpg';

    $html = "<source srcset='$full' media='(min-width: 576px'>
            <source srcset='$mobile' media='(max-width: 575px)'>
            <img class='media-background object-fit-cover' data-object-fit='cover' src='$full'>";

    echo $html;
}

function cecs_display_announcements() {
	$announcements = cecs_get_announcements();
	
	foreach($announcements->posts as $announcement) {
		echo cecs_announcement_contents($announcement);
	}
}

function cecs_get_announcements() {
    return new WP_Query( array(
        'post_type'     => 'announcement',
        'order'         => 'ASC',
        'orderby'       => 'ID',
    ));
}

function cecs_announcement_contents($announcement) {
	return "<div class=\"alert alert-info py-2 mb-0\" role=\"alert\"><div class=\"container\">{$announcement->post_content}</div></div>";
}

function cecs_get_all_staff( $filters ) {
    return new WP_Query( array(
        'post_type'     => ['people', 'faculty'],
        'order'         => 'ASC',
        'orderby'       => 'ID',
    ));
}

function cecs_get_staff_filter() {
    if ( isset($_POST) ) {
        return $_POST['filters'] ?? null;
    }
}

function cecs_alphabetize_staff( $unorganized ) {
    return $unorganized->posts;
}

function cecs_directory_search_markup( $post ) {
    
}