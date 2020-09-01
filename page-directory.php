<?php 

get_header();

get_template_part( 'parts/directory', 'search' );

$staff = cecs_get_all_staff( cecs_get_staff_filter() );
$alphabetized = cecs_alphabetize_staff( $staff );

?>

<article class="<?php echo $post->post_status; ?> post-list-item">
	<div class="container mt-4 mt-sm-5 mb-5 pb-sm-4 ucf-post-list ucfwp-post-list-people">
        <div class="row justify-content-center ucf-post-list-items">
            <?php foreach( $alphabetized as $post ): ?>
                <div class="col-lg-4 col-md-6 col-11 mb-3 ucf-post-list-item small-hover-zoom">
                    <?php get_template_part( 'parts/directory', $post->post_type ); ?>
                </div>
            <?php endforeach; ?>
        </div>
	</div>
</article>

<?php get_footer(); ?>
