<?php

/**
 * Generates the HTML for the alphabetical pagination links below the header 
 * on faculty selection pages
 *
 * @param boolean $show_all
 * @return void
 */
function faculty_alphabet_header( $show_all = true ) {

    echo '<nav aria-label="Alphabet Links"><ul class="pagination flex-wrap">';

    foreach ( range( 'a', 'z' ) as $letter) {
        $term = get_term_by( 'slug', $letter, 'letter' );

        if ( $term ) {
            $link = get_term_link( $term );
            if ( ! is_wp_error( $link ) ) {
                if ( $term->count > 0 ) {
                    echo '<li class="page-item"><a class="page-link bg-primary-lighter" href="'.$link.'" data-letter="'.$letter.'">'.strtoupper( $letter ).'</a></li>';
                } else {
                    echo '<li class="page-item"><a class="page-link disabled bg-primary-lighter">'.strtoupper( $letter ).'</a></li>';
                }
            }
        } else {
            echo '<li class="page-item"><a class="page-link disabled bg-primary-lighter">'.strtoupper( $letter ).'</a></li>';
        }
    }
    if ( $show_all ) {
        echo '<li class="page-item"><a class="page-link bg-primary-lighter" href="/directory/">ALL</a></li>';
    }

    echo '</ul></nav>';
}

/**
 * Overrides the default title function to provide a Last Name, First Name
 * format.
 *
 * @param string $title
 * @param integer $id
 * @return string
 */
function fetch_faculty_title($title, $id) {
    if(get_post_type($id) == 'faculty') {
        $name = get_field('name', $id);
        $name = $name[0];
        $title = $name['last'].', '.$name['first'];
    }
    return $title;
}
add_filter('the_title', 'fetch_faculty_title', 10, 2);

/**
 * Modify the main WordPress query when we're looking at the faculty listing
 * so that faculty members are displayed alphabetically rather than by date added
 * 
 * @param WP_Query $query The existing WordPress query object
 */
function cecs_faculty_query( WP_Query $query ) {
    // Directory listing
    if( ! is_admin() && $query->is_main_query() && 
        ( $query->is_post_type_archive( 'faculty' ) || $query->is_tax( 'letter' ) ) ) {
        $query->query_vars['orderby'] = 'meta_value';
        $query->query_vars['order'] = 'ASC';
        $query->query_vars['meta_key'] = 'name_0_last'; // Last name custom field
        $query->query_vars['posts_per_page'] = get_field( 'faculty_per_page', 'option' );
    }
}
add_action( 'pre_get_posts', 'cecs_faculty_query' );

/**
 * Retrieves faculty members as a WP_Query object.
 *
 * @param char $letter (Optional) Limits returned faculty members by the first letter of their last name
 * @return \WP_Query
 */
function cecs_get_faculty_query( $letter = 'a' ) {
    return new WP_Query( array(
        'post_type'     => 'faculty',
        'letter'        => strtolower( $letter ),
        'order'         => 'ASC',
        'orderby'       => 'meta_value',
        'meta_key'      => 'name_0_last',
        'posts_per_page'=> -1
    ));
}

/**
 * Sets the defaut query size when going to the faculty archive (Directory page).
 * Currently set to 30.
 *
 * @param WP_Query $query
 * @return void
 */
function archive_query_size( $query ) {
    if ( $query->is_archive() && $query->is_main_query() && ! is_admin() ) {
        $query->set( 'posts_per_page', 30 );
    }
}
add_action( 'pre_get_posts', 'archive_query_size' );

/**
 * Tries to find the most appropriate leadership title from the faculty member's
 * listed positions, starting with their current listed UCF position. Returns
 * a default generic position if they have nothing entered.
 *
 * @param array $positionArray      Array of all positions from the ACF position 
 *                                  repeater
 * @return string
 */
function faculty_get_display_title( $positionArray ) {
    if ( isset( $positionArray['ucf'] ) ) {
        return $positionArray['ucf'][0];
    }

    if ( isset( $positionArray['leadership'] ) ) {
        return $positionArray['leadership'][0];
    }

    return 'Faculty';
}

/**
 * Generates a name string from the array of ACF values.
 *
 * @param array $metaArray      Array of all ACF values for the post
 * @return string
 */
function faculty_get_display_name( $metaArray ) {
    $name = '';

    if ( $metaArray['name_0_prefix'][0] ) {
        $name = $metaArray['name_0_prefix'][0] . ' ';
    }

    $name .= $metaArray['name_0_first'][0] . ' ' . $metaArray['name_0_last'][0];

    if ( $metaArray['name_0_suffix'][0] ) {
        $name .= ' '.$metaArray['name_0_suffix'][0];
    }

    return $name;
}

