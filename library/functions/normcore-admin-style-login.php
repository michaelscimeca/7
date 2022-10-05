<?php
/***************************************************************
*  Add Custom Style to the Admin Login Page
****************************************************************/
/* === https://codex.wordpress.org/Customizing_the_Login_Form === */

/* === Adds override classes to the Login page. === */
function normcore_login_styles() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/admin-login.css" />';
 }

 /* === login_head is an hook that allows you to add stuff in the login header. === */
add_action( 'login_head', 'normcore_login_styles' );
?>
