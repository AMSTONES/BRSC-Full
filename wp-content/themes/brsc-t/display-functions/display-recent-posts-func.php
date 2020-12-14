<?php
function display_recent_posts_func($atts){
  extract(shortcode_atts( array(
    'post_type' => 'post',
    'post_category' => '',
    'count' => 3,
  ), $atts ));

  if ($post_category == 'front-page'){
    $queries = query_loop();
    ob_start(); ?>
    <div class='feed-container feed-front-page'>
    <?php
    $titles = ['Recent', 'Important', 'Racing'];
    for ($x = 0; $x < 3; $x++) {
      $query = $queries[$x];
      if ( $query->have_posts() ) :
      while ( $query->have_posts() ) : $query->the_post();
        $title = $titles[$x];
        display_one_post($query, $title);
      endwhile;
      else:
    _e( 'Sorry, no posts matched your criteria.', 'textdomain' );
    endif;
    wp_reset_postdata();
    } ?>
    </div>
    <?php $ob_str=ob_get_contents();
    ob_end_clean();
    return $ob_str;

  } else {
    $query = new WP_Query( array(
      'post_type' => $post_type,
      'category_name' => $post_category,
      'posts_per_page' => $count
    ) );

    ob_start(); ?>
    <div class='feed-container'>
    <?php if ( $query->have_posts() ) :
      while ( $query->have_posts() ) : $query->the_post();
        //display_market_post($query);
        display_one_post($query);
      endwhile;
      else:
    _e( 'Sorry, no posts matched your criteria.', 'textdomain' );
    endif;
    wp_reset_postdata();
    ?>
    </div>
    <?php $ob_str=ob_get_contents();
    ob_end_clean();
    return $ob_str;
  }
}
  function query_loop(){
    $queries = [];
    $query_args = [ null, 'tag' => 'important', 'category_name' => 'racing' ];
    $query_keys = array_keys($query_args);
    for ($x = 0; $x < 3; $x++){
      $val = $query_args[$query_keys[$x]];
      $args = ['post_type' => 'announcement', 'posts_per_page' => 1];
      $args[$query_keys[$x]] = $val;
      array_push($queries, new WP_Query(
        $args
      ));
    }
    return $queries;
  }
function display_one_post($query, $title=''){ ?>
    <div class="feed-post-wrap">
      <? if ($title) { ?>
        <h2 class="feed-type"><?php esc_html_e($title)?></h2>
      <? } ?>
      <div class="<?php esc_html_e($args) ?>feed-post brsc-rounded">
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
<? }

  function display_race_time() {
  if (get_field('race_time')) { ?>
     <p><? esc_html_e(get_field('race_time')); ?></p>
  <? }
}

function display_excerpt() {
  if (!get_field('item_description')) { ?>
    <p class="feed-description"><? esc_html_e(get_the_excerpt()); ?></p><?
  }
}

function display_price() {
  if (get_field('price')) { ?>
    <p><? esc_html_e('£' . get_field('price')); ?></p>
  <? }
}

function display_description() {
  if (get_field('item_description') && !has_post_thumbnail()) { ?>
    <p class='feed-description'><? esc_html_e(get_field('item_description')); ?></p>
  <? }
}
