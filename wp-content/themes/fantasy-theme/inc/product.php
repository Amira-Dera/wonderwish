<?php
/** Product presentation leaves gallery, forms, stock validation and endpoints with WooCommerce. */
defined( 'ABSPATH' ) || exit;

function wonderwish_english_lyd() {
 return 'en' === substr( determine_locale(), 0, 2 ) && 'LYD' === get_option( 'woocommerce_currency' );
}
// WooCommerce ships an Arabic LYD symbol regardless of locale. Keep Arabic unchanged.
add_filter( 'woocommerce_currency_symbol', function ( $symbol, $currency ) {
 return 'LYD' === $currency && 'en' === substr( determine_locale(), 0, 2 ) ? 'LYD' : $symbol;
}, 10, 2 );
// Reading the native position through this filter also covers Store API cart/checkout prices.
add_filter( 'option_woocommerce_currency_pos', function ( $position ) {
 return wonderwish_english_lyd() ? 'right_space' : $position;
} );
add_action( 'after_setup_theme', function () {
 add_theme_support( 'woocommerce' );
 add_theme_support( 'wc-product-gallery-lightbox' );
 add_theme_support( 'wc-product-gallery-slider' );
} );
add_filter( 'woocommerce_single_product_zoom_enabled', function ( $enabled ) {
 return function_exists( 'is_product' ) && is_product() ? false : $enabled;
}, 100 ); // WooCommerce's legacy block enables zoom later at priority 10.
add_action( 'wp', function () {
 if ( is_product() ) {
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
  // TI's default 'after' hook is inside the cart form. Keep the native toggle in
  // one stable summary row instead, independent of quantity/variation changes.
  remove_action( 'woocommerce_after_add_to_cart_button', 'tinvwl_view_addto_html', 20 );
  remove_action( 'woocommerce_single_product_summary', 'tinvwl_view_addto_htmlout', 31 );
  if ( function_exists( 'tinvwl_view_addto_html' ) ) add_action( 'woocommerce_single_product_summary', 'tinvwl_view_addto_html', 35 );
 }
 if ( is_product() || wonderwish_is_catalogue() ) remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
} );
add_filter( 'woocommerce_product_tabs', function ( $tabs ) {
 unset( $tabs['reviews'] );
 return $tabs;
} );
add_filter( 'woocommerce_catalog_orderby', function ( $options ) {
 unset( $options['rating'] );
 return $options;
} );
add_action( 'woocommerce_before_quantity_input_field', function () {
 if ( is_product() ) echo '<button type="button" class="ww-qty-step" data-step="-1" aria-label="' . esc_attr__( 'Decrease quantity', 'fantasy-theme' ) . '">−</button>';
} );
add_action( 'woocommerce_after_quantity_input_field', function () {
 if ( is_product() ) echo '<button type="button" class="ww-qty-step" data-step="1" aria-label="' . esc_attr__( 'Increase quantity', 'fantasy-theme' ) . '">+</button>';
} );
add_filter( 'body_class', function ( $classes ) {
 if ( function_exists( 'is_product' ) && is_product() ) $classes[] = 'ww-product-page';
 return $classes;
} );
// Instant user-controlled gallery changes; no autoplay or motion preference dependency.
add_filter( 'woocommerce_single_product_carousel_options', function ( $options ) {
 $options['animationSpeed'] = 0;
 $options['slideshow'] = false;
 return $options;
} );
add_action( 'wp_enqueue_scripts', function () {
 if ( ! function_exists( 'is_product' ) || ! is_product() ) return;
 foreach ( array( 'shop', 'product' ) as $style ) {
  wp_enqueue_style( 'wonderwish-' . $style, get_stylesheet_directory_uri() . '/assets/css/' . $style . '.css', array(), filemtime( __DIR__ . '/../assets/css/' . $style . '.css' ) );
 }
 wp_enqueue_script( 'wonderwish-world-glitter', get_stylesheet_directory_uri() . '/assets/js/world-glitter.js', array(), filemtime( __DIR__ . '/../assets/js/world-glitter.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );
}, 25 );
add_action( 'woocommerce_single_product_summary', function () {
 global $product;
 if ( ! $product ) return;
 echo '<p class="ww-product-eyebrow">' . esc_html__( 'A little WonderWish discovery', 'fantasy-theme' ) . ' <span aria-hidden="true">✦</span></p>';
}, 4 );
add_action( 'wp_enqueue_scripts', function () {
 if ( ! is_product() && ! wonderwish_is_catalogue() ) return;
 wp_enqueue_style( 'wonderwish-commerce-ui', get_stylesheet_directory_uri() . '/assets/css/commerce-ui.css', array(), filemtime( __DIR__ . '/../assets/css/commerce-ui.css' ) );
 wp_enqueue_script( 'wonderwish-commerce-ui', get_stylesheet_directory_uri() . '/assets/js/commerce-ui.js', array( 'jquery', 'wc-add-to-cart' ), filemtime( __DIR__ . '/../assets/js/commerce-ui.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );
}, 30 );
// Keep the native confirmation text without the redundant View cart action.
add_filter( 'wc_add_to_cart_message_html', function ( $message ) {
 $message = preg_replace( '#<a[^>]*class="[^"]*wc-forward[^"]*"[^>]*>.*?</a>#is', '', $message );
 return '<span class="ww-cart-confirmation">' . $message . '</span>';
} );
