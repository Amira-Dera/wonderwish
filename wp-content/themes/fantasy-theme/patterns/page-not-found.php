<?php
/**
 * Title: WonderWish page not found
 * Slug: fantasy-theme/page-not-found
 * Categories: text
 */
defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"className":"ww-page-content ww-not-found","layout":{"type":"default"}} -->
<div class="wp-block-group ww-page-content ww-not-found"><div class="ww-magic-404" role="img" aria-label="404 — page not found"><span aria-hidden="true">4<span class="ww-404-orb">0</span>4</span><i aria-hidden="true">✦</i></div><h2>There’s still plenty to discover.</h2><p>Explore your favorite worlds or return to the homepage.</p><div class="ww-page-actions"><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">Explore the shop</a><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Back to home</a></div></div>
<!-- /wp:group -->
