<?php
/***************************************************************
* Add Elements to the Toolbar
****************************************************************/

/* === Adds links to the Toolbar that lines the top of WordPress sites when signed in. === */
function normcore_add_admin_bar() {
	global $wp_admin_bar;
	/* === Add custom logo to Toolbar  === */
	$wp_admin_bar->add_menu( array(
		'id'    => 'logo',
		'title' => '<img style="height:20px; float: left; width:20px; top:6px; position:relative; padding-right:10px;" src="https://www.fillmurray.com/20/20
"/>' . get_bloginfo('name'),
		'href'  => admin_url()
	));
	/* === Add Sub link to Toolbar === */
	$wp_admin_bar->add_menu( array(
		'id'    => 'link',
		'title' => '',
		'href'  => 'http://rsq.com',
		'parent'=> 'my-link'
	));
}

/* === Fires before the admin bar is rendered. === */
// add_action( 'wp_before_admin_bar_render', 'normcore_add_admin_bar' );

/***************************************************************
* Remove Elements from the Top Admin Bar
***************************************************************/
/* === Removes the default links from the Toolbar. === */
function normcore_remove_admin_bar() {
	global $wp_admin_bar;
	$arg = array(
		'new-content',
		'wp-logo',
		'comments',
		'view',
		'site-name',
		// 'updates'
	);

	foreach($arg as $value){
		$wp_admin_bar->remove_menu( $value );
	}
}

/* === Fires before the admin bar is rendered. === */
add_action('wp_before_admin_bar_render', 'normcore_remove_admin_bar', 0);
?>
