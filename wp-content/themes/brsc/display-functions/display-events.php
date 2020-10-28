<?

function display_events_func(){
  $query = new WP_Query( array(
      'post_type' => 'event',
      'post_status' => 'publish',
      'meta_key' => 'event_time',
      'orderby' => 'meta_value',
      'order' => 'ASC'
    ) );
  ob_start(); ?>
    <table class='event-table'>
      <tr>
        <th>Event name</th>
        <th>Event time</th>
        <!-- <th>Event description</th> -->
        <th>Location</th>
      </tr>

    <?php if ( $query->have_posts() ) :
      while ( $query->have_posts() ) : $query->the_post();
        ?>
        <tr>
          <td><? the_title(); ?></td>
          <td><? esc_html_e(get_field('event_time'));?></td>
          <!-- <td><?//esc_html_e(get_field('description'));?></td> -->
          <td><?esc_html_e(get_field('location'));?></td>
        </tr>

    <?
      endwhile;
      else:
    _e( 'Sorry, no posts matched your criteria.', 'textdomain' );
    endif;
    wp_reset_postdata();
    ?>
    </table>
    <?php $ob_str=ob_get_contents();
    ob_end_clean();
    return $ob_str;
}
