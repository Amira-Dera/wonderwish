<?php
/** Live WooCommerce catalogue within the editable Home page. */
defined( 'ABSPATH' ) || exit;
$shop = wc_get_page_permalink( 'shop' );
if ( ! wc_get_products( array( 'status'=>'publish', 'limit'=>1, 'return'=>'ids', 'visibility'=>'catalog' ) ) ) {
 echo '<p>No gifts are available yet. Please check back soon.</p>'; return;
}
?>
<div class="ww-orbit-controls" hidden><button type="button" class="ww-orbit-toggle" aria-pressed="false">Pause motion</button><span>Hover a card to pause</span></div>
<div class="ww-treasure-grid">
<?php
$available_gifts = wc_get_products( array( 'status' => 'publish', 'visibility' => 'catalog', 'limit' => 32, 'orderby' => 'date', 'order' => 'DESC' ) );
$world_gifts = array( 'disney' => array(), 'dreamworks' => array(), 'other' => array() );
foreach ( $available_gifts as $available_gift ) {
 $worlds = wc_get_product_terms( $available_gift->get_id(), 'pa_franchise', array( 'fields' => 'slugs' ) );
 $world = in_array( 'disney', $worlds, true ) ? 'disney' : ( in_array( 'dreamworks', $worlds, true ) ? 'dreamworks' : 'other' );
 $world_gifts[ $world ][] = $available_gift;
}
$featured_gifts = array();
while ( count( $featured_gifts ) < 8 && array_filter( $world_gifts ) ) {
 foreach ( $world_gifts as &$world_group ) {
  if ( $world_group && count( $featured_gifts ) < 8 ) $featured_gifts[] = array_shift( $world_group );
 }
 unset( $world_group );
}
$tints = array( 'rose', 'lavender', 'ice', 'peach', 'sun', 'sage', 'aqua', 'pink' );
foreach ( $featured_gifts as $index => $gift ) :
 $categories = get_the_terms( $gift->get_id(), 'product_cat' );
 $category = ! is_wp_error( $categories ) && $categories ? reset( $categories ) : null;
 $category_url = $category ? get_term_link( $category ) : $shop;
 if ( is_wp_error( $category_url ) ) $category_url = $shop;
?>
<article class="ww-treasure-card ww-tint-<?php echo esc_attr( $tints[ $index % count( $tints ) ] ); ?>">
 <div class="ww-treasure-picture">
  <p class="ww-treasure-badge"><a href="<?php echo esc_url( $category_url ); ?>"><?php echo esc_html( $category ? $category->name : 'All gifts' ); ?> <span aria-hidden="true">↗</span></a></p>
  <a class="ww-treasure-image" href="<?php echo esc_url( $gift->get_permalink() ); ?>" aria-label="<?php echo esc_attr( $gift->get_name() ); ?>"><?php echo $gift->get_image( 'woocommerce_thumbnail', array( 'loading' => 'lazy', 'decoding' => 'async', 'alt' => '' ) ); ?></a>
 </div>
 <div class="ww-treasure-details"><h3 class="ww-treasure-name"><a href="<?php echo esc_url( $gift->get_permalink() ); ?>"><?php echo esc_html( $gift->get_name() ); ?></a></h3><p class="ww-treasure-price"><?php echo wp_kses_post( $gift->get_price_html() ); ?></p></div>
</article>
<?php endforeach; ?>
</div>
