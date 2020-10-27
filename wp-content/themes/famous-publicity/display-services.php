<?php

function display_services(){
	$services = new WP_Query(array(
		'post_type' => 'service',
		'posts_per_page' => '-1'
	));
	$array_rev = array_reverse($services->posts);
	$services->posts = $array_rev;
	;?>
	<div class="container services-container">
		<div class="row justify-content-center">
		<?php while ($services->have_posts()) {
		$services->the_post();?>
			<a class="service-anchor" id="service-no-<? esc_html_e(get_the_ID()) ; ?>"></a>
			<div class="services-wrapper col-12" <?php if ($services->current_post != 0) { echo 'data-aos="fade-up" data-aos-offset="250" data-aos-once="true"'; }; ?> >
				<h2 class="services-title"><?php the_title();?></h2>
				<?php //the_post_thumbnail( 'medium', array('class' => 'col-md-4 col-12') ); ?>
				<div class="services-text-wrapper">
					<?php the_content(); ?>
				</div>
			</div>
			  <hr class="services-break" data-aos="fade-up" data-aos-offset="250" data-aos-once="true">
	<?php } ?>
		</div>
	</div>
	<section class="fp-section news" data-aos="fade-up" data-aos-offset="250" data-aos-once="true">
		<div class="container container-center">
			<h2 class="fp-section-title">Read some of our recent blogs</h2>
			<div class="row">

				<?php echo do_shortcode('[display-posts]'); ?>

			</div>
			<a href="<?php echo get_page_link( get_page_by_path('news')->ID); ?>"><div class="fp-button">Read more</div></a>
		</div>
	</section>


<?php } wp_reset_postdata(); ?>
