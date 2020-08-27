<?php

/**
 * Displays either the faculty member's showcase thumbnail or the standard
 * headshot fallback if that fails.
 *
 * @param integer $id
 * @return string
 */
function showcase_get_photo($id = null) {
    $fallback = get_stylesheet_directory_uri() . '/static/img/knight.png';
    
    if (!has_post_thumbnail($id)) {
        return $fallback;
    }

    return get_the_post_thumbnail_url($id);
}

/**
 * Strips off video ID from a Youtube link for the purpose of converting a
 * regular video link into an embedded link. Retuns false if the link is not
 * for Youtube.
 *
 * @param string $embed
 * @return string|boolean
 */
function showcase_get_youtube_id($embed) {
    $matches = array();

    if(preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $embed, $matches)) {
        return $matches[1];
    }

    return false;
}

/**
 * Strips off video ID from a Vimeo link for the purpose of converting a
 * regular video link into an embedded link. Retuns false if the link is not
 * for Vimeo.
 *
 * @param string $embed
 * @return string|boolean
 */
function showcase_get_vimeo_id($embed) {
    $matches = array();

    if(preg_match("/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/", $embed, $matches)) {
        return $matches[5];
    }

    return false;
}

/**
 * Tests for cache hit, then checks the video type and returns the embeddable
 * ID string.
 *
 * @param string $embeddedUrl
 * @return object
 */
function showcase_get_video_info($embeddedUrl) {
    $data = wp_cache_get($embeddedUrl);

    if ($data === false) {
        $data = (object)array();

        $youtube = showcase_get_youtube_id($embeddedUrl);
        $vimeo = showcase_get_vimeo_id($embeddedUrl);

        if ($youtube !== false) {
            $data->type = 'youtube';
            $data->id = $youtube;
            
        }
        elseif($vimeo !== false) {
            $data->type = 'vimeo';
            $data->id = $vimeo;
        } else {
            $data->type = false;
            $data->id = null;
        }

        $data->embed = $embeddedUrl;
        wp_cache_set($embeddedUrl, $data);

    }
    return $data;
}