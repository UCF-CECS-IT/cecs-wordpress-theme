<?php
/**
 * Custom fallback header for gallery posts too old to have the new UCF theme 
 * ACF header fields. Pulls the first image from the gallery and sets that
 * as the header image.
 */ 

$obj        = ucfwp_get_queried_object();
$header_content_type = ucfwp_get_header_content_type( $obj );
$exclude_nav         = get_field( 'page_header_exclude_nav', $obj );
$img = get_field('gallery_images')[0];

?>
<div class="header-media header-media-default mb-0 d-flex flex-column">
	<div class="header-media-background-wrap">
		<div class="header-media-background media-background-container">
            <picture class="media-background-picture">
                <img class="media-background object-fit-cover" src="<?php echo $img['url']; ?>">
            </picture>
		</div>
	</div>

	<?php
	// Display the site nav
	if ( !$exclude_nav ) { echo ucfwp_get_nav_markup(); }
	?>

	<?php
	// Display the inner header contents
	?>
	<div class="header-content">
		<div class="header-content-flexfix">
		<div class="header-content-inner align-self-start pt-4 pt-sm-0 align-self-sm-center">
    <div class="container">
        <div class="d-inline-block bg-primary-t-1">
                <h2 class="header-title"><?php the_title(); ?></h2>
        </div>
        <div class="clearfix"></div>
        <div class="d-inline-block bg-inverse">
            <span class="header-subtitle">
                <?php while(have_rows('date_range')): the_row();
                    echo get_sub_field('start_date');
                endwhile; ?>
            </span>
        </div>
    </div>
</div>
		</div>
	</div>

	<?php
	// Print a spacer div for headers with background videos (to make
	// control buttons accessible), and for headers showing a standard
	// title/subtitle to push them up a bit
	if ( $videos || $header_content_type === 'title_subtitle' ):
	?>
	<div class="header-media-controlfix"></div>
	<?php endif; ?>
</div>