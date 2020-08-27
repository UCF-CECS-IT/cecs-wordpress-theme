<?php

if(get_field('pdf')) { // Currently unused - was used for publications
    $news_link = get_field('pdf');
    $target = '_blank';
} else {
    $news_link = get_permalink();
    $target = '_self';
}

?>

<article class="<?php echo $post->post_status; ?> post-list-item mb-4 h-100"  id="post-<?php the_ID(); ?>">

    <?php if(!is_single()): ?>
        <div class="card h-100">
            <div class="card-img-top card-height-set-4">
                <a class="h-100" href="<?php the_permalink(); ?>"> 
                    <img class="img-fluid position-relative" src="<?php news_get_thumbnail( get_the_ID(), 'sm'); ?>">
                    <span class="badge badge-primary position-absolute position-top-right"><?php news_get_badge_tag(); ?></span>
                </a>
            </div>
            <div class="card-block text-secondary pb-0">
                <a class="remove-pointer" href="<?php the_permalink(); ?>">  
                    <p class="font-weight-bold text-secondary"><?php the_title(); ?></p>
                </a>

                <a class="remove-pointer" href="<?php the_permalink(); ?>"> 
                    <p class="text-primary mb-0 pb-0">Read More <span class="fa fa-angle-double-right" aria-hidden="true"></span></p>
                </a>
            </div>
            <div class="card-footer bg-secondary">
                <span class="date text-muted small text-uppercase letter-spacing-3"><?php the_time( 'F j, Y' ); ?></span>
            </div>
        </div>
    <?php endif; ?>  

</article>