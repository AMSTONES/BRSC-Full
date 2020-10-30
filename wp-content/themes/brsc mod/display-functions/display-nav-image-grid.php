<?php
  function display_nav_image_grid_func($atts){
    extract(shortcode_atts( array(
    'location' => '',
    ), $atts ));

    if ($location == 'home') {
      $menuLocations = get_nav_menu_locations();
      $menuID = $menuLocations['menu-1'];
      $primaryNav = wp_get_nav_menu_items($menuID);
      $reindex = [];
      foreach ( $primaryNav as $navItem ) {
        if ($navItem->menu_item_parent == 0) {
          array_push($reindex, $navItem);
        }
      }
    } else {
      $currentPage = (get_the_ID());
      $pageChildren = get_children($currentPage);

      $reindex = [];
      foreach ($pageChildren as $subpage) {
        array_push($reindex, $subpage);
      }
      $reindex = array_reverse($reindex);
    }
    ob_start();
    ?>
    <div class='nav-image-flex-container'>
      <?php
        get_nav_info($reindex, $location);
      ?>
    </div>
    <?php
    $ob_str=ob_get_contents();
    ob_end_clean();
    return $ob_str;
  }

function get_nav_info($array, $location) {
  foreach ($array as $index => $navItem) {
    $image_size = (($index + 1) / 2 % 2 == 0) ? 'nav-image-medium' : 'nav-image-small';
    $post = ($location == 'home') ? $navItem -> object_id : $navItem;
    $image_id = get_post_thumbnail_id($post);
    $image_prefix = 'thumbnail-nav-';
    $image_src = wp_get_attachment_image_url($image_id, $image_prefix . 'two');
    $image_srcset = null;//'http://brsctest.local/wp-content/uploads/2020/09/cropped-thumbnail_brsc-new-logo-small.png' . ' 300px, ' . wp_get_attachment_image_url( $image_id, $image_prefix . 'two') . ' 900px' ;
    nav_container_out($navItem, $image_src, $image_size, $image_srcset);
  }
}


function nav_container_out($navObject, $imageUrl, $image_modifier, $image_srcset){
  $itemLink = ($navObject->url == '') ? get_permalink($navObject) : $navObject->url;
  $itemTitle = ($navObject->title == '') ? 'post_title' : 'title';
  ?>
  <div class="nav-element-container <?php esc_html_e( $image_modifier)?>">
    <a class="nav-image-link" href="<?echo esc_url($itemLink)?>">
      <h2 class="nav-title"><?php esc_html_e($navObject->$itemTitle);?></h2>
      <img class="nav-image" srcset="<?php echo esc_attr( $image_srcset ); ?>" src="<?php echo esc_attr($imageUrl);?>">
    </a>
  </div>
  <?
}

function display_nav_pairs($pairsArray, $location) {
  foreach ($pairsArray as $index => $navPair) {
    $image_sizes = ($index % 2 == 0) ? ['two', 'one'] : ['one', 'two'];
    ?>
    <div class='nav-pair'>
    <?
    foreach ($navPair as $index => $navItem) {
      $image_size = ($index % 2 == 0 ? $image_sizes[0] : $image_sizes[1]);
      if (count($navPair) == 1){
        $image_size = 'three';
      };
      $post = ($location == 'home') ? $navItem -> object_id : $navItem ;
      $image_id = get_post_thumbnail_id( $post );
      $image_prefix = 'thumbnail-nav-';
      $image_src = wp_get_attachment_image_url($image_id, $image_prefix . 'two');
      nav_container_out($navItem, $image_src);
    } ?>
    </div>
    <?
  }
}
