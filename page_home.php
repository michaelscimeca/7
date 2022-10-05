<?php
/* Template Name: Home page

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
<div data-router-view="home" <?php body_class(); ?>>

<div id="home" data-scroll-container>
	<?php
	// Start the loop.
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
		// Include the page content template.
		get_template_part( 'template-parts/content', 'home' );
		// End of the loop.
	endwhile;
	else :
		echo '<p>No Page Found</p>';
	endif;
	?>
</div><!-- .content -->

</div>

<?php get_footer(); ?>
