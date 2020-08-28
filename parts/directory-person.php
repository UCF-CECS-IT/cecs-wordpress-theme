<?php

$is_content_empty = ucfwp_is_content_empty( $post->post_content );

?>

<div class="row no-gutters">
    <div class="col">
        <?php if( !$is_content_empty ): ?>
            <a class="person-link" href="<?php echo get_permalink( $post->ID ); ?>">
        <?php endif; ?>
            <div class="media-background-container person-photo mx-auto rounded box-shadow-soft h-75">
                <?php echo ucfwp_get_person_thumbnail( $post, 'rounded box-shadow-soft h-75' ); ?>
            </div>
        <?php if( !$is_content_empty ): ?>
            </a>
        <?php endif; ?>
    </div>

    <div class="col p-2">
        <h3 class="mt-2 mb-1 person-name"></h3><?php echo ucfwp_get_person_name( $post ); ?>
    </div>
</div>