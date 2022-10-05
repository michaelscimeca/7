<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package normcore
 * @since NormCore 2.0
 */

get_header(); ?>

	<div id="four-oh-four" class="content">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title">Oops! That page can&rsquo;t be found.</h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p>It looks like nothing was found at this location. Maybe try a search?</p>

				<?php get_search_form(); ?>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</div><!-- .content -->

<?php get_footer(); ?>
