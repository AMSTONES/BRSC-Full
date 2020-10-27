<?php get_header(); ?>
<?php get_template_part('content', 'banner'); ?>
<?php while(have_posts()) {
	the_post(); ?>
	<!-- <div class="banner-image" style="background-image: linear-gradient(rgba(230, 9, 142, 0.6),rgba(230, 9, 142, 0.6)),url(<?php echo
		get_theme_file_uri('/images/handshake.jpg') ?>)">	
			<h1 class="banner-text"><?php the_title();?></h1>
	</div> -->
	<div class='fp-section'>
		<div class="container">
			<?php the_content(); ?>
		</div>
		
	</div>
<?php } ?>

<?php get_footer(); ?>