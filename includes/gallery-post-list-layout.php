<?php

/**
 * 
 * The functions for the Gallery post list card layout
 * 
 * @since 1.0.18
 * 
 **/

function ucf_post_list_display_gallery_before($content, $posts, $atts)
{
    ob_start();
    ?>
    <div class="ucf-post-list card-layout" id="post-list-<?php echo $atts['list_id']; ?>">
    <?php
    return ob_get_clean();
}

add_filter('ucf_post_list_display_gallery_before', 'ucf_post_list_display_gallery_before', 10, 3);


function ucf_post_list_display_gallery_title($content, $posts, $atts)
{
    $formatted_title = '';

    if ($list_title = $atts['list_title']) {
        $formatted_title = '<h2 class="ucf-post-list-title">' . $list_title . '</h2>';
    }

    return $formatted_title;
}

add_filter('ucf_post_list_display_gallery_title', 'ucf_post_list_display_gallery_title', 10, 3);


function ucf_post_list_display_gallery($content, $posts, $atts)
{
    if ($posts && !is_array($posts)) {
        $posts = array($posts);
    }
    ob_start();
    ?>
    <?php if ($posts) : ?>
        <div class="row">
            <?php foreach ($posts as $index => $item): 
                $img = get_field('gallery_images', $item->ID)[0];
                ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <article class="h-100" id="gallery-<?php echo $item->ID; ?>">
                        <a class="h-100 remove-pointer" href="<?php echo get_permalink($item->ID); ?>">
                            <div class="card h-100">
                            <div class="card-img-top card-height-set-3">
                                <img class="img-fluid position-relative" src="<?php echo $img['sizes']['large'] ?>">
                                <span class="badge badge-primary position-absolute position-top-right"><?php echo $item->post_title; ?></span>
                            </div>
                            <div class="card-block smaller">
                                <?php if ($item->post_content): ?>
                                    <span class="text-secondary"><?php echo $item->post_content; ?></span>
                                <?php else: ?>
                                    <span class="text-secondary">No caption available</span>
                                <?php endif; ?>
                            </div>
                        </a>
                    </article>
                </div>
            <?php endforeach; ?>

        </div>

    <?php else : ?>
        <div class="ucf-post-list-error">No results found.</div>
    <?php endif;

    return ob_get_clean();
}

add_filter('ucf_post_list_display_gallery', 'ucf_post_list_display_gallery', 10, 3);


function ucf_post_list_display_gallery_after($content, $posts, $atts)
{
    ob_start();
    ?>
    </div>
    <?php
    return ob_get_clean();
}

add_filter('ucf_post_list_display_gallery_after', 'ucf_post_list_display_gallery_after', 10, 3);
