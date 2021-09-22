<?php

/**
 * Generates the thumbnail HTML for either the default image attached to the post,
 * or to the generic fallback image.
 *
 * @return void
 */
function news_get_thumbnail($id, $size) {

    // First choice: get Featured Image as thumbnail
    $default = get_the_post_thumbnail_url($id, $size);

    if ($default) {
        echo $default;
        return;
    }

    $ucftheme = wp_get_attachment_image_url( get_field( 'page_header_image', $id ), $size );

    if ($ucftheme) {
        echo $ucftheme;
        return;
    }


    if ($size == 'thumbnail') {
        $fallback = get_stylesheet_directory_uri() . '/static/img/fallback-thumbnail.jpg';
    } else {
        $fallback = get_stylesheet_directory_uri() . '/static/img/fallback-narrow.jpg';
    }

    // Returns a fallback placeholder image
    echo $fallback;
}

/**
 * Generates the image URL for either the default image attached to the post,
 * or to the generic fallback image.
 *
 * @return void
 */
function news_get_header_image() {
    $default = get_the_post_thumbnail_url();
    $fallback = get_stylesheet_directory_uri() . '/static/img/fallback.jpg';

    if ($default) {
        echo $default;
        return;
    }

    // Returns a fallback placeholder image
    echo $fallback;
}

/**
 * Pulls an array of tags for the post and converts them into a string for the
 * corner badge. If none are found, defaults to "News".
 *
 * @return string
 */
function news_get_badge_tag() {
    $tags = get_the_tags(get_post()->ID);

    if (!$tags) {
        echo 'News';
        return;
    };

    $stringifyTags = '';
    foreach($tags as $key => $tag) {
        if ($key == 0) {
            $stringifyTags = $tag->name;
        } else {
            $stringifyTags .= ', ' . $tag->name;
        }
    }

    echo $stringifyTags;
}

/**
 * Fetches the specified count of News posts.
 *
 * @param integer $count
 * @return WP_Query
 */
function news_get_recent($count = 1) {
    return new WP_Query(array(
        'posts_per_page'    => $count
    ));
}

/**
 * Query action that sets the default size of news queries to 12 to maintain
 * even lines on the News post page.
 *
 * @param WP_Query $query
 * @return void
 */
function news_query_size( $query ) {
    if ( $query->is_home() && $query->is_main_query() && !is_admin() ) {
        $query->set( 'posts_per_page', 12 );
        $query->set( 'ignore_sticky_posts', 1);
    }
}
add_action( 'pre_get_posts', 'news_query_size' );