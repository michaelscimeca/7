<?php
/***************************************************************
* Enable Support for Post Formats
****************************************************************/
/* === https://codex.wordpress.org/Post_Formats === */

/* === Adds theme support for post formats. === */
function normcore_custom_post_formats() {

     add_theme_support( 'post-formats', array(
 	// 	'aside',
 		'image',
 	// 	'video',
 	// 	'quote',
 	// 	'link',
 	// 	'gallery',
 	// 	'status',
 	// 	'audio',
 	// 	'chat',
 	) );

}
/* === after_setup_theme hook fires after the theme is loaded. === */
add_action( 'after_setup_theme', 'normcore_custom_post_formats' );
?>
