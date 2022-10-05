<?php
/**
* The template used for displaying page content
*
* @package normcore
* @since NormCore 2.0
*/
?>
<?php
if( have_rows('general_layout') ):
  while ( have_rows('general_layout') ) : the_row(); ?>
  <?php if( get_row_layout() == 'general_hero_layout_section' ): ?>
    <?php get_template_part( 'template-parts/general/content', 'general-hero-layouts-section' ); ?>
  <?php elseif( get_row_layout() == 'image_&_caption_layout' ): ?>
    <?php get_template_part( 'template-parts/general/content', 'image-caption-section' ); ?>
  <?php endif;
endwhile;
endif;
?>
