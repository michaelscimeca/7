<?php
/***************************************************************
* Custom Post Type helper
***************************************************************/

/* === Passing in an array of arrays containing values for 'name', 'singular', and 'slug', will create custom post types === */
function normcore_custom_post_types($array){

  for ($i=0; $i < count($array); $i++) {
    $labels = array(
      "name" => $array[$i]['name'],
      "singular_name" => $array[$i]['singular'],
      'add_new_item' =>  $array[$i]['add_new_item'],
      'add_new' =>  $array[$i]['add_new'],
      'edit_item' => $array[$i]['edit_item']
    );

    $args = array(
      "labels" => $labels,
      "description" => (isset($array[$i]['desc'])) ? $array[$i]['desc'] : "",
      "public" => (isset($array[$i]['public'])) ? $array[$i]['public'] : true,
      "show_ui" => (isset($array[$i]['show_ui'])) ? $array[$i]['show_ui'] : true,
      "show_in_rest" => (isset($array[$i]['show_in_rest'])) ? $array[$i]['show_in_rest'] : false,
      "has_archive" => (isset($array[$i]['has_archive'])) ? $array[$i]['has_archive'] : true,
      "show_in_menu" => (isset($array[$i]['show_in_menu'])) ? $array[$i]['show_in_menu'] : true,
      "menu_position" => (isset($array[$i]['position'])) ? $array[$i]['position'] : 25,
      "exclude_from_search" => (isset($array[$i]['exclude_from_search'])) ? $array[$i]['exclude_from_search'] : false,
      "capability_type" => (isset($array[$i]['capability_type'])) ? $array[$i]['capability_type'] : "post",
      "map_meta_cap" => (isset($array[$i]['map_meta_cap'])) ? $array[$i]['map_meta_cap'] : true,
      "hierarchical" => (isset($array[$i]['hierarchical'])) ? $array[$i]['hierarchical'] : false,
      "rewrite" => array( "slug" => $array[$i]['slug'], "with_front" => true ),
      "query_var" => (isset($array[$i]['query_var'])) ? $array[$i]['query_var'] : true
    );

    if (isset($array[$i]['taxonomies'])) {
      $args['taxonomies'] = array('category');
    }

    register_post_type( $array[$i]['slug'], $args );
  }
}
/***************************************************************
* Create Custom Post Types
***************************************************************/

 /* ===
 * Add to the array $postTypes the three needed values
 * and a custom post will be created === */
function normcore_create_post_types(){
  $postTypes = array(
    array(
      'name' => 'Tours',
      'singular' => 'Tours',
      'slug' => 'tours',
      'add_new_item' => 'Add Tour',
      'add_new' => 'Add Tour',
      'edit_item' => 'Edit Tour'
    ),
    array(
      'name' => 'Hero Videos',
      'singular' => 'Hero-Videos',
      'slug' => 'hero-videos',
      'add_new_item' => 'Add video',
      'add_new' => 'Add video',
      'edit_item' => 'Edit video'
    )
  );

  normcore_custom_post_types($postTypes);
}

/* === Fires after WordPress has finished loading but before any headers are sent. === */
add_action( 'init', 'normcore_create_post_types' );
?>