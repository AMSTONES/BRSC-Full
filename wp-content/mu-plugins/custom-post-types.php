<?php

function fp_post_types() {
  register_post_type('announcement', array(
    'public' => true,
    'labels' => array(
      'name' => 'Announcements',
      'add_new_item' => 'Add new announcement',
      'edit_item' => 'Edit Announcement',
      'all_items' => 'All Announcements',
      'singular_name' => 'Announcement',
    ),

    'show_in_rest' => true,
    'supports' => array( 'thumbnail', 'editor', 'title' ),
    'menu_icon' => 'dashicons-category',
    'taxonomies'  => array( 'category' )
  ));
  register_post_type('marketplace-item', array(
    'public' => true,
    'labels' => array(
      'name' => 'Marketplace',
      'add_new_item' => 'Add new Market Item',
      'edit_item' => 'Edit Market Item',
      'all_items' => 'All Market Items',
      'singular_name' => 'Market Item',
    ),

    'show_in_rest' => true,
    'supports' => array( 'thumbnail', 'editor', 'title' ),
    'menu_icon' => 'dashicons-category',
    'taxonomies'  => array( 'category' )
  ));

  register_post_type('event', array(
    'public' => true,
    'labels' => array(
      'name' => 'Event',
      'add_new_item' => 'Add new Event',
      'edit_item' => 'Edit Event',
      'all_items' => 'All Event',
      'singular_name' => 'Event',
    ),

    'show_in_rest' => true,
    'supports' => array( 'thumbnail', 'editor', 'title' ),
    'menu_icon' => 'dashicons-category',
    'taxonomies'  => array( 'category' )
  ));
}

// add_filter('manage_event_posts_columns', 'brsc_event_table_head');
// function brsc_event_table_head( $defaults ) {
//     $defaults['event_time']  = 'Event Time';
//     $defaults['location']   = 'Location';
//     return $defaults;
// }

function reg_tag() {
     register_taxonomy_for_object_type('post_tag', 'announcement');
     register_taxonomy_for_object_type('post_tag', 'marketplace-item');
     register_taxonomy_for_object_type('post_tag', 'event');
}



add_action('init', 'fp_post_types');
add_action('init', 'reg_tag');

// add_action( 'manage_event_posts_custom_column', 'brsc_event_table_content', 10, 2 );

// function brsc_event_table_content( $column_name, $post_id ) {
//     if ($column_name == 'event_time') {
//     $event_date = get_post_meta( $post_id, '_bs_meta_event_date', true );
//       echo  date( _x( 'F d, Y', 'Event date format', 'textdomain' ), strtotime( $event_date ) );
//     }
//     if ($column_name == 'ticket_status') {
//     $status = get_post_meta( $post_id, '_bs_meta_event_ticket_status', true );
//     echo $status;
//     }

//     if ($column_name == 'venue') {
//     echo get_post_meta( $post_id, '_bs_meta_event_venue', true );
//     }

// }

?>
