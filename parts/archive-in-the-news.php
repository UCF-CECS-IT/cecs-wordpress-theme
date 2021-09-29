<?php
/**
 * 
 */

get_header(); ?>

<div class="container mt-4 mt-sm-5 mb-2 pb-sm-4">
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="list-group-flush">
                <?php while (have_posts()) : the_post(); ?>
                    <a href="<?php the_field( 'link' );?>" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <span class="font-weight-bold"><?php the_field( 'news_outlet' );?></span>
                            <span class="font-weight-bold"><?php the_field( 'story_date' );?></span>
                        </div>
                        <p class="text-complementary smaller pb-0 mb-0" href="<?php the_field( 'link' );?>" target="_blank"><?php the_field('headline');?></p>
                        <p class="font-italic smaller pb-1 mb-1"><?php the_field( 'author_name' );?></p>
                    </a>
                <?php endwhile;	?>
            </div>
        </div>

        <div class="col-lg-3 col-md-12">
            <?php get_template_part( 'parts/sidebar', 'news' ); ?>
        </div>
    </div>
</div>
    
<?php get_footer(); ?>