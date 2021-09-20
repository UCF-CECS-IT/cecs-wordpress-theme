<?php
global $wp_query;
$obj        = ucfwp_get_queried_object();
$images     = ucfwp_get_header_images( $obj );
$header_content_type = ucfwp_get_header_content_type( $obj );
$header_height       = get_field( 'page_header_height', $obj );
$exclude_nav         = get_field( 'page_header_exclude_nav', $obj );
$letter = faculty_get_letter($obj);


if ( !$exclude_nav ) { echo ucfwp_get_nav_markup( false ); }

?>

