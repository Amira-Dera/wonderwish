<?php
/** Native WooCommerce/TI account shortcuts, shared across account screens. */
defined( 'ABSPATH' ) || exit;
$wishlist = function_exists( 'tinv_url_wishlist_default' ) ? tinv_url_wishlist_default() : '';
$cards = array(
 array( 'orders', __( 'Orders', 'woocommerce' ), __( 'Follow your little treasures.', 'fantasy-theme' ), wc_get_account_endpoint_url( 'orders' ) ),
 array( 'wishlist', __( 'Wishlist', 'fantasy-theme' ), __( 'Return to the gifts you love.', 'fantasy-theme' ), $wishlist ),
 array( 'address', __( 'Addresses', 'woocommerce' ), __( 'Manage your saved addresses.', 'fantasy-theme' ), wc_get_account_endpoint_url( 'edit-address' ) ),
 array( 'account', __( 'Account Details', 'fantasy-theme' ), __( 'Your name, email and password.', 'fantasy-theme' ), wc_get_account_endpoint_url( 'edit-account' ) ),
 array( 'logout', __( 'Logout', 'fantasy-theme' ), __( 'Until your next little adventure.', 'fantasy-theme' ), wc_logout_url() ),
);
$icons = array(
 'orders' => '<path d="m5 9 11-5 11 5v14l-11 5-11-5Zm0 0 11 5 11-5M16 14v14M10 6l11 5v6"/>',
 'wishlist' => '<path d="M16 27S3 19 3 11C3 3 13 2 16 9c3-7 13-6 13 2 0 8-13 16-13 16Z"/>',
 'address' => '<path d="M26 13c0 8-10 16-10 16S6 21 6 13a10 10 0 1 1 20 0Z"/><circle cx="16" cy="13" r="3"/>',
 'account' => '<circle cx="16" cy="10" r="6"/><path d="M5 29v-3c0-10 22-10 22 0v3"/>',
 'logout' => '<path d="M13 5H5v23h8M14 16h15m-6-6 6 6-6 6"/>',
);
?>
 <nav class="ww-customer-cards" aria-label="<?php esc_attr_e( 'Your account shortcuts', 'fantasy-theme' ); ?>">
 <?php foreach ( $cards as $card ) : if ( ! $card[3] ) continue; ?>
  <a class="ww-customer-card" href="<?php echo esc_url( $card[3] ); ?>" <?php if ( ( is_wc_endpoint_url( 'orders' ) && 'orders' === $card[0] ) || ( is_wc_endpoint_url( 'view-order' ) && 'orders' === $card[0] ) || ( is_wc_endpoint_url( 'edit-address' ) && 'address' === $card[0] ) || ( is_wc_endpoint_url( 'edit-account' ) && 'account' === $card[0] ) || ( function_exists( 'wonderwish_is_wishlist_page' ) && wonderwish_is_wishlist_page() && 'wishlist' === $card[0] ) ) echo 'aria-current="page"'; ?>><svg viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?php echo $icons[ $card[0] ]; // Static theme-owned SVG paths. ?></svg><h2><?php echo esc_html( $card[1] ); ?></h2><p><?php echo esc_html( $card[2] ); ?></p><span class="ww-customer-arrow" aria-hidden="true">↗</span></a>
 <?php endforeach; ?>
 </nav>
