<?php get_header(); ?>
<?php get_template_part('content', 'banner'); ?>

  <? echo do_shortcode('[display-testimonials]'); ?>
	<section class="fp-section">
		<div class="fp-news-container">
			<div class="fp-grid">
				<?php while(have_posts()) {
				the_post(); ?>
				<div class="col-12 col-md-6 col-lg-4 fp-grid-element">

					<?php if (has_post_thumbnail() ){ ?>
						<a href="<?php the_permalink();?>">
							<div class="fp-grid-image-container	">
								<?php the_post_thumbnail(null, array('class' => 'fp-grid-image zoom-image', 'alt' => get_the_title())); ?>
							</div>
						</a>
					<?php } ?>
          <div class="fp-grid-text-container">
            <a href="<?php the_permalink();?>"><h3 class=""><?php the_title()?></h3></a>
            <p class="fp-grid-text"><?php esc_html_e( get_the_excerpt(), 20); ?></p>
            <span><?php the_time('dS F Y')?></span>
          </div>
				</div>
				<?php } ?>
			</div>
		</div>
	<?php echo paginate_links();?>
	</section>


<?php get_footer(); ?>
