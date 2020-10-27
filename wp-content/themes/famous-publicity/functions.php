<?php

include( get_stylesheet_directory() . '/display-recent-posts.php' );

add_shortcode( 'display-posts', 'display_recent_posts' );

function replace_core_jquery_version() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js", array(), '3.4.1' );
}

add_action( 'wp_enqueue_scripts', 'replace_core_jquery_version' );

function famous_files(){
	wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css');
	wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
	//wp_enqueue_script('jquery');
	//wp_enqueue_script( 'popper', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js');
	//wp_enqueue_script( 'bootjs', '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js');
	wp_enqueue_script( 'image-to-text', get_template_directory_uri() . '/js/image-to-text.js', $deps = ['jquery'], $in_footer = true );
	wp_enqueue_script( 'quote-icons', get_template_directory_uri() . '/js/add-quote-icons.js', $deps = ['jquery'], $in_footer = true );

	if (is_page( array('home') ) ){
		wp_enqueue_script( 'video-load', get_template_directory_uri() . '/js/video-load.js', $deps = ['jquery'], $in_footer = true );
		wp_enqueue_script( 'black-white', get_template_directory_uri() . '/js/black-white.js', $deps = ['jquery'], $in_footer = true );
		wp_enqueue_script( 'front-collapse', get_template_directory_uri() . '/js/front-collapse.js', $deps = ['jquery'], $in_footer = true);
	}
 wp_enqueue_script( 'rolling-testimonials', get_template_directory_uri() . '/js/quote-display.js', $deps = ['jquery'], $in_footer = true );
	wp_enqueue_script( 'nav-toggle', get_template_directory_uri() . '/js/navbar-toggle.js', $deps = ['jquery'], $in_footer = true );
	wp_enqueue_style('famous_main_styles', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'famous_files');
add_action('get_header', 'my_filter_head');

function fp_features(){
	add_theme_support( 'title-tag' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
}

add_theme_support( 'editor-styles' );

add_editor_style();

function remove_cssjs_ver( $src ) {
if( strpos( $src, '?ver=' ) )
 $src = remove_query_arg( 'ver', $src );
return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );

remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );

function wpdocs_dequeue_dashicon() {
        if (current_user_can( 'update_core' )) {
            return;
        }
        wp_deregister_style('dashicons');
}
add_action( 'wp_enqueue_scripts', 'wpdocs_dequeue_dashicon' );

if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
    //add_theme_support( 'post-thumbnails', array('post', 'service' ,'service') );
    add_image_size( 'thumbnail-news', 300, 300, true );
    add_image_size( 'banner', 800, 800, false );
    add_image_size( 'banner-medium', 1200, 800, true );
    add_image_size( 'banner-large', 2000, 1200, true );
}

add_action( 'init', function() {
    remove_post_type_support( 'testimonial', 'editor' );
}, 99);

function force_type_private($post)
{
    if ($post['post_type'] == 'testimonial')
    $post['post_status'] = 'private';
    return $post;
}
add_filter('wp_insert_post_data', 'force_type_private');

require get_stylesheet_directory() . '/display-service-grid.php';
add_shortcode( 'display-service-grid', 'display_image_grid_func' );

require get_stylesheet_directory() . '/display-testimonials.php';
add_shortcode( 'display-testimonials', 'display_testimonials_func' );


function my_filter_head() {
   remove_action('wp_head', '_admin_bar_bump_cb');
}

add_action('after_setup_theme', 'fp_features');

?>
