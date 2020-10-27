<?php

function display_recent_posts(){
	$query = new WP_Query( array( 'post_type' => 'post' ) );
	$posts = $query->posts;
  ob_start();
  ?>

		<div class="fp-news-container">
			<div class="fp-grid">
				<?php for ($x = 0; $x <= 2; $x++) {
					$query->the_post();
					echo '<div class="col-10 col-md-6 col-lg-4 fp-grid-element">';
					if (has_post_thumbnail() ){ ?>
						<a href="<?php the_permalink();?>">
							<div class="fp-grid-image-container	">
								<?php the_post_thumbnail('medium', array('class' => 'fp-grid-image zoom-image', 'alt' => get_the_title())); ?>
								<!-- <img class="fp-grid-image zoom-image" src="<?php echo get_the_post_thumbnail_url(); ?>"> -->
							</div>
						</a>
					<?php } ?>
					<a href="<?php the_permalink();?>"><h3 class="s-blue"><?php the_title()?></h3></a>
					<p class="fp-grid-text"><?php esc_html_e( get_the_excerpt(), 20); ?></p>
					<span><?php the_time('dS F Y')?></span>
			</div>
			<?php } ?>
			</div>
		</div>
<?php
  $ob_str=ob_get_contents();
  print_r($ob_str);
  ob_end_clean();
  return $ob_str;
  }
  wp_reset_postdata();
  ?>
