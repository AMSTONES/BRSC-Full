<?php get_header(); ?>
		<?php
			$page = get_the_ID();
			$thumb_url = get_the_post_thumbnail_url($page, 'banner-medium');
		?>
	<div class="video-image-container" style="background-image: url(<?php echo $thumb_url ?>)">
		<h1 class="front-banner-text">We are Famous</h1>
		<a href="#front-jump-down">
		<div class="arrow-wrap">
			<i class="jump-down-arrow"></i>
		</div>
		</a>
	</div>
	<div id="front-jump-down"></div>
	<section class="fp-section introduction">

		<div class="container fp-section-text">
			<h2 class="fp-section-title" ><strong>Raising profiles through PR</strong></h2>
				<div class="front-first-para-wrap" >
					<span>Famous Publicity is a boutique PR consultancy with brilliant clients. We raise the profile of people, brands, businesses and charities.
				We take a hands-on approach, as well as being strategic and will aim to do all tasks in a timely way. We love the challenge of a tight deadline.</span>
				<div class="fp-button collapse-button"><i class="fas fa-ellipsis-h"></i></div>
				</div>

				<div id="collapsible-text-front-page" class="collapsible-text">
					<br>
					<p>The agency is proudly small and works with friends in other complimentary disciplines to deliver the best results for clients.

					When we buy in external services, we don’t charge any mark-up, which is just one of the reasons why we have excellent client and supplier relationships.

					The agency’s founder, Tina Fotherby, worked in house for four years with the retail magnate and star of BBC TV’s Dragons’ Den, Theo Paphitis, prior to setting up the agency. She learned that high standards go a long way to helping people succeed in a competitive marketplace.</p>

					<p>We have some famous clients but we don’t restrict our work to celebrities. The business name is tongue in cheek as few people choose to be famous. Most people simply want recognition within their peer group. Not everyone wants to be king of the jungle. They might simply want to develop their business further.

					We have some wonderful retained clients and we also love project work for the variety it provides. We are equally happy working with B2C, B2B and not-for-profit clients. We have strong experience in the professional services field and enjoy supporting lawyers and accountants.</p>

					<a href="<?php echo get_page_link( get_page_by_path('about-us')->ID); ?>"><div class="fp-button">Discover more</div></a>
				</div>
		</div>


	</section>

  <?echo do_shortcode('[display-service-grid]'); ?>

	<section class="fp-section news">
		<div class="container broad-width container-center">
			<h2 class="fp-section-title">News</h2>
			<div class="row">

				<?php echo do_shortcode('[display-posts]'); ?>

			</div>
			<a href="<?php echo get_page_link( get_page_by_path('news')->ID); ?>"><div class="fp-button">Read more</div></a>
		</div>
	</section>

<?php get_footer(); ?>
