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
        <div class="row ucf-post-list ucfwp-post-list-news">
            <?php foreach ($posts as $index => $item): 
                $img = get_field('gallery_images', $item->ID)[0];
                ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <article class="ucf-post-list-item" id="gallery-<?php echo $item->ID; ?>">
                        <a class="text-secondary newsitem-link" href="<?php echo get_permalink($item->ID); ?>">
                            <div class="aspect-ratio-box media-background-container position-relative mb-3">
                                <img class="media-background object-fit-cover" src="<?php echo $img['sizes']['large'] ?>">
                                <!-- <span class="badge badge-primary position-absolute position-top-right"><?php echo $item->post_title; ?></span> -->
                            </div>
                            <h3 class="newsitem-heading"><?php echo $item->post_title; ?></h3>
                            <?php if ($item->post_content): ?>
                                <span class="newsitem-excerpt"><?php echo $item->post_content; ?></span>
                            <?php else: ?>
                                <span class="newsitem-excerpt">No caption available</span>
                            <?php endif; ?>

                            <div class="small text-default mt-2 newsitem-subhead"><?php echo date("M d, Y", strtotime($item->post_date)); ?></div>
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
