<?php
/***************************************************************
* Remove Dashboard Widget features
***************************************************************/

/* === Removes the defualt metaboxs in the Dashbaord === */
function normcore_remove_widget_box() {
    remove_meta_box( 'dashboard_activity',    'dashboard', 'normal' );      // Activity
    remove_meta_box( 'dashboard_primary',     'dashboard', 'side' );        // WordPress News
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );        // Quick Draft
    remove_meta_box( 'dashboard_right_now',   'dashboard', 'normal' );      // At a Glance
}

/* === Fires after core widgets for the admin dashboard have been registered. === */
// add_action( 'wp_dashboard_setup', 'normcore_remove_widget_box' );

/***************************************************************
* Added Dashboard Widget features
***************************************************************/

/* === Adds a widget === */
function normcore_add_widgets() {
  /* === string widget_id , $widget_name , $callback === */
   wp_add_dashboard_widget( 'dashboard_widget', 'TEST', 'normcore_dashboard_widget_function' );
}
/* === Display the widget info. === */
function normcore_dashboard_widget_function() {
   echo '<div class="admin">TEST</div>';
}

/* === Fires after core widgets for the admin dashboard have been registered. === */
// add_action('wp_dashboard_setup', 'normcore_add_widgets');
?>
