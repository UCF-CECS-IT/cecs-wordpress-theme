<?php
/**
 * Custom fallback header for gallery posts too old to have the new UCF theme 
 * ACF header fields. Pulls the first image from the gallery and sets that
 * as the header image.
 */ 

$obj        = ucfwp_get_queried_object();
$header_content_type = ucfwp_get_header_content_type( $obj );
$exclude_nav         = get_field( 'page_header_exclude_nav', $obj );

?>
<div class="header-media header-media-default mb-0 d-flex flex-column">
	<div class="header-media-background-wrap">
		<div class="header-media-background media-background-container">
            <picture class="media-background-picture">
				<?php cecs_fallback_media(); ?>
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
			<?php echo ucfwp_get_header_content_markup(); ?>
		</div>
    </div>
    
</div>
		</div>
	</div>

	<?php
	// Print a spacer div for headers with background videos (to make
	// control buttons accessible), and for headers showing a standard
	// title/subtitle to push them up a bit
	if ( $header_content_type === 'title_subtitle' ):
	?>
	<!-- <div class="header-media-controlfix"></div> -->
	<?php endif; ?>
</div>