<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BRSC
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
  <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'brsc' ); ?></a>
  <nav id="site-navigation" class="<? esc_html_e($logged_in)?> main-navigation">

      <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars" aria-hidden="true"></i></button>
      <?php
      wp_nav_menu(
        array(
          'theme_location' => 'menu-1',
          'menu_id'        => 'primary-menu',
        )
      );
      ?>
  </nav><!-- #site-navigation -->
  <? if (is_front_page()) {
    get_template_part('template-parts/content', 'banner'); ?>
<!-- only call header top on home page, logo will need to be placed somewhere else -->
  <div class="header-top">
      <div class="logo-container">
        <?php the_custom_logo(); ?>
      </div>
      <div id='front-text-container'>
        <h1 id='front-title'>Beaulieu River Sailing Club</h1>
        <h2 id='front-date'>1931-2021</h2>
      </div>

  </div>
  <? } ?>

    <?
      $logged_in = is_user_logged_in()? 'logged-in' : '';
      $logged_in_bool = is_user_logged_in();
      if (!$logged_in_bool) { ?>
        <a id='login-out-link' href="<? echo esc_url(wp_login_url())?>">Log in</a>
      <? } ?>

  </header><!-- #masthead -->
