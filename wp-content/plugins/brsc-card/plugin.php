<? /**
* Plugin Name: BRSC Card Block
* Author: AMSTONES
* Description: A card with a few predefined styles that accepts arbitrary text input.
* Version: 1.0
*/

// Load assets for wp-admin when editor is active
function brsc_gutenberg_card_block_admin() {
   wp_enqueue_script(
      'gutenberg-card-block-editor',
      plugins_url( 'block.js', __FILE__ ),
      array( 'wp-blocks', 'wp-element' )
   );

   wp_enqueue_style(
      'gutenberg-card-block-editor',
      plugins_url( 'block.css', __FILE__ ),
      array()
   );
}

add_action( 'enqueue_block_editor_assets', 'brsc_gutenberg_card_block_admin' );

// Load assets for frontend
function brsc_gutenberg_card_block_frontend() {

   wp_enqueue_style(
      'gutenberg-card-block-editor',
      plugins_url( 'block.css', __FILE__ ),
      array()
   );
}
add_action( 'wp_enqueue_scripts', 'brsc_gutenberg_card_block_frontend' );
