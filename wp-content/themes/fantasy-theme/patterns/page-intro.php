<?php
/**
 * Title: WonderWish page introduction
 * Slug: fantasy-theme/page-intro
 * Categories: banner
 */
defined( 'ABSPATH' ) || exit;
if ( is_account_page() || wonderwish_is_wishlist_page() ) return;
$title = is_404() ? 'A little lost in the magic?' : get_the_title();
$intro = '';
$character = is_cart() ? 'checkout/pooh-cart.png' : ( is_checkout() ? 'checkout/remy-checkout.png' : ( is_404() ? 'states/cheshire-cat.png' : ( is_search() ? 'states/judy-hopps.png' : '' ) ) );
if ( is_cart() ) { $title = 'Your cart'; $intro = 'Your little treasures, all in one place. Review your gifts before continuing.'; }
elseif ( is_checkout() ) { $title = is_wc_endpoint_url( 'order-received' ) ? 'Your order' : 'Checkout'; $intro = is_wc_endpoint_url( 'order-received' ) ? '' : 'A few details, then you’re one step closer to your next little treasure.'; }
elseif ( is_page( array( 'contact', 'contact-us' ) ) ) { $intro = 'Questions, gift ideas, or a little guidance. We’re here to help you find your way.'; $character = 'contact/alice-contact.png'; }
elseif ( is_404() ) $intro = 'This page has wandered off. Let’s find your way back to something wonderful.';
elseif ( is_search() ) { $title = 'Search results'; $intro = sprintf( 'Exploring the site for “%s”.', get_search_query() ); }
?>
<!-- wp:group {"align":"full","className":"ww-page-intro","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull ww-page-intro"><!-- wp:html --><div class="ww-page-intro-inner"><div>
<p class="ww-page-eyebrow">WONDERWISH <span aria-hidden="true">✦</span></p>
<h1><?php echo esc_html( $title ); ?></h1>
<?php if ( $intro ) : ?><p class="ww-page-intro-copy"><?php echo esc_html( $intro ); ?></p><?php endif; ?>
<?php if ( is_cart() || is_checkout() ) : ?><nav class="ww-purchase-steps" aria-label="Shopping steps"><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">Shop</a><span aria-hidden="true">/</span><a href="<?php echo esc_url( wc_get_cart_url() ); ?>" <?php if ( is_cart() ) echo 'aria-current="page"'; ?>>Cart</a><span aria-hidden="true">/</span><span <?php if ( is_checkout() ) echo 'aria-current="step"'; ?>>Checkout</span></nav><?php endif; ?>
</div><?php if ( $character ) : ?><div class="ww-page-character" aria-hidden="true"><span>✦</span><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/' . $character ); ?>" alt="" width="300" height="260" decoding="async"><span>✧</span></div><?php endif; ?></div><!-- /wp:html --></div>
<!-- /wp:group -->
