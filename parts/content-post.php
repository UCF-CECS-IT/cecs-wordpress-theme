<?php

if(get_field('pdf')) { // Currently unused - was used for publications
    $news_link = get_field('pdf');
    $target = '_blank';
} else {
    $news_link = get_permalink();
    $target = '_self';
}

$date = date("M d, Y", strtotime($post->post_date));

?>

<article class="<?php echo $post->post_status; ?> ucf-post-list-item"  id="post-<?php the_ID(); ?>">

    <?php if(!is_single()): ?>
        <a class="text-secondary newsitem-link" href="<?php echo get_permalink($post->ID); ?>">
            <div class="aspect-ratio-box mb-3">
                <img src="<?php news_get_thumbnail($post->ID, ''); ?>" class="img-fluid" alt="<?php echo $post->post_title; ?>">
            </div>

            <h3 class="newsitem-heading"><?php echo $post->post_title; ?></h3>

            <div class="newsitem-excerpt"><?php echo ucfwp_get_excerpt($post, 25); ?></div>

            <div class="small text-default mt-2 newsitem-subhead"><?php echo $date; ?></div>
        </a>
    <?php endif; ?>  

</article>