<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BRSC
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-content-wrap">
    <div class="entry-content">
      <header class="entry-header brsc-center-text">
        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

        <?php if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta">
          <?php
          brsc_posted_on();
          brsc_posted_by();
          ?>
        </div><!-- .entry-meta -->
        <?php endif; ?>
      </header><!-- .entry-header -->

      <?php if (has_post_thumbnail()) { ?>
        <a href="<?php esc_url(the_permalink())?>">
          <? the_post_thumbnail('medium', array('class' => 'image-search-result')); ?>
        </a>
      <? } ?>
      <div class="entry-summary">
        <?php the_excerpt(); ?>
      </div><!-- .entry-summary -->

      <footer class="entry-footer">
        <?php brsc_entry_footer(); ?>
      </footer><!-- .entry-footer -->
    </div><!-- .entry-content -->
  </div><!-- .entry-content-wrap -->
</article><!-- #post-<?php the_ID(); ?> -->
