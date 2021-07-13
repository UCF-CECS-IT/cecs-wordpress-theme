<?php

/**
 * Searches for UCF WP header, then attempts to find a KMDG builder header if 
 * that fails, and finally loads a default image if all else fails.
 */

$obj = ucfwp_get_queried_object();
$images     = ucfwp_get_header_images( $obj );
$exclude_nav = false;

$acfArray = get_fields();
$slideCount = 0;
if ($acfArray['slides']) {
	$slideCount = count($acfArray['slides']);
}

$filter = '';
if (!$images && $slideCount) {
	$arr = explode('/', wp_get_attachment_image_url($acfArray['slides'][0]['image'], 'large'));
	$stub = array_slice($arr, 3);
	$size = getimagesize($_SERVER['DOCUMENT_ROOT'].'/'.implode('/', $stub));
	
	// Apply a blur filter on any image with width below the size threshold
	if ($size[0] < 850) {
		$filter = 'filter-blur';
	}
}

?>

<div class="header-media header-media-default mb-0 d-flex flex-column">

	<?php if ($images): ?>
		<div class="header-media-background-wrap">
			<div class="header-media-background media-background-container">
				<?php
					$bg_image_srcs = ucfwp_get_header_media_picture_srcs( $header_height, $images );
					echo ucfwp_get_media_background_picture( $bg_image_srcs );
				?>
			</div>
		</div>

	<?php elseif ($slideCount): ?>
		<div class="header-media-background-wrap">
			<div class="header-media-background media-background-container">
				<picture class="media-background-picture">
					<img class="media-background object-fit-cover <?php echo $filter; ?>" src="<?php echo wp_get_attachment_image_url($acfArray['slides'][0]['image'], 'large');?>">
				</picture>
			</div>
		</div>

	<?php else: ?>
		<div class="header-media-background-wrap">
			<div class="header-media-background media-background-container">
				<picture class="media-background-picture">
					<?php cecs_fallback_media(); ?>
				</picture>
			</div>
		</div>

	<?php endif; ?>

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
                        <h2 class="header-title"><?php the_title();?></h2>
                    </div>
                    <div class="clearfix"></div>
                    <!-- <div class="d-inline-block bg-inverse">
                        <span class="header-subtitle">College of Engineering and Computer Science Faculty Directory</span>
                    </div> -->
                </div>
            </div>
		</div>
	</div>

	<?php
	// Print a spacer div for headers with background videos (to make
	// control buttons accessible), and for headers showing a standard
	// title/subtitle to push them up a bit
	if ( ($header_content_type ?? false) === 'title_subtitle'):
	?>
	<div class="header-media-controlfix"></div>
	<?php endif; ?>
</div>