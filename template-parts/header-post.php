<?php
$obj        = ucfwp_get_queried_object();
$images     = ucfwp_get_header_images( $obj );
$header_content_type = ucfwp_get_header_content_type( $obj );
$header_height       = get_field( 'page_header_height', $obj );
$exclude_nav         = get_field( 'page_header_exclude_nav', $obj );
$bg = get_the_post_thumbnail_url(null, 'bg-img-xl');

$filter = '';
if ($bg) {
	$arr = explode('/', $bg);
	$stub = array_slice($arr, 3);
	$size = getimagesize($_SERVER['DOCUMENT_ROOT'].'/'.implode('/', $stub));
	
	if ($size[0] < 900) {
		$filter = 'filter-blur';
	}
}
?>

<div class="header-media header-media-default mb-0 d-flex flex-column">
	<div class="header-media-background-wrap">
		<div class="header-media-background media-background-container">
            <picture class="media-background-picture">
				<?php if ($bg): ?>
					<img class="media-background object-fit-cover <?php echo $filter; ?>" src="<?php echo $bg;?>">
				<?php else: ?>
					<?php cecs_fallback_media(); ?>
				<?php endif; ?>
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
	if ($header_content_type === 'title_subtitle' ):
	?>
	<div class="header-media-controlfix"></div>
	<?php endif; ?>
</div>

