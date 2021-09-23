<?php

get_header(); 

$letter = get_the_terms(get_post()->id,'letter');

get_template_part('parts/directory', 'search'); 
?>

<div class="container mt-4 mt-sm-5 mb-5 pb-sm-4 ucf-post-list ucfwp-post-list-people">

    <?php if(have_posts()): ?>
        <input type="hidden" id="faculty-searchbox" />
        <div class="row justify-content-center ucf-post-list-items" id="content">
            <?php while (have_posts()) : the_post(); ?>
                <div class="col-lg-4 col-md-6 col-11 mb-3 ucf-post-list-item small-hover-zoom">
                    <?php get_template_part( 'parts/directory', $post->post_type ); ?>
                </div>
            <?php endwhile;	?>
        </div>
        <?php get_template_part('parts/navigation', get_post_type()); ?>
    <?php else : // No posts ?>
        <?php get_template_part('parts/nothing', get_post_type()); ?>
    <?php endif; ?>
    
    <?php get_template_part('parts/template', 'footer'); ?>

</div>


<?php get_footer(); ?>