<?php
/** Shared presentation and native browser titles; no store settings are changed. */
defined( 'ABSPATH' ) || exit;
add_action( 'wp_enqueue_scripts', function () {
 wp_enqueue_style( 'wonderwish-navigation', get_stylesheet_directory_uri() . '/assets/css/navigation.css', array(), filemtime( __DIR__ . '/../assets/css/navigation.css' ) );
}, 100 );
// Shared native notices, including guest authentication and Checkout Blocks.
add_action( 'wp_enqueue_scripts', function () {
 wp_enqueue_style( 'wonderwish-notices', get_stylesheet_directory_uri() . '/assets/css/notices.css', array(), filemtime( __DIR__ . '/../assets/css/notices.css' ) );
}, 110 );
add_action( 'wp_enqueue_scripts', function () {
 wp_enqueue_style( 'wonderwish-toasts', get_stylesheet_directory_uri() . '/assets/css/toasts.css', array(), filemtime( __DIR__ . '/../assets/css/toasts.css' ) );
 wp_enqueue_script( 'wonderwish-toasts', get_stylesheet_directory_uri() . '/assets/js/toasts.js', array( 'jquery' ), filemtime( __DIR__ . '/../assets/js/toasts.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );
}, 115 );
add_filter( 'document_title_parts', function ( $parts ) {
 $parts['site'] = 'WonderWish';
 unset( $parts['tagline'] );
 if ( is_front_page() || is_home() ) $parts['title'] = 'Home';
 elseif ( is_404() ) $parts['title'] = 'Page not found';
 elseif ( is_search() ) $parts['title'] = 'Search: ' . get_search_query();
 elseif ( is_shop() && wonderwish_shop_world() ) $parts['title'] = ( 'disney' === wonderwish_shop_world() ? 'Disney' : 'DreamWorks' ) . ' gifts';
 elseif ( is_account_page() ) {
  $names = array( 'orders'=>'Your orders', 'view-order'=>'Order details', 'edit-address'=>'Your addresses', 'edit-account'=>'Account details', 'lost-password'=>'Reset password', 'downloads'=>'Your downloads', 'payment-methods'=>'Payment methods' );
  $endpoint = WC()->query->get_current_endpoint();
  $parts['title'] = $names[$endpoint] ?? 'My Account';
 } elseif ( is_checkout() ) $parts['title'] = is_wc_endpoint_url( 'order-pay' ) ? 'Payment details' : ( is_wc_endpoint_url( 'order-received' ) ? 'Order confirmation' : 'Checkout' );
 return $parts;
}, 30 );

// Evaluate authentication at render time, not in the cached theme pattern.
add_filter( 'render_block_data', function ( $block ) {
 if ( 'core/navigation-link' === $block['blockName'] && str_contains( $block['attrs']['className'] ?? '', 'ww-account-entry' ) ) {
  $block['attrs']['label'] = is_user_logged_in() ? 'My Account' : 'Log in';
 }
 return $block;
} );
