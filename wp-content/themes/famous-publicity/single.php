<?php get_header();?>
	<?php //get_template_part('content', 'banner'); ?>

	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:creator" content="@BobDyla00973593" />
	<meta property="og:url" content="<?php the_permalink(); ?>" />
	<meta property="og:title" content="<?php the_title(); ?>" />
	<meta property="og:description" content="<?php echo wp_trim_words( get_the_excerpt(), 20); ?>" />
	<meta property="og:image" content=<?php the_post_thumbnail_url(); ?> />
	<meta property="og:source" content=<?php echo home_url(); ?> />

<section class="fp-article">
	<div class="container">
		<?php
	while(have_posts()) {
		the_post();
		?>
		<div class="fp-article-title-container">
			<?php the_post_thumbnail($size = 'large', array('class' => 'fp-article-title-image') ); ?>
			<h1 class="fp-article-title col-12"><?php the_title();?></h1>
		</div>
			<div class="fp-article-info">
        <span><?php echo get_field('author_name');?></span>
        <span class="fp-article-divider">|</span>
        <span><?php echo get_the_date();?> </span>
      </div>
      <hr>
			<?php the_content(); ?>
		<div class="fp-article-arrows row justify-content-between">
			<?php previous_post_link('%link', '← Previous article'); ?>
			<?php next_post_link('%link', 'Next article →'); ?>
		</div>
	<?php } ?>

	</div>
	<?php $newsUrl = urlencode(get_permalink()); ?>
	<div class="share-links">
		<span>Share this article:</span>
	    <a class="twitter-share"
	    <?php echo 'href="https://twitter.com/intent/tweet?url=' . $newsUrl . '"';?>
	    target="_blank">
	    <i class="fab fa-twitter"></i></a>
	    <a <?php echo 'href="https://www.linkedin.com/shareArticle?url=' . $newsUrl . '"'; ?>
	    target="_blank">
	    <i class="fab fa-linkedin"></i></a>
  	</div>
</section>

<?php get_footer(); ?>
