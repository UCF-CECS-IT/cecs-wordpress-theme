<?php get_header(); the_post(); 

?>

<article class="<?php echo $post->post_status; ?> post-list-item">
	<div class="container mt-4 mt-sm-5 mb-5 pb-sm-4">
		<?php if (get_field('use_sidebar')): ?>
			<div class="row">
				<div class="col-lg-8 col-md-12">
					<?php the_content(); ?>
				</div>

				<div class="col-lg-4 col-md-12">
					<?php get_template_part('parts/sidebar', 'events'); ?>
				</div>
			</div>
		<?php else: ?>
			<?php the_content(); ?>
		<?php endif; ?>
	</div>
</article>

<?php get_footer(); ?>
