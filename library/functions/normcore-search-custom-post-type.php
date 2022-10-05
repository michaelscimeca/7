<?php
/***************************************************************
* Make Custom Post Types searchable
****************************************************************/

/* === Adds support for custom post type search results. === */
function normcore_search_all( $query ) {
    if ( $query->is_search ) {
        $query->set(
            'post_type',
             array(
                'site',
                'plugin',
                'theme',
                'person'
            )
        );
    }
    return $query;
}

/* === pre_get_posts hook gives developers access to the $query object by reference === */
// add_action( 'pre_get_posts', 'normcore_search_all' );
?>
