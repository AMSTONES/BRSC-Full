<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BRSC
 */

get_header();
?>

  <main id="primary" class="site-main">
    <?php if ( have_posts() ) : ?>
      <header class="page-header">
        <?php
        the_archive_title( '<h1 class="page-title">', '</h1>' );
        the_archive_description( '<div class="archive-description">', '</div>' );
        ?>
      </header><!-- .page-header -->
      <div class='feed-container'>
      <?
      $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
      $query = new WP_Query( array(
      'post_type' => 'announcement',
      'post_status' => 'publish',
      'posts_per_page' => 3,
      'paged' => $paged,
      // 'meta_key' => 'event_time',
      // 'orderby' => 'meta_value',
      // 'order' => 'ASC'
    ) );
      /* Start the Loop */
      while ( $query->have_posts() ) :
        $query->the_post();

        /*
         * Include the Post-Type-specific template for the content.
         * If you want to override this in a child theme, then include a file
         * called content-___.php (where ___ is the Post Type name) and that will be used instead.
         */

        ?>
        <div class="feed-post-wrap">
            <h2 class="feed-type"><?php esc_html_e($title)?></h2>
          <div class="feed-post brsc-rounded">
            <? if ( has_post_thumbnail() ) { ?>
              <a href="<?php esc_url(the_permalink())?>">
                <? the_post_thumbnail('post-thumbnail', array('class' => 'feed-thumbnail')); ?>
              </a>
            <? } ?>
            <div class="feed-text-area">
            <h2 class="feed-title">
              <a href="<?php esc_url(the_permalink())?>"><?php the_title() ?></a>
            </h2>
              <? display_race_time(); ?>
              <? display_excerpt(); ?>
              <? display_price()?>
              <? display_description(); ?>
              <a class='feed-read-more' href="<?php esc_url(the_permalink())?>">Read more</a>
            </div>
          </div>
        </div>
      <?
      endwhile;
      ?>
      </div>


      <?
      //the_posts_navigation();
      the_posts_pagination( array(
        'prev_text'          => __( 'Previous page', 'cm' ),
        'next_text'          => __( 'Next page', 'cm' ),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'cm' ) . ' </span>',
      ) );
    else :

      get_template_part( 'template-parts/content', 'none' );

    endif;
    ?>

  </main><!-- #main -->

<?php
get_sidebar();
get_footer();
