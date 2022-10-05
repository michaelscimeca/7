<?php
/***************************************************************
* Remove Extranious WP Content in ths Page Head
***************************************************************/

function normcore_cleanup() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
}

add_action( 'after_setup_theme', 'normcore_cleanup' );

/***************************************************************
* Remove the p tag from Around imgs
***************************************************************/
/* === (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/) === */

function normcore_remove_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

/* ===
* the_content filter is used to filter the content of the post after it is retrieved
* from the database and before it is printed to the screen.
=== */
add_filter( 'the_content', 'normcore_remove_ptags_on_images' );

?>
