<?php
/**
 * Title: WonderWish product navigation
 * Slug: fantasy-theme/product-header
 * Categories: header
 */
defined( 'ABSPATH' ) || exit;
$shop = wc_get_page_permalink( 'shop' );
$wishlist = function_exists( 'tinv_url_wishlist_default' ) ? tinv_url_wishlist_default() : '';
?>
<!-- wp:group {"align":"full","className":"ww-shop-sky ww-product-sky","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull ww-shop-sky ww-product-sky">
<!-- wp:pattern {"slug":"fantasy-theme/site-navigation"} /-->
</div><!-- /wp:group -->
