<?php
/*
Template Name: Builder - legacy pages only
*/

/**
 * @package WordPress
 *
 * Loops through each Flexible Content row and automatically includes files in the
 * layouts folder using the name (slug) of the layout as the name of the template
 * part to load. Put all your HTML and logic into the layout file and it will be
 * included on a per-instance basis.
 */
get_header(); 

// echo '<pre>';
// print_r(get_fields());
// echo '</pre>';
// exit();

$columns = 'col-12';

if (get_field('use_sidebar')) {
    $columns = 'col-lg-8';
}
?>

<?php if(have_posts()) : ?>
    <?php while(have_posts()) : the_post(); ?>
        <div class="container py-4 <?php echo get_field('use_sidebar') ? 'has-sidebar' : ''; ?>">
            <div class="row">
                <div class="<?php echo $columns;?>">
                    <?php
                    if(have_rows('page_sections')):
                        while(have_rows('page_sections')): the_row();
                            get_template_part('layouts/'.get_row_layout());
                        endwhile;
                    endif;
                    ?>
                </div>
                <?php if (get_field('use_sidebar')): ?>
                    <div class="col-lg-4">
                        <?php get_template_part('parts/sidebar', 'events'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endwhile; endif; ?>
<?php wp_reset_query(); ?>

<?php get_footer(); ?>