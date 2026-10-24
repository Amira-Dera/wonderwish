<?php
/**
 * Title: WonderWish little treasures
 * Slug: fantasy-theme/little-treasures
 * Categories: featured
 * Description: Editable introduction and live WooCommerce product stream; no fictitious product fallback.
 */
defined( 'ABSPATH' ) || exit;
$shop = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
?>
<!-- wp:group {"tagName":"section","align":"full","className":"ww-treasures","layout":{"type":"default"},"metadata":{"name":"Little Treasures featured products"}} -->
<section class="wp-block-group alignfull ww-treasures">
<!-- wp:html --><div class="ww-world-glitter ww-treasure-glitter" aria-hidden="true"><canvas class="ww-world-canvas"></canvas><span>✦</span><span>✧</span><span>✦</span><span>✧</span><span>✦</span><span>✧</span></div><!-- /wp:html -->
<!-- wp:group {"className":"ww-treasure-intro","layout":{"type":"default"}} -->
<div class="wp-block-group ww-treasure-intro">
<!-- wp:paragraph {"className":"ww-treasure-eyebrow"} --><p class="ww-treasure-eyebrow">A LITTLE SOMETHING TO LOVE</p><!-- /wp:paragraph -->
<!-- wp:heading {"className":"ww-treasure-title"} --><h2 class="wp-block-heading ww-treasure-title">Little Treasures, Big Smiles.</h2><!-- /wp:heading -->
<!-- wp:paragraph {"className":"ww-treasure-subtitle"} --><p class="ww-treasure-subtitle">From beloved classics to new favorites, find a little magic for everyone.</p><!-- /wp:paragraph -->
</div><!-- /wp:group -->
<!-- wp:wonderwish/product-stream /-->
<!-- wp:buttons {"className":"ww-treasure-all"} -->
<div class="wp-block-buttons ww-treasure-all">
<!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $shop ); ?>">Explore all treasures <span aria-hidden="true">↗</span></a></div><!-- /wp:button -->
</div><!-- /wp:buttons -->
</section><!-- /wp:group -->
