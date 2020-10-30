<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BRSC
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-content-wrap">
    <div class="entry-content">
      <header class="entry-header">
    <?php
    if ( is_singular() ) :
      the_title( '<h1 class="entry-title">', '</h1>' );
    else :
      the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    endif;

    if ( 'post' === get_post_type() ) :
      ?>
      <div class="entry-meta">
        <?php
        brsc_posted_on();
        brsc_posted_by();
        ?>
      </div><!-- .entry-meta -->
    <?php endif; ?>
  </header><!-- .entry-header -->
  <? $fields = get_fields(); ?>
   <?php brsc_post_thumbnail(); ?>
    <div class="market-item-wrap">
      <h2 class="market-item-price"><? esc_html_e('£' . $fields['price']); ?></h2>
      <p class="market-item-description"><? esc_html_e($fields['item_description']); ?></p>
      <p class="market-item-number"><?  esc_html_e('Contact number: ' . $fields['contact_number']); ?></p>
      <p class="market-item-email">
        <a href="mailto:<? esc_html_e($fields['contact_email']); ?>">
          <? esc_html_e($fields['contact_email']); ?>
        </a>
      </p>
    </div>
    <?
        //
        // //print_r($fields);
        //
        // esc_html_e($fields['item_description']);
        //
        // esc_html_e($fields['contact_number']);
        //
        // esc_html_e($fields['contact_email']);
        //display_market_card_func($fields);

      wp_link_pages(
        array(
          'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'brsc' ),
          'after'  => '</div>',
        )
      );
      ?>
    </div><!-- .entry-content -->
  </div>
  <!-- <h1>content-marketplace-item.php</h1> -->
  <footer class="entry-footer">
    <?php brsc_entry_footer(); ?>
  </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
