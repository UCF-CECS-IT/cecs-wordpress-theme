<?php 

the_post();

$headshot = get_field( 'staff_spotlight_headshot', $post->ID );
$role = get_field( 'staff_spotlight_role', $post->ID );

?>

<article class="<?php echo $post->post_status; ?> post-list-item">
	<div class="container mt-4 mt-sm-5 mb-2 pb-sm-4">
        <div class="row justify-content-center">
            <?php if ( $headshot || $role ): ?>
                <div class="col-lg-3 col-md-4 col-11">
                    <?php if ( $headshot ): ?>
                        <img class="w-100 img-fluid rounded mb-3" src="<?php echo $headshot; ?>" alt="<?php echo $post->post_title; ?>">
                    <?php endif; ?>
                    
                    <h4 class="heading-underline text-transform-none mb-2"><?php echo $post->post_title; ?></h4>

                    <?php if ( $role ): ?>
                        <h5 class="font-weight-light"><?php echo $role; ?></h5>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="col-lg-9 col-md-8">
                <?php the_content(); ?>
            </div>
        </div>
	</div>
</article>