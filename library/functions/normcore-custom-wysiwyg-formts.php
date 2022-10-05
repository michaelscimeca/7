<?php
function my_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
// Register our callback to the appropriate filter
add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );

function tuts_mce_editor_buttons( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}

function tuts_mce_before_init( $settings ) {
	$style_formats = array(
		array(
			'title' => 'Call Out',
			'block' => 'div',
			'classes' => 'callout',
			'wrapper' => true
		)
	);

	$settings['style_formats'] = json_encode( $style_formats );

	return $settings;
}

add_filter( 'tiny_mce_before_init', 'tuts_mce_before_init' );
?>
