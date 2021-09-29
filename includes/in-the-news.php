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


/**
 * 
 * The functions for the In The News post list layout
 * 
 * @since 1.0.18
 * 
 **/

function ucf_post_list_display_itn_before($content, $posts, $atts)
{
    ob_start();
    ?>
    <div class="ucf-post-list ucfwp-post-list-news" id="post-list-<?php echo $atts['list_id']; ?>">
    <?php
    return ob_get_clean();
}

add_filter('ucf_post_list_display_itn_before', 'ucf_post_list_display_itn_before', 10, 3);


function ucf_post_list_display_itn_title($content, $posts, $atts)
{
    $formatted_title = '';

    if ($list_title = $atts['list_title']) {
        $formatted_title = '<h2 class="ucf-post-list-title">' . $list_title . '</h2>';
    }

    return $formatted_title;
}

add_filter('ucf_post_list_display_itn_title', 'ucf_post_list_display_itn_title', 10, 3);


function ucf_post_list_display_itn($content, $posts, $atts)
{
    if ($posts && !is_array($posts)) {
        $posts = array($posts);
    }
    ob_start();
    ?>
    <?php if ($posts) : ?>

        <?php foreach ($posts as $index => $item): ?>
            <div class="mb-4 ucf-post-list-item">
                <article>
                    <a class="d-block text-secondary newsitem-link" href="<?php echo get_field( 'link', $item->ID ); ?>">
                        <div>
                            <h3 class="newsitem-heading"><?php echo get_field( 'headline', $item->ID ); ?></h3>

                            <div class="newsitem-excerpt d-flex justify-content-between">
                                <span><?php echo get_field( 'news_outlet', $item->ID ); ?></span>
                                <span><?php echo get_field( 'story_date', $item->ID ); ?></span>
                            </div>

                            <div class="text-default mt-2 newsitem-excerpt font-italic">
                                <?php echo get_field( 'author_name', $item->ID ); ?>
                            </div>
                        </div>
                    </a>
                </article>
            </div>
        <?php endforeach; ?>

    <?php else : ?>
        <div class="ucf-post-list-error">No results found.</div>
    <?php endif;

    return ob_get_clean();
}

add_filter('ucf_post_list_display_itn', 'ucf_post_list_display_itn', 10, 3);


function ucf_post_list_display_itn_after($content, $posts, $atts)
{
    ob_start();
    ?>
    </div>
    <?php
    return ob_get_clean();
}

add_filter('ucf_post_list_display_itn_after', 'ucf_post_list_display_itn_after', 10, 3);