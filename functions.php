<?php
/*
Author: rsq
URL: http://rsq.com
*/
/***************************************************************
* Home Page Title
****************************************************************/
require_once( 'library/functions/normcore-title.php' );

/***************************************************************
* Clean up WP defaults
****************************************************************/
require_once( 'library/functions/normcore-cleanup.php' );

/***************************************************************
* Create custom post types
****************************************************************/
require_once( 'library/functions/normcore-custom-post-types.php' );

/***************************************************************
* Create custom post formats
****************************************************************/
require_once( 'library/functions/normcore-post-formats.php' );

/***************************************************************
* Loading CSS / JS dynamically
****************************************************************/
require_once( 'library/functions/normcore-load-js-css.php' );

/***************************************************************
* Admin Menu Setup
****************************************************************/
require_once( 'library/functions/normcore-admin-menu.php' );

/***************************************************************
* Widget features Setup
***************************************************************/
require_once( 'library/functions/normcore-admin-widgets.php' );

/***************************************************************
* Top Admin bar elements Setup
****************************************************************/
// require_once( 'library/functions/normcore-admin-bar.php' );

/***************************************************************
* Change styling on Login page
****************************************************************/
require_once( 'library/functions/normcore-admin-style-login.php' );

/***************************************************************
* Make custom Post Types searchable
****************************************************************/
require_once( 'library/functions/normcore-search-custom-post-type.php' );

/***************************************************************
* Remove Gutenburg Editor
****************************************************************/
require_once( 'library/functions/normcore-remove-gutenburg.php' );

/***************************************************************
* Customized Wysiwyg-Formts
****************************************************************/
require_once( 'library/functions/normcore-custom-wysiwyg-formts.php' );

/***************************************************************
* Remove Migrate Jquery
****************************************************************/
require_once( 'library/functions/normcore-remove-migrate-jquery.php' );

/***************************************************************
* Remove Migrate Jquery
****************************************************************/
require_once( 'library/functions/normcore-custom-nav.php' );

/***************************************************************
* Customized Excerpt function
****************************************************************/
// require_once( 'library/functions/normcore-custom-excerpt.php' );

if ( ! isset( $content_width ) ) { $content_width = 1600; }

  add_filter( 'rest_endpoints', function( $endpoints ){
    if ( isset( $endpoints['/wp/v2/users'] ) ) {
        unset( $endpoints['/wp/v2/users'] );
    }
    if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
        unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
    }
    return $endpoints;
});
?>
