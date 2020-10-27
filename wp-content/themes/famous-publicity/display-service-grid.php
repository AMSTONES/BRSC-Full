<?
  function display_image_grid_func() {
    $args = array(
        'post_type' => 'service',
        'post_status' => 'publish',
        'posts_per_page' => 9,
        'orderby' => 'ID',
        'order' => 'ASC',
    );

    $loop = new WP_Query( $args );
    ob_start(); ?>
    <section class="fp-section services">
      <div class="bw-image-grid row"> <?
        while ( $loop->have_posts() ) : $loop->the_post(); ?>
          <div class="bw-image-box col-12 col-md-6 col-lg-4">
            <a class="service-link" href="<? echo esc_url( get_page_link( get_page_by_path('services')) . '#service-no-' . get_the_ID() ); ?>">
              <div class="bw-text-container">
                <h2><?esc_html_e (the_title());?></h2>
              </div>
              <?the_post_thumbnail( $size = 'post-thumbnail', $attr = ['class' => 'service-greyscale'] );?>
            </a>
          </div>
        <? endwhile; ?>
      </div>
    </section>

    </div>

    <?
    wp_reset_postdata();

    $ob_str=ob_get_contents();
    ob_end_clean();
    return $ob_str;
  }
?>
