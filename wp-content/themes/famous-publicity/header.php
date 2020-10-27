<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo('charset');?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Famous Publicity is a boutique PR consultancy with brilliant clients. We raise the profile of people, brands, businesses and charities.">
	 <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
	<?php wp_head(); ?>
	<title></title>
	<!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
</head>
	<body <?php body_class();?>>
		<header>
			<nav class="navbar">
				<div class="nav-container">
					<div class='top-menu top-left'>
						<ul>
							<li>
								<a class='s-black' href="<?php echo get_page_link( get_page_by_path('services')->ID); ?>">Services</a>
							</li>
							<li>
								<a class='s-black' href="<?php echo get_page_link( get_page_by_path('about-us')->ID); ?>">About us</a>
							</li>
						</ul>
					</div>
					<a href="<?php echo get_home_url()?>"><img class="navbar-image" src="<?php echo get_theme_file_uri('/images/famous_logo_black_quote.png')?>"></a>
					<div class='top-menu top-right'>
						<ul>
							<li>
								<a class='s-black' href="<?php echo get_page_link( get_page_by_path('news')->ID); ?>">News</a>
							</li>
							<li>
								<a class='s-black' href="<?php echo get_page_link( get_page_by_path('contact-us')->ID); ?>">Contact us</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- <h3 id='scroll-top'></h3> -->
				<span class="navbar-open">
					<i class="fa fa-bars"></i>
				</span>
			</nav>
			<nav id="nav-fullscreen">
				<span class="navbar-close">
						<i class="fa fa-times s-white"></i>
					</span>
				<div class="nav-fullscreen-links-container">
					<ul>
						<li>
							<a href="<?php echo get_home_url()?>">Home</a>
						</li>
						<li>
							<a href="<?php echo get_page_link( get_page_by_path('about-us')->ID); ?>">About us</a>
						</li>
						<li>
							<a href="<?php echo get_page_link( get_page_by_path('services')->ID); ?>">Services</a>
						</li>
						<li>
							<a href="<?php echo get_page_link( get_page_by_path('news')->ID); ?>">News</a>
						</li>
						<li>
							<a href="<?php echo get_page_link( get_page_by_path('contact-us')->ID); ?>">Contact us</a>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<div class="navbar-space"></div>
