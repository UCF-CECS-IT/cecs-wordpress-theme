<?php

/**
 * Generates a content block of In The News posts
 *
 * @param integer $count
 * @return void
 */
function news_block($count = 4) {
    $query = new WP_Query(array(
        'post_type' => 'in-the-news',
        'post_status' => 'publish',
        'posts_per_page' => $count,
        'orderby' => 'date',
        'order' => 'DESC'
    ));

    while ($query->have_posts()):
        $query->the_post();
        get_template_part('parts/news-line');
    endwhile;
    wp_reset_query();
}

/**
 * Query action that sets the default number of In The News posts on a query
 * to 15. 
 *
 * @param WP_Query $query
 * @return void
 */
function news_num_posts( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ( is_post_type_archive( 'in-the-news' ) ) {
        $query->set( 'posts_per_page', 15 );
        return;
    }
}
add_action( 'pre_get_posts', 'news_num_posts');