<?php
/** WonderWish uses native blocks; no storefront or commerce logic is replaced. */
defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', function () {
	add_editor_style( 'assets/css/hero.css' );
 add_editor_style( 'assets/css/navigation.css' );
 add_editor_style( 'assets/css/home-editor.css' );
	add_editor_style( 'assets/css/worlds.css' );
	add_editor_style( 'assets/css/treasures.css' );
	add_editor_style( 'assets/css/gift-finder.css' );
	add_editor_style( 'assets/css/order-magic.css' );
	add_editor_style( 'assets/css/finale.css' );
	add_editor_style( 'assets/css/footer.css' );
} );

add_action( 'wp_enqueue_scripts', function () {
	if ( ! is_front_page() && ! is_home() ) {
		return;
	}
	wp_enqueue_style( 'wonderwish-finale', get_stylesheet_directory_uri() . '/assets/css/finale.css', array(), filemtime( get_stylesheet_directory() . '/assets/css/finale.css' ) );
	wp_enqueue_script( 'wonderwish-finale', get_stylesheet_directory_uri() . '/assets/js/finale.js', array(), filemtime( get_stylesheet_directory() . '/assets/js/finale.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );
	$benefits_style = get_stylesheet_directory() . '/assets/css/order-magic.css';
	wp_enqueue_style( 'wonderwish-order-magic', get_stylesheet_directory_uri() . '/assets/css/order-magic.css', array(), filemtime( $benefits_style ) );
	$finder_style = get_stylesheet_directory() . '/assets/css/gift-finder.css';
	wp_enqueue_style( 'wonderwish-gift-finder', get_stylesheet_directory_uri() . '/assets/css/gift-finder.css', array(), filemtime( $finder_style ) );
	$finder_script = get_stylesheet_directory() . '/assets/js/gift-finder.js';
	wp_enqueue_script( 'wonderwish-gift-finder', get_stylesheet_directory_uri() . '/assets/js/gift-finder.js', array(), filemtime( $finder_script ), array( 'strategy' => 'defer', 'in_footer' => true ) );
	$file = get_stylesheet_directory() . '/assets/css/hero.css';
	wp_enqueue_style( 'wonderwish-hero', get_stylesheet_directory_uri() . '/assets/css/hero.css', array(), filemtime( $file ) );
	$treasures = get_stylesheet_directory() . '/assets/css/treasures.css';
	wp_enqueue_style( 'wonderwish-treasures', get_stylesheet_directory_uri() . '/assets/css/treasures.css', array(), filemtime( $treasures ) );
	$worlds = get_stylesheet_directory() . '/assets/css/worlds.css';
	wp_enqueue_style( 'wonderwish-worlds', get_stylesheet_directory_uri() . '/assets/css/worlds.css', array(), filemtime( $worlds ) );
	$glitter = get_stylesheet_directory() . '/assets/js/world-glitter.js';
	wp_enqueue_script( 'wonderwish-world-glitter', get_stylesheet_directory_uri() . '/assets/js/world-glitter.js', array(), filemtime( $glitter ), array( 'strategy' => 'defer', 'in_footer' => true ) );
	$orbit = get_stylesheet_directory() . '/assets/js/treasure-orbit.js';
	wp_enqueue_script( 'wonderwish-treasure-orbit', get_stylesheet_directory_uri() . '/assets/js/treasure-orbit.js', array(), filemtime( $orbit ), array( 'strategy' => 'defer', 'in_footer' => true ) );
	$cards = get_stylesheet_directory() . '/assets/js/world-cards.js';
	wp_enqueue_script( 'wonderwish-world-cards', get_stylesheet_directory_uri() . '/assets/js/world-cards.js', array(), filemtime( $cards ), array( 'strategy' => 'defer', 'in_footer' => true ) );
	$script = get_stylesheet_directory() . '/assets/js/magic-hero.js';
	wp_enqueue_script( 'wonderwish-magic', get_stylesheet_directory_uri() . '/assets/js/magic-hero.js', array(), filemtime( $script ), array( 'strategy' => 'defer', 'in_footer' => true ) );
} );

// Footer is a site-wide template part, independent of homepage-only assets.
add_action( 'wp_enqueue_scripts', function () {
 wp_enqueue_style( 'wonderwish-footer', get_stylesheet_directory_uri() . '/assets/css/footer.css', array(), filemtime( get_stylesheet_directory() . '/assets/css/footer.css' ) );
}, 20 );

// Native My Account authentication styling; logged-in account screens are unchanged.
add_filter( 'body_class', function ( $classes ) {
 if ( function_exists( 'is_account_page' ) && is_account_page() && ! is_user_logged_in() ) { $classes[] = 'ww-auth-page'; }
 return $classes;
} );
add_action( 'wp_enqueue_scripts', function () {
 if ( ! function_exists( 'is_account_page' ) || ! is_account_page() || is_user_logged_in() ) return;
 wp_enqueue_script( 'wonderwish-world-glitter', get_stylesheet_directory_uri() . '/assets/js/world-glitter.js', array(), filemtime( get_stylesheet_directory() . '/assets/js/world-glitter.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );
 wp_enqueue_style( 'wonderwish-account', get_stylesheet_directory_uri() . '/assets/css/account.css', array(), filemtime( get_stylesheet_directory() . '/assets/css/account.css' ) );
 wp_enqueue_script( 'wonderwish-account', get_stylesheet_directory_uri() . '/assets/js/account.js', array(), filemtime( get_stylesheet_directory() . '/assets/js/account.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );
} );

// Logged-in account styling uses native endpoints and is separate from guest login.
add_filter( 'body_class', function ( $classes ) {
 if ( function_exists( 'is_account_page' ) && is_account_page() && is_user_logged_in() ) {
  $classes[] = 'ww-account-page';
  if ( ! is_wc_endpoint_url() ) $classes[] = 'ww-account-home';
 }
 return $classes;
} );
add_action( 'wp_enqueue_scripts', function () {
 if ( ! function_exists( 'is_account_page' ) || ! is_account_page() || ! is_user_logged_in() ) return;
 wp_enqueue_script( 'wonderwish-world-glitter', get_stylesheet_directory_uri() . '/assets/js/world-glitter.js', array(), filemtime( get_stylesheet_directory() . '/assets/js/world-glitter.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );
 wp_enqueue_style( 'wonderwish-dashboard', get_stylesheet_directory_uri() . '/assets/css/dashboard.css', array(), filemtime( get_stylesheet_directory() . '/assets/css/dashboard.css' ) );
} );

// TI keeps its existing standalone wishlist, now using the account visual shell.
function wonderwish_is_wishlist_page() {
 return function_exists( 'tinv_get_option' ) && is_page( absint( tinv_get_option( 'page', 'wishlist' ) ) );
}
add_filter( 'body_class', function ( $classes ) {
 if ( wonderwish_is_wishlist_page() ) { $classes[] = 'ww-account-page'; $classes[] = 'ww-wishlist-page'; }
 return array_unique( $classes );
} );
add_action( 'wp_enqueue_scripts', function () {
 if ( ! wonderwish_is_wishlist_page() ) return;
 wp_enqueue_style( 'wonderwish-dashboard', get_stylesheet_directory_uri() . '/assets/css/dashboard.css', array(), filemtime( get_stylesheet_directory() . '/assets/css/dashboard.css' ) );
 wp_enqueue_script( 'wonderwish-world-glitter', get_stylesheet_directory_uri() . '/assets/js/world-glitter.js', array(), filemtime( get_stylesheet_directory() . '/assets/js/world-glitter.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );
} );
function wonderwish_account_inner_heading( $title, $description ) {
 $endpoint = wonderwish_is_wishlist_page() ? 'wishlist' : WC()->query->get_current_endpoint();
 $characters = array( 'orders' => 'tigress', 'wishlist' => 'genie-welcome', 'edit-address' => 'tinker-bell-wings', 'edit-account' => 'baymax', 'view-order' => 'tigress', 'downloads' => 'genie' );
 $character = isset( $characters[$endpoint] ) ? $characters[$endpoint] : '';
 ?><div class="ww-account-inner-heading<?php echo $character ? ' ww-inner-with-character' : ''; ?>"><div class="ww-inner-heading-copy"><a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>">← Back to your dashboard</a><h1><?php echo esc_html( $title ); ?></h1><p><?php echo esc_html( $description ); ?></p></div><?php if ( $character ) : ?><img class="ww-inner-character" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/account/' . $character . '.webp' ); ?>" alt="" aria-hidden="true" width="180" height="160" decoding="async"><?php endif; ?><span aria-hidden="true">✦</span></div><?php
}
add_action( 'woocommerce_account_content', function () {
 if ( ! is_wc_endpoint_url() ) return;
 $endpoint = WC()->query->get_current_endpoint();
 $titles = array( 'orders' => 'Your orders', 'view-order' => 'Order details', 'edit-address' => 'Your addresses', 'edit-account' => 'Account details', 'downloads' => 'Your downloads', 'payment-methods' => 'Payment methods', 'add-payment-method' => 'Add payment method' );
 $descriptions = array( 'orders' => 'Track your orders and revisit your favorite finds.', 'view-order' => 'Your order information, all in one place.', 'edit-address' => 'Keep your billing and delivery details up to date.', 'edit-account' => 'Make yourself at home. Manage your profile and password.', 'downloads' => 'Any downloads from your orders will appear here.' );
 wonderwish_account_inner_heading( isset( $titles[$endpoint] ) ? $titles[$endpoint] : 'Your account', isset( $descriptions[$endpoint] ) ? $descriptions[$endpoint] : 'Manage your account using the options below.' );
 echo '<div class="ww-account-inner-panel">';
}, 1 );
add_action( 'woocommerce_account_content', function () {
 if ( is_wc_endpoint_url() ) echo '</div>';
}, 999 );
add_filter( 'the_content', function ( $content ) {
 if ( ! wonderwish_is_wishlist_page() || ! is_main_query() || ! in_the_loop() || is_feed() ) return $content;
 ob_start();
 if ( is_user_logged_in() ) get_template_part( 'template-parts/account/cards' );
 wonderwish_account_inner_heading( 'Your wishlist', 'A little collection of things you love. Keep your favorite gifts close.' );
 $header = ob_get_clean();
 return $header . '<section class="ww-account-inner-panel ww-wishlist-panel" aria-label="Your saved gifts">' . $content . '</section>';
}, 20 );

// Shop presentation and strictly local administrator-only draft previews.
require_once __DIR__ . '/inc/shop.php';
require_once __DIR__ . '/inc/product.php';
require_once __DIR__ . '/inc/pages.php';
add_action( 'wp_enqueue_scripts', function () {
 wp_enqueue_style( 'wonderwish-site-ui', get_stylesheet_directory_uri() . '/assets/css/site-ui.css', array(), filemtime( __DIR__ . '/assets/css/site-ui.css' ) );
}, 99 );

require_once __DIR__ . '/inc/checkout-compat.php';
require_once __DIR__ . '/inc/site-consistency.php';

require_once __DIR__ . '/inc/home-editor.php';
require_once __DIR__ . '/inc/emails.php';

add_action( 'wp_enqueue_scripts', function () {
 if ( ! is_page( array( 'contact', 'contact-us' ) ) ) return;
 wp_enqueue_style( 'wonderwish-contact', get_stylesheet_directory_uri() . '/assets/css/contact.css', array(), filemtime( __DIR__ . '/assets/css/contact.css' ) );
} );
require_once __DIR__ . '/inc/contact.php';
