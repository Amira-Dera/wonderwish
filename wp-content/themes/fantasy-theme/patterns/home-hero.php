<?php
/**
 * Title: WonderWish homepage hero
 * Slug: fantasy-theme/home-hero
 * Categories: banner
 * Description: Editable blue-gradient hero with native store navigation and an original magical light treatment.
 */
defined( 'ABSPATH' ) || exit;
$shop = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
$account = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : wp_login_url();
$wishlist_id = function_exists( 'tinv_get_option' ) ? absint( tinv_get_option( 'page', 'wishlist' ) ) : 0;
$wishlist = $wishlist_id ? get_permalink( $wishlist_id ) : '';
$categories = array( 'accessories' => 'Accessories', 'plush-toys' => 'Plush Toys', 'collectibles' => 'Collectibles', 'gift-sets' => 'Gift Sets' );
?>
<!-- wp:group {"align":"full","className":"ww-hero ww-magic-hero","layout":{"type":"default"},"metadata":{"name":"WonderWish magical intro"}} -->
<div class="wp-block-group alignfull ww-hero ww-magic-hero">
<!-- wp:html -->
<div class="ww-magic-layer" aria-hidden="true"><canvas class="ww-magic-canvas" aria-hidden="true"></canvas></div>
<!-- /wp:html -->
<!-- wp:pattern {"slug":"fantasy-theme/site-navigation"} /-->
<!-- wp:group {"tagName":"main","className":"ww-hero-body","layout":{"type":"default"},"metadata":{"name":"Hero introduction"}} -->
<main class="wp-block-group ww-hero-body">
<!-- wp:group {"className":"ww-copy","layout":{"type":"default"},"metadata":{"name":"Hero copy and actions"}} -->
<div class="wp-block-group ww-copy">
<!-- wp:paragraph {"className":"ww-eyebrow"} -->
<p class="ww-eyebrow">YOUR FAVORITE WORLDS, ALL IN ONE PLACE</p><!-- /wp:paragraph -->
<!-- wp:heading {"level":1,"className":"ww-headline"} -->
<h1 class="wp-block-heading ww-headline">A Little Magic<br>Goes a Long Way.</h1><!-- /wp:heading -->
<!-- wp:paragraph {"className":"ww-description"} -->
<p class="ww-description">Discover gifts, collectibles, accessories, and keepsakes inspired by the characters and stories you love.</p><!-- /wp:paragraph -->
<!-- wp:buttons {"className":"ww-actions"} -->
<div class="wp-block-buttons ww-actions">
<!-- wp:button {"className":"ww-primary"} -->
<div class="wp-block-button ww-primary"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $shop ); ?>">Explore the Store <span aria-hidden="true">↗</span></a></div><!-- /wp:button -->
<!-- wp:button {"className":"is-style-outline ww-secondary"} -->
<div class="wp-block-button is-style-outline ww-secondary"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $shop ); ?>">Discover Collections</a></div><!-- /wp:button -->
</div><!-- /wp:buttons -->
</div><!-- /wp:group -->
</main><!-- /wp:group -->
</div><!-- /wp:group -->
