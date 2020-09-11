<?php

$memberInfo = get_fields( $post->ID );
$metaArray = get_metadata( 'post', $post->ID );
$positionArray = faculty_get_positions( $metaArray );
$title = ($metaArray['featured_position'][0] ?? false) ?: faculty_get_display_title($positionArray);

?>

<div class="row no-gutters">
    <div class="col">
        <a href="<?php echo get_permalink($post->ID); ?>">
            <div class="media-background-container person-photo mx-auto rounded box-shadow-soft h-75">
                <img src="<?php echo faculty_get_photo( $post->ID ); ?>" class="media-background object-fit-cover" data-object-fit="cover">
            </div>
        </a>
    </div>
    <div class="col p-2 d-flex flex-column align-items-start">
        <h3 class="mt-2 mb-1 person-name"><?php echo faculty_get_display_name($metaArray); ?></h3>
        <?php if ( $title ?? false): ?>
            <div class="font-italic person-job-title <?php 
                    if (strlen($title) > 20) {
                        echo 'small font-italic';
                    } else {
                        echo 'font-italic';
                    }
                ?>">
                <?php echo $title; ?>
            </div>
        <?php endif; ?>
        <?php if ( $metaArray['email'][0] ?? false ): ?>
            <div class="person-email"><a href="mailto:<?php echo $metaArray['email'][0]; ?>"><span class="fa-stack fa-lg text-primary"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></a></div>
        <?php endif; ?>
        <?php if ( $metaArray['phone'][0] ?? false): ?>
            <div class="person-job-title"><?php echo $metaArray['phone'][0] ?? false;?></div>
        <?php endif; ?>
        <div class="mt-auto"><a class="btn btn-primary btn-sm font-weight-light" href="<?php echo get_permalink($post->ID); ?>"><small>Profile</small></a></div>
    </div>
</div>