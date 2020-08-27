<?php
/**
 * 
 */

get_header(); ?>

<div class="container py-5">

    <?php if(have_posts()): ?>
        <div class="row" id="content">
            <?php while (have_posts()) : the_post(); ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <?php get_template_part('parts/gallery','listing'); ?>
                </div>
            <?php endwhile;	?>
        </div>
    <?php else : // No posts ?>
        <?php get_template_part('parts/nothing', get_post_type()); ?>
    <?php endif; ?>

</div>
    
<?php get_footer(); ?>