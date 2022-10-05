<?php
/***************************************************************
* Loading CSS / JS dynamically
****************************************************************/

/* === Register & Enqueue the Scripts & Styles. === */
function normcore_load_js_css() {
  if (!is_admin()) {
    function env($file) {
      return get_stylesheet_directory_uri() . (get_site_url() === 'localost:3000' ? '/dev' : '/dev') . $file;
    }
    function time_v($file) {
      return filemtime( get_stylesheet_directory() . $file );
    }
    /* === CUSTOM FONTS === */
    wp_register_style('rsqdefault_fonts', 'https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700;800', array(), '', 'all');

		/* === STYLESHEET === */
		wp_register_style(
     'rsqdefault_stylesheet',
      env('/css/app.css'),
      [],
      time_v('/dist/css/app.css') . "2",
      'all'
    );

		/* === JAVASCRIPT === */
		wp_register_script(
      'rsqdefault_js',
      env('/js/app.js'),
      [],
      time_v('/dist/js/app.js') . "2",
      true
    );

		/* === enqueuing styles and scripts  === */
    wp_enqueue_script('rsqdefault_js');
    wp_enqueue_style('rsqdefault_fonts');
		wp_enqueue_style('rsqdefault_stylesheet');
    }
 }

 /* ===
 * wp_enqueue_scripts is the proper hook to use when enqueuing
 * items that are meant to appear on the front end.
 === */
 add_action( 'wp_enqueue_scripts', 'normcore_load_js_css' );

?>