/**
 * Function ported from KMDG theme for generating name string.
 *
 * @param string $format    Format options: short, full, minimal
 * @param integer $id       Post ID
 * @return string
 */
function faculty_get_faculty_name( $format = 'short', $id = null ) {
    $name = get_field( 'name', $id );
    $first = empty( $name[0]['first'] ) ? '' : $name[0]['first'];
    $middle = empty( $name[0]['middle'] ) ? '' : $name[0]['middle'];
    $last = empty( $name[0]['last'] ) ? '' : $name[0]['last'];
    $prefix = empty( $name[0]['prefix'] ) ? '' : $name[0]['prefix'];
    $suffix = empty( $name[0]['suffix'] ) ? '' : $name[0]['suffix'];

    if ( $format == 'formal' ) {
        if ( ! empty( $suffix ) ) {
            return $prefix . ' ' . $first . ' ' . $last . ', ' . $suffix;
        } else {
            return $prefix . ' ' . $first . ' ' . $last;
        }
    } elseif ( $format == 'full' ) {
        return $first . ' ' . $middle . ' ' . $last;
    } else {
        return $first . ' ' . $last;
    }
}

/**
 * Checks for a photo for the faculty member - if none is found, returns a 
 * default fallback image.
 *
 * @param integer $id   Post ID
 * @return string
 */
function faculty_get_photo( $id = null ) {
    $thumbnail_id = get_post_thumbnail_id( $id );

    if ( $thumbnail_id ) {
        return wp_get_attachment_url( $thumbnail_id );
    }

    return get_stylesheet_directory_uri() . '/static/img/pegasus.jpg';
}

/**
 * Returns the HTML for the faculty email link. Defaults to standard formatting, 
 * optionally provides white version.
 *
 * @param array $metaArray      Array of all ACF values for the post
 * @param boolean $white
 * @return string
 */
function faculty_get_email( $metaArray, $white = false ) {
    if ( $white ) {
        return '<a class="font-weight-bold text-white" href="mailto:'.$metaArray['email'][0].'">'.$metaArray['email'][0].'</a>';
    }

    return '<a href="mailto:'.$metaArray['email'][0].'">'.$metaArray['email'][0].'</a>';
}

/**
 * Returns a formatted HTML string for the faculty member's website (or a 
 * fallback if no website was entered).
 *
 * @param array $metaArray      Array of all ACF values for the post
 * @return string
 */
function faculty_get_website( $metaArray ) {
    if ( ( $metaArray['website_name'][0] ?? false ) && $metaArray['website'][0] ) {
        return '<a href="'.$metaArray['website'][0].'">'.$metaArray['website_name'][0].'</a>';
    }

    if ( $metaArray['website'][0] ) {
        return '<a href="'.$metaArray['website'][0].'">'.$metaArray['website'][0].'</a>';
    }

    return 'N/A';
}

/**
 * Returns a formatted HTML link for the faculty member's CV (or a fallback)
 * if none is uploaded).
 *
 * @param array $metaArray      Array of all ACF values for the post
 * @return string
 */
function faculty_get_resume( $metaArray ) {
    if ( $metaArray['resume'][0] ) {
        $attachment = get_post( $metaArray['resume'][0] );
        return '<a href="'.$attachment->guid.'">Download CV</a>';
    }

    return 'N/A';
}

/**
 * Builds a grouped array of positions from the overall ACF array. This was
 * developed because the standard ACF repeater appeared to be missing
 * several position categories for multiple family members.
 *
 * @param array $metaArray      Array of all ACF values for the post
 * @return array
 */
function faculty_get_positions( $metaArray ) {
    $grouped = [];
    $groups = [
        'ucf',
        'faculty',
        'advisor',
        'editorial',
        'leadership'
    ];

    if ( isset( $metaArray['positions'] ) && $metaArray['positions'][0] > 0 ) {

        foreach ( $groups as $group ) {
            $positions = $metaArray['positions_0_' . $group][0];

            if ( $positions && is_numeric( $positions ) ) {
                for ( $i=0; $i < $positions; $i++ ) { 
                    $grouped = faculty_add_to_position_group( $grouped, $group, $metaArray['positions_0_'.$group.'_'.$i.'_title'][0] );
                }
            } else if ( $positions ) {
                $positions = unserialize( $metaArray['positions_0_'.$group][0] );

                foreach ( $positions as $position ) {
                    foreach ( $position as $key => $value ) {
                        $grouped = faculty_add_to_position_group( $grouped, $group, $value );
                    }
                }
            }
        }
    }

    return $grouped;
}

