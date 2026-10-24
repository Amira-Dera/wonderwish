<?php
/**
 * Title: WonderWish footer
 * Slug: fantasy-theme/wonderwish-footer
 * Categories: footer
 * Description: Shared site footer with native store destinations and verified public information.
 */
defined( 'ABSPATH' ) || exit;
$shop = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
$account = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : '';
$cart = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : '';
$wishlist_page = get_page_by_path( 'wishlist' );
$wishlist = $wishlist_page && 'publish' === $wishlist_page->post_status ? get_permalink( $wishlist_page ) : '';
$privacy = get_privacy_policy_url();
$terms_id = function_exists( 'wc_get_page_id' ) ? wc_get_page_id( 'terms' ) : 0;
$terms = $terms_id > 0 && 'publish' === get_post_status( $terms_id ) ? get_permalink( $terms_id ) : '';
$contact_page = get_page_by_path( 'contact' );
if ( ! $contact_page ) { $contact_page = get_page_by_path( 'contact-us' ); }
$contact = $contact_page && 'publish' === $contact_page->post_status ? get_permalink( $contact_page ) : '';
$delivery_page = get_page_by_path( 'delivery-information' );
$delivery = $delivery_page && 'publish' === $delivery_page->post_status ? get_permalink( $delivery_page ) : '';
?>
<!-- wp:group {"tagName":"footer","align":"full","className":"ww-footer ww-footer-refined","layout":{"type":"default"},"metadata":{"name":"WonderWish Site Footer"}} -->
<footer class="wp-block-group alignfull ww-footer ww-footer-refined">
<!-- wp:html --><div class="ww-footer-stardust" aria-hidden="true"><span>✦</span><span>✧</span><span>✦</span></div><!-- /wp:html -->
<!-- wp:group {"className":"ww-footer-inner","layout":{"type":"default"}} --><div class="wp-block-group ww-footer-inner">
<!-- wp:group {"className":"ww-footer-top","layout":{"type":"default"}} --><div class="wp-block-group ww-footer-top">
<!-- wp:group {"className":"ww-footer-brand","layout":{"type":"default"}} --><div class="wp-block-group ww-footer-brand">
<!-- wp:paragraph {"className":"ww-footer-wordmark"} --><p class="ww-footer-wordmark"><a href="<?php echo esc_url(home_url('/')); ?>"><img class="ww-brand-logo" src="<?php echo esc_url(get_stylesheet_directory_uri().'/assets/images/brand/wonderwish-magical-logo-blue.png'); ?>" alt="WonderWish" width="205" height="84" style="width:205px;height:auto;max-width:100%"></a></p><!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"ww-footer-tagline"} --><p class="ww-footer-tagline">A little magic in every gift.</p><!-- /wp:paragraph -->
</div><!-- /wp:group -->
<!-- wp:group {"className":"ww-footer-discover","layout":{"type":"default"}} --><div class="wp-block-group ww-footer-discover">

<!-- wp:html --><nav aria-label="Footer"><a href="<?php echo esc_url($shop); ?>">Shop all <span aria-hidden="true">↗</span></a><a href="<?php echo esc_url(add_query_arg('filter_franchise','disney',$shop)); ?>">Disney</a><a href="<?php echo esc_url(add_query_arg('filter_franchise','dreamworks',$shop)); ?>">DreamWorks</a><?php if($account): ?><a href="<?php echo esc_url($account); ?>">My account</a><?php endif; ?></nav><!-- /wp:html -->
</div><!-- /wp:group -->
</div><!-- /wp:group -->
<!-- wp:group {"className":"ww-footer-base","layout":{"type":"default"}} --><div class="wp-block-group ww-footer-base">
<!-- wp:paragraph {"className":"ww-footer-delivery"} --><p class="ww-footer-delivery">Gifting across selected cities in Libya.<br>Please confirm delivery availability before ordering.</p><!-- /wp:paragraph -->
<!-- wp:html --><div class="ww-footer-legal"><p>© <?php echo esc_html(wp_date('Y')); ?> WonderWish</p><?php if($contact): ?><a href="<?php echo esc_url($contact); ?>">Contact</a><?php endif; ?><?php if($delivery): ?><a href="<?php echo esc_url($delivery); ?>">Delivery</a><?php endif; ?><?php if($privacy): ?><a href="<?php echo esc_url($privacy); ?>">Privacy</a><?php endif; ?><?php if($terms): ?><a href="<?php echo esc_url($terms); ?>">Terms</a><?php endif; ?></div><!-- /wp:html -->
</div><!-- /wp:group -->
</div><!-- /wp:group -->
</footer><!-- /wp:group -->
