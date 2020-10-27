<?php get_header(); ?>
<?php get_template_part('content', 'banner'); ?>

<?php while(have_posts()) {
				the_post(); ?>
				<div class="container contact-section">
					<div class="row row-center">
						<div class="col-12 col-lg-5">
							<?php the_content(); ?>
						</div>
						<div class="col-12 col-lg-5 map-container">
							<iframe style="border: 0;" src="https://www.google.com/maps/embed/v1/place?q=Famous+Publicty+Redhill+Aerodrome+Aero+16+Kings+Mill+Lane+South+Nutfield+Surrey+RH1+5JY&amp;key=AIzaSyDwdaHpZXzIEcInrhdu7gqP_BGbXNBQWWw" width="600" height="450" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
						</div>
					</div>

				</div>

			<?php } ?>


<?php get_footer(); ?>