/**
 * Helper function to add new elements to the specified group. Creates a new
 * key if it doesn't already exist.
 *
 * @param array $positionArray
 * @param string $group
 * @param string $title
 * @return array
 */
function faculty_add_to_position_group( $positionArray, $group, $title ) {
    if ( isset( $positionArray[$group] ) ) {
        array_push( $positionArray[$group], $title );
    } else {
        $positionArray[$group] = [$title];
    }

    return $positionArray;
}

/**
 * Checks to see whether the faculty member has any positions entered.
 *
 * @param array $positionArray
 * @return integer
 */
function faculty_has_positions( $positionArray ) {
    if ( count( $positionArray ) ) {
        $groups = [
            'ucf',
            'faculty',
            'advisor',
            'editorial',
            'leadership'
        ];
    
        $count = 0;
    
        foreach ( $groups as $group ) {
            $count += count( $positionArray[$group] ?? [] );
        }
    
        return $count;
    }

    return 0;
}

/**
 * Builds an array of education rows from the ACF array
 *
 * @param array $metaArray
 * @return array
 */
function faculty_get_education( $metaArray ) {
    $educationArray = [];

    if ( isset( $metaArray['education'] ) && $metaArray['education'][0] > 0 ) {
        for ( $i=0; $i < $metaArray['education'][0]; $i++ ) { 
            $education = [
                'degree_level' => $metaArray['education_'.$i.'_degree_level'][0],
                'field' => $metaArray['education_'.$i.'_field'][0],
                'institution' => $metaArray['education_'.$i.'_institution'][0]
            ];

            array_push( $educationArray, $education );
        }
    }

    return $educationArray;
}

/**
 * Builds an array of publication rows from the ACF array
 *
 * @param array $metaArray
 * @return array
 */
function faculty_get_publications( $metaArray ) {
    $publicationArray = [];

    if ( isset( $metaArray['publications'] ) && $metaArray['publications'][0] > 0 ) {
        for ( $i=0; $i < $metaArray['publications'][0]; $i++ ) { 
            $publication = [
                'citation' => $metaArray['publications_'.$i.'_citation'][0],
                'year' => $metaArray['publications_'.$i.'_year'][0],
                'link' => $metaArray['publications_'.$i.'_link'][0],
            ];

            array_push( $publicationArray, $publication);
        }
    }

    return $publicationArray;
}

/**
 * Returns formatted HTML links for the specified platform
 *
 * @param array $metaArray
 * @param string $social
 * @return string
 */
function faculty_get_social( $metaArray, $social ) {
    if ( 'youtube' == $social ) {
        if ( $metaArray['youtube_channel'][0] && $metaArray['youtube_link'][0] ) {
            return '<a href="'.$metaArray['youtube_link'][0].'">'.$metaArray['youtube_channel'][0].'</a>';
        }

        if ( $metaArray['youtube_link'][0] ) {
            return '<a href="'.$metaArray['youtube_link'][0].'">'.$metaArray['youtube_link'][0].'</a>';
        }

        return 'N/A';
    }

    if ( 'twitter' == $social ) {
        if ( $metaArray['twitter_url'][0] && $metaArray['twitter_handle'][0] ) {
            return '<a href="'.$metaArray['twitter_url'][0].'">'.$metaArray['twitter_handle'][0].'</a>';
        }

        if ( $metaArray['twitter_url'][0] ) {
            return '<a href="'.$metaArray['twitter_url'][0].'">'.$metaArray['twitter_url'][0].'</a>';
        }

        return 'N/A';
    }
}

/**
 * Returns the letter for header on the alphabetical faculty lookup
 *
 * @param [type] $obj
 * @return string
 */
function faculty_get_letter( $obj ) {
    global $wp_query;

    if ( $wp_query->is_post_type_archive ) {
        return '';
    } else {
        return ' - '.$obj->name;
    }
}

function faculty_set_letter($post_id){
    
    $name = get_field('name', $post_id);
    $name = $name[0];
    $letter = strtoupper(substr(sanitize_title($name['last']), 0, 1));
    wp_set_object_terms( $post_id, $letter, 'letter', false );
    return $post_id;
}

add_action('save_post_faculty','faculty_set_letter');