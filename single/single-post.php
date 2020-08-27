<?php the_post(); 

?>

<article class="<?php echo $post->post_status; ?> post-list-item">
	<div class="container mt-4 mt-sm-5 mb-2 pb-sm-4">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <div class="d-flex justify-content-between mb-3">
                    <span class="lead text-muted">
                        <?php if (get_the_author()): ?>
                            By: <?php the_author(); ?>
                        <?php endif; ?>
                    </span>
                    <span class="lead text-muted"><?php the_date(); ?></s>
                </div>
                <?php the_content(); ?>
            </div>

            <div class="col-lg-3 col-md-12">
                <?php get_template_part('parts/sidebar', 'news'); ?>
            </div>
        </div>
	</div>
</article>
