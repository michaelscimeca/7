<?php
/* Template Name: Show page

* The template for displaying about pages
*
* This is the template that displays all pages by default.
* Please note that this is the WordPress construct of pages and that
* other "pages" on your WordPress site will use a different template.
*
* @package normcore
* @since NormCore 2.0
*/

get_header(); ?>

<div id="show" class="content">

	<?php
	// Start the loop.
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
		// Include the page content template.
		get_template_part( 'template-parts/content', 'show' );
		// End of the loop.
	endwhile;
	else :
		echo '<p>No Page Found</p>';
	endif;
	?>

</div><!-- .content -->

<?php get_footer(); ?>
