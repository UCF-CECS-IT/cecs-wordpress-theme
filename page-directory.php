<?php 

get_header();

cecs_directory_search_markup( get_post() );

$staff = cecs_get_all_staff( cecs_get_staff_filter() );
$alphabetized = cecs_alphabetize_staff( $staff );

var_dump($alphabetized);

?>

<article class="<?php echo $post->post_status; ?> post-list-item">
	<div class="container mt-4 mt-sm-5 mb-5 pb-sm-4">
        <div class="row justify-content-center">
            <?php while( $post = $alphabetized ): ?>
                <div class="col-lg-4 col-md-6 col-11 small-hover-zoom">
                    <?php get_template_part( 'parts/directory', $post->post_type ); ?>
                </div>
            <?php endwhile; ?>
        </div>
	</div>
</article>

<?php get_footer(); ?>
