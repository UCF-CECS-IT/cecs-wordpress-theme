<?php

/**
 * The functions for the CECS post list card layout
 **/

function ucf_post_list_display_cecs_before( $content, $posts, $atts ) {
    ob_start();
?>
    <div class="ucf-post-list card-layout" id="post-list-<?php echo $atts['list_id']; ?>">
<?php
    return ob_get_clean();
}

add_filter( 'ucf_post_list_display_cecs_before', 'ucf_post_list_display_cecs_before', 10, 3 );


function ucf_post_list_display_cecs_title( $content, $posts, $atts ) {
    $formatted_title = '';

    if ( $list_title = $atts['list_title'] ) {
        $formatted_title = '<h2 class="ucf-post-list-title">' . $list_title . '</h2>';
    }

    return $formatted_title;
}

add_filter( 'ucf_post_list_display_cecs_title', 'ucf_post_list_display_cecs_title', 10, 3 );


function ucf_post_list_display_cecs( $content, $posts, $atts ) {
    if ( $posts && ! is_array( $posts ) ) { $posts = array( $posts ); }
    ob_start();
?>
    <?php if ( $posts ): ?>
        <div class="ucf-post-list-card-deck">

        <?php
        foreach( $posts as $index=>$item ) :
            $date = date( "M d", strtotime( $item->post_date ) );

            if( $atts['posts_per_row'] > 0 && $index !== 0 && ( $index % $atts['posts_per_row'] ) === 0 ) {
                echo '</div><div class="ucf-post-list-card-deck">';
            }
        ?>
            <div class="ucf-post-list-card">
                <a class="ucf-post-list-card-link" href="<?php echo get_permalink( $item->ID ); ?>">
                    <img src="<?php news_get_thumbnail( $item->ID, 'sm' ); ?>" class="ucf-post-list-thumbnail-image" alt="<?php echo $item->post_title; ?>">
                    <div class="ucf-post-list-card-block">
                        <h3 class="ucf-post-list-card-title"><?php echo $item->post_title; ?></h3>
                        <p class="ucf-post-list-card-text"><?php echo $date; ?></p>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>

        </div>

    <?php else: ?>
        <div class="ucf-post-list-error">No results found.</div>
    <?php endif;

    return ob_get_clean();
}

add_filter( 'ucf_post_list_display_cecs', 'ucf_post_list_display_cecs', 10, 3 );


function ucf_post_list_display_cecs_after( $content, $posts, $atts ) {
    ob_start();
?>
    </div>
<?php
    return ob_get_clean();
}

add_filter( 'ucf_post_list_display_cecs_after', 'ucf_post_list_display_cecs_after', 10, 3 );


/**
 * Add custom Academic Affairs Staff list layout for UCF Post List shortcode
 *
 * @since 0.2.2
 * 
 * CECS THEME MODIFIED - added display for new office address custom field and faculty page field
 **/
if ( class_exists( 'UCF_People_PostType' ) ) {

    function ucfwp_post_list_display_aao_before( $content, $items, $atts ) {
        ob_start();
    ?>
    <div class="ucf-post-list ucfwp-post-list-people">
    <?php
        return ob_get_clean();
    }

	add_filter( 'ucf_post_list_display_aao_before', 'ucfwp_post_list_display_aao_before', 10, 3 );


    function ucfwp_post_list_display_aao_title( $content, $items, $atts ) {
        $formatted_title = '';
        if ( $atts['list_title'] ) {
            $formatted_title = '<h2 class="ucf-post-list-title">' . $atts['list_title'] . '</h2>';
        }
        return $formatted_title;
    }

	add_filter( 'ucf_post_list_display_aao_title', 'ucfwp_post_list_display_aao_title', 10, 3 );


	/**
	 * Edited to add office address, faculty page link
	 */
    function ucfwp_post_list_display_aao( $content, $items, $atts ) {
        if ( ! is_array( $items ) && $items !== false ) { $items = array( $items ); }
        ob_start();
        ?>
        <?php if ( $items ): ?>
        <ul class="list-unstyled row ucf-post-list-items">
            <?php foreach ( $items as $item ): ?>
            <?php $is_content_empty = ucfwp_is_content_empty( $item->post_content ); ?>

            <!-- Original  -->
            <!-- <li class="col-6 col-sm-4 col-md-3 col-xl-2 mt-3 mb-2 ucf-post-list-item"> -->

            <li class="col-12 col-md-6 col-lg-4 offset-lg-1 mt-3 mb-3 ucf-post-list-item small-hover-zoom">
                <?php if ( ! $is_content_empty ) { ?>
                <a class="person-link" href="<?php echo get_permalink( $item->ID ); ?>">
                <?php } ?>
                    <div class="row no-gutters">
                        <div class="col">
                            <?php echo ucfwp_get_person_thumbnail( $item, 'rounded box-shadow-soft h-75' ); ?>
                        </div>
                        <div class="col p-2">
                            <h3 class="mt-2 mb-1 person-name"><?php echo ucfwp_get_person_name( $item ); ?></h3>
                            <?php if ( $job_title = get_field( 'person_jobtitle', $item->ID ) ): ?>
                            <div class="font-italic person-job-title">
                                <?php echo $job_title; ?>
                            </div>
                            <?php endif; ?>
                            <?php if ( $email = get_field( 'person_email', $item->ID ) ): ?>
                            <div class="person-email">
                                <?php if ( $is_content_empty ) { ?>
                                <a href="mailto:<?php echo $email; ?>">
                                <?php } ?>
                                <?php echo $email; ?>
                                <?php if ( $is_content_empty ) { ?>
                                </a>
                                <?php } ?>
                            </div>
                            <?php endif; ?>
                            <?php if ( $phone = get_field( 'person_phone', $item->ID ) ): ?>
                            <div class="person-job-title">
                                <?php echo $phone; ?>
                            </div>
                            <?php endif; ?>

                            <?php if ( $office = get_field( 'person_office', $item->ID ) ): ?>
                            <div class="person-job-title">
                                <?php echo $office; ?>
                            </div>
                            <?php endif; ?>

                            <?php if ( $facpage = get_field( 'person_faculty_page', $item->ID ) ): ?>
                            <div class="person-job-title">
                                <a href="<?php echo $facpage; ?>">View Full Profile Page</a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php if ( ! $is_content_empty ) { ?>
                </a>
                <?php } ?>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <div class="ucf-post-list-error mb-4">No results found.</div>
        <?php endif; ?>
    <?php
        return ob_get_clean();
    }

	add_filter( 'ucf_post_list_display_aao', 'ucfwp_post_list_display_aao', 10, 3 );


    function ucfwp_post_list_display_aao_after( $content, $items, $atts ) {
        ob_start();
    ?>
    </div>
    <?php
        return ob_get_clean();
    }

	add_filter( 'ucf_post_list_display_aao_after', 'ucfwp_post_list_display_aao_after', 10, 3 );

}


