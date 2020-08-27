<?php

/**
 * This array translates the old KMDG page builder section color options
 * into new values that roughly map to the UCF WP theme colors:
 * 
 *      KMDG Hex Code => Athena BG class
 */
define('KMDG_BG_OPTIONS', [
    '#ededa1' => 'bg-primary-lightest',
    '#efefef' => 'bg-primary-lightest',
    '#c9c9c9' => 'bg-default',
    '#a0a0a0' => 'bg-default',
    '#f4df22' => 'bg-primary',
    '#ededed' => 'bg-primary-lightest',
    '#f4f4d4' => 'bg-primary-lightest',
    '#f4d249' => 'bg-primary',
    '#1e73be' => 'bg-complementary',
]);

/**
 * Checks to see if the default format for a column should be displayed, or 
 * the formatted version.
 *
 * @param array $options
 * @return boolean
 */
function kmdg_is_layout_formatted($options) {
    if ($options['preset'] != 'none' || 
        $options['bgcolor'] != '#ffffff' || 
        ($options['title_bgcolor'] ?? false) != '#ffffff') {
        return true;
    }

    return false;
}

/**
 * Sets a background, based on either direct BG options or the KMDG builder
 * theme selection.
 *
 * @param array $options
 * @param string $element
 * @return string
 */
function kmdg_get_background($options, $element = 'bgcolor') {
    if ($options['preset'] == 'none') {
        return KMDG_BG_OPTIONS[$options[$element]] ?? '';
    } else {
        return kmdg_get_theme($options, $element);
    }
}

/**
 * Returns the correct Athena class based on the KMDG builder theme selected.
 *
 * @param array $options
 * @param string $element
 * @return string
 */
function kmdg_get_theme($options, $element) {
    // if ($options['preset'] == 'theme1') {
    //     if ($element == 'bgcolor') {
    //         return 'bg-primary-lightest';
    //     }
    //     if ($element == 'title_bgcolor') {
    //         return 'bg-primary';
    //     }
    // }

    if ($options['preset'] == 'theme2') {
        if ($element == 'bgcolor') {
            return 'bg-primary-lightest';
        }
        if ($element == 'title_bgcolor') {
            return 'bg-primary';
        }
    }

    if ($options['preset'] == 'theme3') {
        if ($element == 'bgcolor') {
            return 'bg-primary-lightest';
        }
        if ($element == 'title_bgcolor') {
            return 'bg-inverse';
        }
    }

    if ($options['preset'] == 'theme4') {
        if ($element == 'bgcolor') {
            return 'bg-primary-lightest';
        }
        if ($element == 'title_bgcolor') {
            return 'bg-primary';
        }
    }

    return;
}

/**
 * Returns the number of columns in a KMDG builder row that have header values
 *
 * @param array $firstColumnObject
 * @param array $secondColumnObject
 * @param array $thirdColumnObject
 * @return integer
 */
function kmdg_count_column_headers($firstColumnObject, $secondColumnObject, $thirdColumnObject = null) {
    $columns = [$firstColumnObject, $secondColumnObject, $thirdColumnObject];
    $count = 0;

    foreach ($columns as $column) {
        if ($column['value'][0]['title'] ?? false) {
            $count++;
        }
    }

    return $count;
}


