<?php
/***************************************************************
* Custom Nav
****************************************************************/

function wpb_custom_new_menu() {
  register_nav_menu('my-main-menu',__( 'Main Nav' ));
}

add_action( 'init', 'wpb_custom_new_menu' );

?>
