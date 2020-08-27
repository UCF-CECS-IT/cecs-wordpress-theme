<?php get_header(); ?>

<div class="container mt-4 mb-5 pb-sm-4">
	<?php if ( have_posts() ): ?>
		<div class="row" id="content">
            <div class="col-lg-9 col-md-12">
                <div class="row">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="col-lg-4 col-md-6 mb-4">	
                            <?php get_template_part('parts/content', get_post_type()); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <?php get_template_part('parts/sidebar', 'news'); ?>
            </div>
		</div>
		<div class="row justify-content-center">
			<?php ucfwp_the_posts_pagination(); ?>
		</div>
	<?php else: ?>
		<p>No results found.</p>
	<?php endif; ?>
</div>

<?php get_footer(); ?>