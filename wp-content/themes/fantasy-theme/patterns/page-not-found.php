<?php
/**
 * Title: WonderWish page not found
 * Slug: fantasy-theme/page-not-found
 * Categories: text
 */
defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"className":"ww-page-content ww-not-found","layout":{"type":"default"}} -->
<div class="wp-block-group ww-page-content ww-not-found"><p aria-hidden="true" class="ww-not-found-spark">✦</p><h2>There’s still plenty to discover.</h2><p>Explore your favorite worlds or return to the homepage.</p><div class="ww-page-actions"><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">Explore the shop</a><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Back to home</a></div></div>
<!-- /wp:group -->
