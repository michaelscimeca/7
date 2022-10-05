<?php
/***************************************************************
* Page Titles
****************************************************************/
function enable_page_title() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'enable_page_title' );
?>
