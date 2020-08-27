<?php 
$memberInfo = get_fields();
$metaArray = get_metadata('post', get_the_ID());
$positionArray = faculty_get_positions($metaArray);
$title = ($metaArray['featured_position'][0] ?? false) ?: faculty_get_display_title($positionArray);
// echo '<pre>';
// print_r($metaArray);
// // echo get_the_ID();
// echo '</pre>';
?>

<article <?php post_class('faculty-listing'); ?> id="post-<?php the_ID(); ?>">

    <div class="card overlay-group my-4 media-background-container">
        <img class="media-background object-fit-cover" src="<?php echo faculty_get_photo(); ?>">
        <!-- <div class="overlay-limit">
            <img class="overlay-image" src="<?php echo faculty_get_photo(); ?>">
        </div> -->
        
        <div class="overlay-text p-4">
            <div class="text-left">
                <h4>
                    <?php echo faculty_get_display_name($metaArray); ?>
                </h4>

                <?php 
                    if (strlen($title) > 20) {
                        echo '<p class="pb-0 mb-0 small font-italic">';
                    } else {
                        echo '<p class="pb-0 mb-0 font-italic">';
                    }
                    echo $title;
                    echo '</p>'; 
                ?>
                <hr class="hr-white my-1">
                <p class="mb-0"><?php echo $metaArray['building'][0] ?? false; ?> <?php echo $metaArray['room'][0] ?? false; ?></p>
                <p class="pb-0 mb-0"><?php echo $metaArray['phone'][0] ?? false;?></p>
                <p><?php echo faculty_get_email($metaArray, true);?> </p>
                <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">View</a>
            </div>
        </div>
    </div>
</article>