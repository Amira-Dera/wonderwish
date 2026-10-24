<?php
/**
 * WonderWish customer dashboard.
 * Native WooCommerce dashboard override; keep hooks compatible with the upstream template.
 * @version 4.4.0
 */
defined( 'ABSPATH' ) || exit;
$user = wp_get_current_user();
$name = $user->first_name ? $user->first_name : $user->display_name;
$orders = wc_get_orders( array( 'customer_id' => get_current_user_id(), 'status' => array_keys( wc_get_order_statuses() ), 'limit' => 5, 'orderby' => 'date', 'order' => 'DESC' ) );
?>
<section class="ww-customer-dashboard" aria-labelledby="ww-customer-welcome">
 <div class="ww-customer-welcome">
  <div class="ww-customer-intro"><p class="ww-customer-eyebrow">YOUR WONDERWISH WORLD</p>
  <h1 id="ww-customer-welcome"><?php printf( esc_html__( 'Welcome back, %s!', 'fantasy-theme' ), esc_html( $name ) ); ?></h1>
  <p>A little space for your favorite things. Your gifts, wishes, and next adventures—all together.</p>
  <a class="ww-customer-shop" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">Discover a little magic <span aria-hidden="true">↗</span></a></div>
  <div class="ww-customer-character" aria-hidden="true"><span>✦</span><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/account/dumbo.webp' ); ?>" alt="" width="700" height="600" decoding="async"><span>✧</span></div>
 </div>
 <?php get_template_part( 'template-parts/account/cards' ); ?>
 <section class="ww-customer-orders" aria-labelledby="ww-recent-orders"><div class="ww-customer-orders-heading"><h2 id="ww-recent-orders">Recent orders</h2><a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>">View all orders <span aria-hidden="true">↗</span></a></div>
 <?php if ( $orders ) : ?>
 <div class="ww-customer-table-scroll" tabindex="0" role="region" aria-label="Recent orders table"><table><caption class="screen-reader-text">Your five most recent orders</caption><thead><tr><th scope="col">Order</th><th scope="col">Date</th><th scope="col">Status</th><th scope="col">Total</th><th scope="col">Details</th></tr></thead><tbody>
 <?php foreach ( $orders as $order ) : if ( (int) $order->get_customer_id() !== get_current_user_id() ) continue; $date = $order->get_date_created(); ?>
 <tr><th scope="row"><a href="<?php echo esc_url( $order->get_view_order_url() ); ?>">#<?php echo esc_html( $order->get_order_number() ); ?></a></th><td><?php if ( $date ) : ?><time datetime="<?php echo esc_attr( $date->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $date ) ); ?></time><?php endif; ?></td><td><span class="ww-order-status"><?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?></span></td><td><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></td><td><a href="<?php echo esc_url( $order->get_view_order_url() ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'View order %s', 'fantasy-theme' ), $order->get_order_number() ) ); ?>">View order</a></td></tr>
 <?php endforeach; ?></tbody></table></div>
 <?php else : ?>
 <div class="ww-customer-empty"><span aria-hidden="true">✦</span><h3>Your next little adventure starts here</h3><p>You haven’t placed an order yet. When you do, you can find it here.</p><a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">Explore the shop <span aria-hidden="true">↗</span></a></div>
 <?php endif; ?>
 </section>
 <p class="ww-customer-art-credit">Local preview artwork: <a href="https://www.stickpng.com/img/cartoons/dumbo/dumbo-with-yellow-hat">Dumbo · StickPNG</a>. Personal use only; commercial rights require clearance.</p>
</section>
<?php
do_action( 'woocommerce_account_dashboard' );
do_action( 'woocommerce_before_my_account' );
do_action( 'woocommerce_after_my_account' );
