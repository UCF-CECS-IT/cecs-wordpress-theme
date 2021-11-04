<?php 

the_post(); 

$obj            = ucfwp_get_queried_object();
$title          = ucfwp_get_header_title( $obj );
$subtitle       = get_field( 'post_subtitle', $post->ID );

// Prioritize featured image, use page header as a fallback
$image          = get_the_post_thumbnail_url( $post->ID ) ?: wp_get_attachment_image_src( get_field( 'page_header_image', $post->ID ), '' )[0];
$caption        = get_field( 'post_image_caption', $post->ID );

?>

<article class="<?php echo $post->post_status; ?> post-list-item">
	<div class="container mt-4 mt-sm-5 mb-2 pb-sm-4">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <h1>
                    <?php echo $title; ?>
                </h1>
                <?php if ( $subtitle ): ?>
                    <div class="lead mb-3">
                        <?php echo $subtitle; ?>
                    </div>
                <?php endif; ?>
                <div class="text-muted font-size-sm text-uppercase letter-spacing-3 mb-4">
                    By: <?php the_author(); ?> | <?php the_date(); ?>
                </div>
            </div>

            <?php if ( $image ): ?>
                <div class="col-xl-10">
                    <figure class="figure d-block mb-4 md-5 mx-auto">
                        <div class="bg-faded text-center">
                            <img class="img-fluid w-100" src="<?php echo $image; ?>">
                        </div>
                        <?php if ( $caption ): ?>
                            <figcaption class="figure-caption pl-2 mt-2">
                                <?php echo $caption; ?>
                            </figcaption>
                        <?php endif; ?>
                    </figure>
                </div>
            <?php endif; ?>
        </div>

        <div class="row justify-content-center ">
            <div class="col-lg-10 col-md-12">
                <?php the_content(); ?>
            </div>

            <!-- <div class="col-lg-3 col-md-12">
                <?php get_template_part('parts/sidebar', 'news'); ?>
            </div> -->
        </div>
	</div>
</article>
