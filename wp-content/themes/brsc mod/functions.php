<?php
/**
 * BRSC functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BRSC
 */

if ( ! defined( 'brscVERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'brscVERSION', '1.0.0' );
}

if ( ! function_exists( 'brsc_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function brsc_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on BRSC, use a find and replace
		 * to change 'brsc' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'brsc', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		if ( function_exists( 'add_theme_support' ) ) {
      add_theme_support( 'post-thumbnails' );
      //add_theme_support( 'post-thumbnails', array('post', 'service' ,'service') );
      add_image_size( 'thumbnail-nav-one', 300, 300, true );
      add_image_size( 'thumbnail-nav-two', 600, 300, true );
      add_image_size( 'thumbnail-nav-three', 900, 300, true);
      add_image_size( 'banner', 800, 800, false );
      add_image_size( 'banner-medium', 1200, 800, true );
      add_image_size( 'banner-large', 2000, 1200, true );
    };

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'brsc' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'brsc_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'brsc_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function brsc_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'brsc_content_width', 640 );
}
add_action( 'after_setup_theme', 'brsc_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function brsc_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'brsc' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'brsc' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'brsc_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function brsc_scripts() {
	wp_enqueue_style( 'brsc-style', get_stylesheet_uri(), array(), brscVERSION );
	wp_style_add_data( 'brsc-style', 'rtl', 'replace' );

	wp_enqueue_script( 'brsc-navigation', get_template_directory_uri() . '/js/navigation.js', array(), brscVERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'brsc_scripts' );

function brsc_navbar_top() {
wp_enqueue_script( 'navbar-stick', get_template_directory_uri() . '/js/navbar-top.js', array('jquery'), null, true);
}
add_action( 'wp_enqueue_scripts', 'brsc_navbar_top' );

// function brsc_load_fade_in() {
// wp_enqueue_script( 'load-fade-in', get_template_directory_uri() . '/js/load-fade-in.js', array('jquery'), null, true);
// }
// add_action( 'wp_enqueue_scripts', 'brsc_load_fade_in' );


function brsc_diamond_scroll_js() {
wp_enqueue_script( 'diamond-scroll', get_template_directory_uri() . '/js/diamond-scroll.js', array('jquery'), null, true);
}
add_action( 'wp_enqueue_scripts', 'brsc_diamond_scroll_js' );
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
// add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
// function prefix_disable_gutenberg($current_status, $post_type)
// {
//     // Use your post type key instead of 'product'
//     if ($post_type === 'marketplace-item') return false;
//     return $current_status;
// }
add_action( 'init', function() {
    remove_post_type_support( 'marketplace-item', 'editor' );
}, 99);

/**
 * Add news display
 */


register_block_style(
    'core/table',
    array(
        'name'         => 'navy-stripes',
        'label'        => __( 'Navy Stripes' ),
        'inline_style' => '.wp-block-quote.is-style-navy-stripes',
    )
);

unregister_block_style( 'core/table', 'blue-quote' );


require get_template_directory() . '/inc/customizer.php';

require get_stylesheet_directory() . '/display-functions/display-recent-posts-func.php';
require get_stylesheet_directory() . '/display-functions/display-nav-image-grid.php';
require get_stylesheet_directory() . '/display-functions/display-market-card.php';
require get_stylesheet_directory() . '/display-functions/display-subpage-nav-grid.php';
require get_stylesheet_directory() . '/display-functions/display-events.php';

add_shortcode( 'display-posts', 'display_recent_posts_func' );
add_shortcode( 'display-nav-image-grid', 'display_nav_image_grid_func' );
add_shortcode( 'display-events', 'display_events_func' );
//add_shortcode( 'display-submenu-nav-grid', 'display_subpage_nav_func' );

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