/**
 * Add custom Academic Affairs Staff list layout for UCF Post List shortcode
 *
 * @since 0.2.2
 * 
 * CECS THEME MODIFIED - added display for new office address custom field and faculty page field
 **/
if ( class_exists( 'UCF_People_PostType' ) ) {

    function ucfwp_post_list_display_leadership_before( $content, $items, $atts ) {
        ob_start();
    ?>
    <div class="ucf-post-list ucfwp-post-list-people">
    <?php
        return ob_get_clean();
    }

	add_filter( 'ucf_post_list_display_leadership_before', 'ucfwp_post_list_display_leadership_before', 10, 3 );


    function ucfwp_post_list_display_leadership_title( $content, $items, $atts ) {
        $formatted_title = '';
        if ( $atts['list_title'] ) {
            $formatted_title = '<h2 class="ucf-post-list-title">' . $atts['list_title'] . '</h2>';
        }
        return $formatted_title;
    }

	add_filter( 'ucf_post_list_display_leadership_title', 'ucfwp_post_list_display_leadership_title', 10, 3 );


	/**
	 * Edited to add office address, faculty page link
	 */
    function ucfwp_post_list_display_leadership( $content, $items, $atts ) {
        if ( ! is_array( $items ) && $items !== false ) { $items = array( $items ); }
        ob_start();
        ?>
        <?php if ( $items ): ?>
        <ul class="list-unstyled row ucf-post-list-items">
            <?php foreach ( $items as $item ): ?>
            <?php $is_content_empty = ucfwp_is_content_empty( $item->post_content ); ?>

            <!-- Original  -->
            <!-- <li class="col-6 col-sm-4 col-md-3 col-xl-2 mt-3 mb-2 ucf-post-list-item"> -->

            <li class="col-12 col-sm-6 col-md-6 mt-3 mb-3 ucf-post-list-item small-hover-zoom">
                <?php if ( ! $is_content_empty ) { ?>
                <a class="person-link" href="<?php echo get_permalink( $item->ID ); ?>">
                <?php } ?>
                    <div class="row no-gutters">
                        <div class="col">
                            <?php echo ucfwp_get_person_thumbnail( $item, 'rounded box-shadow-soft h-75' ); ?>
                        </div>
                        <div class="col p-2">
                            <h3 class="mt-2 mb-1 person-name"><?php echo ucfwp_get_person_name( $item ); ?></h3>
                            <?php if ( $job_title = get_field( 'person_jobtitle', $item->ID ) ): ?>
                            <div class="font-italic person-job-title">
                                <?php echo $job_title; ?>
                            </div>
                            <?php endif; ?>
                            <?php if ( $email = get_field( 'person_email', $item->ID ) ): ?>
                            <div class="person-email">
                                <?php if ( $is_content_empty ) { ?>
                                <a href="mailto:<?php echo $email; ?>">
                                <?php } ?>
                                <?php echo $email; ?>
                                <?php if ( $is_content_empty ) { ?>
                                </a>
                                <?php } ?>
                            </div>
                            <?php endif; ?>
                            <?php if ( $phone = get_field( 'person_phone', $item->ID ) ): ?>
                            <div class="person-job-title">
                                <?php echo $phone; ?>
                            </div>
                            <?php endif; ?>

                            <?php if ( $office = get_field( 'person_office', $item->ID ) ): ?>
                            <div class="person-job-title">
                                <?php echo $office; ?>
                            </div>
                            <?php endif; ?>

                            <?php if ( $facpage = get_field( 'person_faculty_page', $item->ID ) ): ?>
                            <div class="person-job-title">
                                <a href="<?php echo $facpage; ?>">View Full Profile Page</a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php if ( ! $is_content_empty ) { ?>
                </a>
                <?php } ?>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <div class="ucf-post-list-error mb-4">No results found.</div>
        <?php endif; ?>
        <?php
        return ob_get_clean();
    }

	add_filter( 'ucf_post_list_display_leadership', 'ucfwp_post_list_display_leadership', 10, 3 );


    function ucfwp_post_list_display_leadership_after( $content, $items, $atts ) {
        ob_start();
    ?>
    </div>
    <?php
        return ob_get_clean();
    }

	add_filter( 'ucf_post_list_display_leadership_after', 'ucfwp_post_list_display_leadership_after', 10, 3 );

}