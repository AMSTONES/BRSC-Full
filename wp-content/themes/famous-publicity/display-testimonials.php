<?
  function display_testimonials_func() {
    ob_start();
    ?>
    <section class="fp-section testimonials">
      <h2>Testimonials</h2>
        <div class="container testimonial-body">
          <div class="testimonial-quote-container">
            <i class="fas fa-quote-left testimonial-quote quote-center"></i>
              <p class="testimonial-text"></p>
            <i class="fas fa-quote-right testimonial-quote quote-center"></i>
          </div>
          <h3 class="testimonial-author"></h3>
        </div>
    </section>
      <?
    $ob_str=ob_get_contents();
    ob_end_clean();
    return $ob_str;
    }

function elv_quote_display() {

  $query = new WP_Query( array( 'post_type' => 'testimonial' ) );
  $data = [];
      while ( $query->have_posts() ) : $query->the_post();
          array_push($data, ['testimonial' => get_field('testimonial'),
            'author' => get_field('author')
          ]);
  endwhile;

  //wp_enqueue_script ('jquery');

  // initialise our own script
  $elv_quote = plugins_url('quote-display.js', __FILE__);
  wp_enqueue_script ('elv_quote', $elv_quote, '', '', true);

  // transfer data to JavaScript
  $elv_data = array (
  'testimonials' => $data,
  'elv_class' => get_option ('elv_class'));

  wp_localize_script ('elv_quote', 'elv_data', $elv_data);

  wp_reset_postdata();
}
add_action ('get_footer', 'elv_quote_display');
