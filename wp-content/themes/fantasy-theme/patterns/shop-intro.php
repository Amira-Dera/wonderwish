<?php
/**
 * Title: WonderWish catalogue introduction
 * Slug: fantasy-theme/shop-intro
 * Categories: banner
 * Description: Blue catalogue sky with native navigation and collection-specific artwork.
 */
defined( 'ABSPATH' ) || exit;
$shop = wc_get_page_permalink( 'shop' );
$world = wonderwish_shop_world();
$title = 'Find a little magic.';
$intro = 'Beloved characters. Thoughtful little finds. Explore gifts from the worlds you love.';
$character = 'donald-duck';
if ( is_product_category() ) {
 $term = get_queried_object(); $title = $term->name;
 $characters = array( 'accessories' => 'marie', 'plush-toys' => 'bambi-woodland', 'collectibles' => 'thumper', 'gift-sets' => 'belle-storybook' );
 $character = $characters[$term->slug] ?? 'donald-duck';
 $intro = 'A little character, a little wonder. Find your next favorite in ' . strtolower( $term->name ) . '.';
} elseif ( $world ) {
 $title = 'disney' === $world ? 'Discover Disney magic.' : 'Dream a little bigger.';
 $character = 'disney' === $world ? 'tiana-lily' : 'master-shifu';
 $intro = 'disney' === $world ? 'Classic stories and favorite faces, ready to inspire your next gift.' : 'Big personalities and unforgettable adventures. Explore our DreamWorks world.';
} elseif ( is_search() ) {
 $title = 'Your next little find.';
 $character = 'search-judy';
 $intro = 'Searching for “' . get_search_query() . '”. Explore the gifts that match your imagination.';
}
if ( is_search() ) $intro = 'Search results for “' . get_search_query() . '”. Try a different character, category or world to keep exploring.';
$wishlist = function_exists( 'tinv_url_wishlist_default' ) ? tinv_url_wishlist_default() : '';
?>
<!-- wp:group {"align":"full","className":"ww-shop-sky","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull ww-shop-sky">
<!-- wp:pattern {"slug":"fantasy-theme/site-navigation"} /-->
<!-- wp:group {"className":"ww-shop-hero","layout":{"type":"default"}} -->
<div class="wp-block-group ww-shop-hero">
<!-- wp:group {"className":"ww-shop-intro-copy","layout":{"type":"default"}} --><div class="wp-block-group ww-shop-intro-copy">
<!-- wp:paragraph {"className":"ww-shop-eyebrow"} --><p class="ww-shop-eyebrow">THE WONDERWISH COLLECTION</p><!-- /wp:paragraph -->
<!-- wp:heading {"level":1} --><h1 class="wp-block-heading"><?php echo esc_html( $title ); ?></h1><!-- /wp:heading -->
<!-- wp:paragraph {"className":"ww-shop-description"} --><p class="ww-shop-description"><?php echo esc_html( $intro ); ?></p><!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"ww-shop-hero-link"} --><p class="ww-shop-hero-link"><a href="#ww-shop-products">Explore the collection <span aria-hidden="true">↓</span></a></p><!-- /wp:paragraph -->
</div><!-- /wp:group -->
<!-- wp:group {"className":"ww-shop-character-wrap","layout":{"type":"default"}} --><div class="wp-block-group ww-shop-character-wrap">
<!-- wp:image {"className":"ww-shop-character","sizeSlug":"full","linkDestination":"none"} --><figure class="wp-block-image size-full ww-shop-character"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . ( 'search-judy' === $character ? '/assets/images/states/judy-hopps.png' : '/assets/images/shop/' . $character . '-catalogue.webp' ) ); ?>" alt="" width="400" height="320" decoding="async" fetchpriority="high" /></figure><!-- /wp:image -->
<!-- wp:html --><span class="ww-shop-spark ww-shop-spark-one" aria-hidden="true">✦</span><span class="ww-shop-spark ww-shop-spark-two" aria-hidden="true">✧</span><span class="ww-shop-spark ww-shop-spark-three" aria-hidden="true">✦</span><!-- /wp:html -->
</div><!-- /wp:group -->
</div><!-- /wp:group -->
</div><!-- /wp:group -->
