<?php
/***************************************************************
* Add Custom Excerpts
****************************************************************/

/* ===
* normcore_excerpt function allows you to control the amout of words in a excerpt.
*
* normcore_excerpt function takes two arguments the length & the string you would
* like to be attached to the end of the excerpt.
=== */
function normcore_excerpt($length_callback = '', $more_callback = '') {
	global $post;

	if (function_exists($length_callback)) {
		add_filter('excerpt_length', $length_callback);
	}

	if (function_exists($more_callback)) {
		add_filter('excerpt_more', $more_callback);
	}

	$output = get_the_excerpt();
	$output = apply_filters('wptexturize', $output);
	$output = apply_filters('convert_chars', $output);
	$output = '<p>' . $output . '</p>';
	echo $output;
}

/* === Custom Length === */
function normcore_amount() {
	return 20;
}

/* === Custom Text === */
function normcore_more_view() {
	global $post;
	return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . 'Read More' . '</a>';
}

/* === Add this exerpt function to shorten the teaser text. === */
// normcore_excerpt('normcore_amount','normcore_more_view');
?>
