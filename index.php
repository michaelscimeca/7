<?php get_header(); ?>
<div class="content">
	<?php if ( have_posts() ) :
		// if this is the main page of the site show this content
		if ( is_home() && ! is_front_page() ) : ?>
		<header>
			<h1 class="page-title"><?php single_post_title(); ?></h1>
		</header>
	<?php endif;

	// Start the loop.
	while ( have_posts() ) : the_post();

	/*
	* Include the Post-Format-specific template for the content.
	* called content-___.php (where ___ is the Post Format name) and that will be used instead.
	*/
	get_template_part( 'template-parts/content', get_post_format() );

	// End the loop.
endwhile;

// Previous/next page navigation.
the_posts_pagination( array(
	'prev_text'          => 'Previous page',
	'next_text'          => 'Next page',
	'before_page_number' => '<span class="meta-nav screen-reader-text">' .'Page' . ' </span>',
) );

// If no content, include the "No posts found" template.
else :
	get_template_part( 'template-parts/content', 'none' );

endif;
?>

</div> <!-- .content -->
<?php get_footer(); ?>
