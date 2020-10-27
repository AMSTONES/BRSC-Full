
<?php
	if (is_home()) {
			$page_for_posts = get_option( 'page_for_posts' );
			$image_id = get_post_thumbnail_id($page_for_posts);
	} else {
		$image_id = get_post_thumbnail_id();
	}
	$img_src = wp_get_attachment_image_url( $image_id, 'banner' );
	$img_srcset = wp_get_attachment_image_url( $image_id, 'banner') . ' 800w, ' . wp_get_attachment_image_url( $image_id, 'banner-medium') . ' 1200w, ' . wp_get_attachment_image_url( $image_id, 'banner-large' ) . ' 1800w';
// = wp_get_attachment_image_srcset( $image_id, $size = 'banner-large');

// $img_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
 ?>
 <div class="banner-container">
  <div class="banner-height-wrap">
    <img class="banner-image" src="<?php echo esc_attr( $img_src ); ?>" srcset="<?php echo esc_attr( $img_srcset ); ?>" sizes="auto" >
    <h1 class="banner-text"><?php single_post_title(); ?></h1>
  </div>

 </div>
