<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package normcore
 * @since NormCore 2.0
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
