<?php
/** One dynamic product block; all surrounding homepage content uses core blocks. */
defined( 'ABSPATH' ) || exit;
add_action( 'init', function () {
 wp_register_script( 'wonderwish-product-stream-editor', get_stylesheet_directory_uri() . '/assets/js/product-stream-editor.js', array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-server-side-render' ), filemtime( get_stylesheet_directory() . '/assets/js/product-stream-editor.js' ), true );
 register_block_type( 'wonderwish/product-stream', array(
  'api_version'=>3, 'editor_script'=>'wonderwish-product-stream-editor',
  'render_callback'=>function () { ob_start(); include __DIR__ . '/product-stream.php'; return ob_get_clean(); }
 ) );
} );
