<?php
/**
* The template part for displaying single posts
*
* @package normcore
* @since NormCore 2.0
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('hero-end-state js-hidden-section js-hidden'); ?>>
	<div class="row">
		<div class="small-12 column">

			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
				the_content();
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">Pages:</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">Page </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );
				?>
			</div><!-- .entry-content -->

		</div>
	</div>

</article><!-- #post-## -->
