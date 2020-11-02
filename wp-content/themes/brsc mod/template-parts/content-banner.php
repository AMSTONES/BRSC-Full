
<?php

  $image_id = get_post_thumbnail_id();
  $img_src = wp_get_attachment_image_url( $image_id, 'banner' );
  $img_srcset = wp_get_attachment_image_url( $image_id, 'banner') . ' 800w, ' . wp_get_attachment_image_url( $image_id, 'banner-medium') . ' 1200w, ' . wp_get_attachment_image_url( $image_id, 'banner-large' ) . ' 1800w';
// = wp_get_attachment_image_srcset( $image_id, $size = 'banner-large');
if (is_front_page()) { ?>
  <div class="banner-container">
    <img class="banner-image" src="<?php echo esc_attr( $img_src ); ?>" srcset="<?php echo esc_attr( $img_srcset ); ?>" sizes="auto" >
    <div class="banner-wash"></div>
    <? //echo do_shortcode("[display-posts post_type='announcement' post_category='front-page' count='3' extra_class_classes='feed-front']"); ?>
    <? $brsc_logo = get_template_directory_uri() . '/images/beaulieu-diamond.png'; ?>
    <a href="#content-start">
      <div class="brsc-diamond-trio">
        <img class="brsc-diamond diamond-left" src="<?php echo $brsc_logo ?>">
        <img class="brsc-diamond diamond-center" src="<?php echo $brsc_logo ?>">
        <img class="brsc-diamond diamond-right" src="<?php echo $brsc_logo ?>">
      </div>
    </a>
    <div class="banner-home-text load-hidden">
      <h1>Welcome</h1>
      <p>The BRSC was set up in the summer of 1931 to provide private, informal racing between Beaulieu residents and this largely remains the case to this day. The club continues to encourage a relaxed approach to racing, training, pottering and of course, socialising, on the unique Beaulieu River. You can find more on the club’s history here.</p>
    </div>
 </div>
 <a id="content-start"></a>
<? } else { ?>
  <div class="banner-container">
    <img class="banner-image banner-standard" src="<?php echo esc_attr( $img_src ); ?>" srcset="<?php echo esc_attr( $img_srcset ); ?>" sizes="auto" >
  <!-- <h1 class="banner-text"><?php single_post_title(); ?></h1> -->
 </div>
<? } ?>
