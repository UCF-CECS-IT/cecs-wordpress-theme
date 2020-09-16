<?php the_post(); 

?>

<article class="<?php echo $post->post_status; ?> post-list-item">
	<div class="container mt-4 mt-sm-5 mb-2 pb-sm-4">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <?php the_content(); ?>
            </div>

            <div class="col-lg-3 col-md-12">
                <?php get_template_part('parts/sidebar', 'news'); ?>
            </div>
        </div>
	</div>
</article>
