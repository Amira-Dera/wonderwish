<?php
/** Shared page presentation; page content and commerce blocks remain editable in Gutenberg. */
defined( 'ABSPATH' ) || exit;
function wonderwish_is_page_shell() {
 return ( ( is_page() && ! is_front_page() && ! is_home() ) || is_404() || is_search() ) && ! wonderwish_is_catalogue();
}
add_filter( 'body_class', function ( $classes ) {
 if ( wonderwish_is_page_shell() ) $classes[] = 'ww-page-shell';
 if ( is_cart() || is_checkout() ) $classes[] = 'ww-checkout-flow';
 if ( wonderwish_is_page_shell() && ! is_account_page() && ! wonderwish_is_wishlist_page() && ! is_wc_endpoint_url( 'order-received' ) ) $classes[] = 'ww-page-banner';
 return $classes;
} );
add_action( 'wp_enqueue_scripts', function () {
 if ( ! wonderwish_is_page_shell() ) return;
 foreach ( array( 'shop', 'pages' ) as $style ) wp_enqueue_style( 'wonderwish-' . $style, get_stylesheet_directory_uri() . '/assets/css/' . $style . '.css', array(), filemtime( __DIR__ . '/../assets/css/' . $style . '.css' ) );
 wp_enqueue_script( 'wonderwish-world-glitter', get_stylesheet_directory_uri() . '/assets/js/world-glitter.js', array(), filemtime( __DIR__ . '/../assets/js/world-glitter.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );
}, 26 );

// Libya-only checkout: remove the postcode in both native forms and Store API validation.
add_filter( 'woocommerce_get_country_locale', function ( $locale ) {
 $locale['LY']['postcode'] = array( 'required' => false, 'hidden' => true );
 return $locale;
} );
add_action( 'wp_enqueue_scripts', function () {
 if ( ! is_checkout() || is_wc_endpoint_url() ) return;
 wp_enqueue_script( 'wonderwish-checkout', get_stylesheet_directory_uri() . '/assets/js/checkout.js', array(), filemtime( __DIR__ . '/../assets/js/checkout.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );
}, 27 );

// Keep WooCommerce's recovery forms/nonces intact and add a shared visual card.
foreach ( array( 'lost', 'reset' ) as $recovery_step ) {
 add_action( 'woocommerce_before_' . $recovery_step . '_password_form', function () use ( $recovery_step ) {
  echo '<section class="ww-recovery-card"><h1>' . esc_html( 'lost' === $recovery_step ? 'Reset your password' : 'Choose a new password' ) . '</h1>';
 } );
 add_action( 'woocommerce_after_' . $recovery_step . '_password_form', function () {
  echo '<a class="ww-recovery-back" href="' . esc_url( wc_get_page_permalink( 'myaccount' ) ) . '">← Back to sign in</a></section>';
 } );
}
