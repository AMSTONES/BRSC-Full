<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BRSC
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>



  <header class="entry-header">
	 <?php get_template_part('template-parts/content', 'banner'); ?>
  </header><!-- .entry-header -->
  <div class="entry-content-wrap">
    <div class="entry-content">
      <? if (!is_front_page() ) : ?>
          <h1 class="page-title"><?php single_post_title(); ?></h1>
      <? endif;
      the_content();
      $children = get_pages( array( 'child_of' => $post->ID ) );
      if ( is_page() && count( $children ) > 0 ) { echo( do_shortcode('[display-nav-image-grid]')); };
      wp_link_pages(
        array(
          'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'brsc' ),
          'after'  => '</div>',
        )
      );
      ?>
    </div><!-- .entry-content -->
  </div>


	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'brsc' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
