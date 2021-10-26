<?php

/**
 * Adds dropdown filter for scholarship College Group field
 *
 * @since 1.0.29
 * @return void
 */
function scholarship_college_group_dropdown() {
    // Do not add filter to post types other than scholarship
    if ($_GET['post_type'] !== 'scholarship' )
        return;

    $selected = filter_input(INPUT_GET, 'college_group', FILTER_SANITIZE_STRING);

    $choices = [
        'cece' => 'Civil, Construction, & Environmental Engineering Scholarships',
        'ece' => 'Electrical & Computer Engineering Scholarships',
        'ce' => 'College of Engineering Scholarships',
        'cecs-grad' => 'College of Engineering & Computer Science Graduate Scholarships',
        'cecs-diversity' => 'College of Engineering & Computer Science Diversity Scholarships',
        'ce-incoming' => 'College of Engineering Incoming Freshmen Scholarships'
    ];

    echo '<select name="college_group">';
    echo '<option value="all" ' . (($selected == 'all') ? 'selected="selected"' : "") . '>All Scholarships</option>';
    foreach ($choices as $key => $value) {
        echo '<option value="' . $key . '" ' . (($selected == $key) ? 'selected="selected"' : "") . '>' . $value . '</option>';
    }
    echo '</select>';
}
add_action('restrict_manage_posts', 'scholarship_college_group_dropdown');

/**
 * Filters Scholarship edit page list by college group
 *
 * @param WP_Query $query
 * @return void
 */
function scholarship_college_group_filter($query) {
    if ( is_admin() && $query->is_main_query() ) {
        if ($_GET['post_type'] !== 'scholarship' )
            return;

        if ( filter_input(INPUT_GET, 'filter_action', FILTER_SANITIZE_STRING) !== 'Filter' ) 
            return;

        if ( isset( $_GET['college_group'] ) && $_GET['college_group'] != 'all' ) {
            $query->set( 'meta_query', array( array(
                'key' => 'college_group',
                'value' => sanitize_text_field( $_GET['college_group'] )
            ) ) );
        }
    }
}
add_action('pre_get_posts','scholarship_college_group_filter'); 