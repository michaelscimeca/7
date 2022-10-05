<?php
/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 */
function normcore_widgets_init() {
	register_sidebar( array(
		'name'          => 'Footer',
		'id'            => 'footer-1',
		'description'   => 'Add widgets here to appear in your footer.',
		'before_widget' => '<div id="%1$s" class="widget small-12 medium-6 large-4 columns %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

  add_action( 'widgets_init', 'normcore_widgets_init' );

  function teaserWidgetAddToForm($widget_instance) {
  ?>
  <label for="<?php echo $widget_instance->get_field_id('teaser-classname'); ?>">Custom Background:</label>
  <input type="text" id="<?php echo $widget_instance->get_field_id('custom-bg'); ?>" name="<?php echo $widget_instance->get_field_name('custom-bg'); ?>">
  <?php
  }


  add_action('in_widget_form', 'teaserWidgetAddToForm');


?>
