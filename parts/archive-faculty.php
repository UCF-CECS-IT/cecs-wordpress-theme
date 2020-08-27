<?php
/**
 * 
 */

get_header(); ?>

<div class="container">
    <div class="row mt-3 justify-content-center" id="faculty-alphabet-list">
        <?php faculty_alphabet_header(); ?>
    </div>

    <?php if(have_posts()): ?>
        <input type="hidden" id="faculty-searchbox" />
        <div class="row justify-content-center" id="content">
            <?php while (have_posts()) : the_post(); ?>
                <div class="col-lg-3 col-md-4 col-10">
                    <?php get_template_part('parts/faculty','listing'); ?>
                </div>
            <?php endwhile;	?>
        </div>
        <?php get_template_part('parts/navigation', get_post_type()); ?>
    <?php else : // No posts ?>
        <?php get_template_part('parts/nothing', get_post_type()); ?>
    <?php endif; ?>
    
    <?php get_template_part('parts/template', 'footer'); ?>

</div>



    
    <?php // get_template_part('parts/faculty', 'responsive'); ?>
    
<?php get_footer(); ?>
