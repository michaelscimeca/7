<?php
/***************************************************************
* Go back to Clasic Editor
****************************************************************/
// Disable Gutenburg for posts
add_filter('use_block_editor_for_post', '__return_false', 10);
// Disable Gutenburg for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);
?>
