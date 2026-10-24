<?php
/**
 * Title: WonderWish shared navigation
 * Slug: fantasy-theme/site-navigation
 * Categories: header
 */
defined( 'ABSPATH' ) || exit;
$shop = wc_get_page_permalink( 'shop' );
$wishlist = function_exists( 'tinv_url_wishlist_default' ) ? tinv_url_wishlist_default() : '';
?>
<!-- wp:group {"tagName":"header","className":"ww-site-header","layout":{"type":"default"}} -->
<header class="wp-block-group ww-site-header">
<!-- wp:paragraph {"className":"ww-site-brand"} --><p class="ww-site-brand"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="ww-brand-logo" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/brand/wonderwish-magical-logo.png' ); ?>" alt="WonderWish" width="210" height="87" style="width:210px;height:auto;max-width:100%"></a></p><!-- /wp:paragraph -->
<!-- wp:navigation {"overlayMenu":"mobile","ariaLabel":"WonderWish navigation","className":"ww-site-navigation","metadata":{"ignoredHookedBlocks":["woocommerce/customer-account","woocommerce/mini-cart"]},"layout":{"type":"flex","justifyContent":"right"}} -->
<?php foreach ( array( 'Shop All' => $shop, 'Disney' => add_query_arg( 'filter_franchise', 'disney', $shop ), 'DreamWorks' => add_query_arg( 'filter_franchise', 'dreamworks', $shop ) ) as $label => $url ) : ?>
<!-- wp:navigation-link <?php echo wp_json_encode( array( 'label' => $label, 'url' => $url, 'kind' => 'custom' ) ); ?> /-->
<?php endforeach; ?>
<!-- wp:navigation-link <?php echo wp_json_encode( array( 'label'=>'My Account', 'url'=>wc_get_page_permalink('myaccount'), 'kind'=>'custom', 'className'=>'ww-account-entry' ) ); ?> /-->
<!-- /wp:navigation -->
<!-- wp:group {"className":"ww-site-tools","layout":{"type":"flex","flexWrap":"nowrap"}} --><div class="wp-block-group ww-site-tools">
<!-- wp:html --><?php echo str_replace( array( 'aria-label=""', 'class="wishlist_products_counter_number"' ), array( 'aria-label="Wishlist"', 'class="wishlist_products_counter_number" aria-live="polite"' ), do_shortcode( '[ti_wishlist_products_counter show_icon="true" show_text="false" text="Wishlist" show_counter="true"]' ) ); ?><!-- /wp:html -->
<?php if ( is_cart() || is_checkout() ) : ?>
<!-- wp:html --><a class="ww-nav-cart-link" href="<?php echo esc_url( wc_get_cart_url() ); ?>" aria-label="View cart"><svg viewBox="0 0 24 24" width="25" height="25" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M5 7h14l1 14H4L5 7Z"/><path d="M8 8V6a4 4 0 0 1 8 0v2M8 10a4 4 0 0 0 8 0"/></svg></a><!-- /wp:html -->
<?php else : ?><!-- wp:woocommerce/mini-cart {"miniCartIcon":"bag","hasHiddenPrice":true} /--><?php endif; ?>
</div><!-- /wp:group -->
</header><!-- /wp:group -->
