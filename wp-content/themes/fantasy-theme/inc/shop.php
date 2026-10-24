<?php
/** Native WooCommerce catalogue presentation. No separate product store or public draft access. */
defined( 'ABSPATH' ) || exit;

function wonderwish_is_catalogue() {
 return function_exists( 'is_shop' ) && ( is_shop() || is_product_taxonomy() || ( is_search() && 'product' === get_query_var( 'post_type' ) ) );
}
function wonderwish_shop_preview() {
 return 'local' === wp_get_environment_type()
  && in_array( wp_parse_url( home_url(), PHP_URL_HOST ), array( 'localhost', '127.0.0.1', '::1' ), true )
  && current_user_can( 'manage_woocommerce' ) && current_user_can( 'edit_others_products' )
  && isset( $_GET['ww_catalogue_preview'], $_GET['_wpnonce'] )
  && '1' === sanitize_text_field( wp_unslash( $_GET['ww_catalogue_preview'] ) )
  && wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'ww-catalogue-preview' );
}
function wonderwish_catalogue_url( $url ) {
 return wonderwish_shop_preview() ? wp_nonce_url( add_query_arg( 'ww_catalogue_preview', '1', $url ), 'ww-catalogue-preview' ) : $url;
}
function wonderwish_shop_world() {
 $world = isset( $_GET['filter_franchise'] ) && is_string( $_GET['filter_franchise'] ) ? sanitize_title( wp_unslash( $_GET['filter_franchise'] ) ) : '';
 return in_array( $world, array( 'disney', 'dreamworks' ), true ) ? $world : '';
}
add_filter( 'body_class', function ( $classes ) {
 if ( wonderwish_is_catalogue() ) { $classes[] = 'ww-shop-page'; if ( wonderwish_shop_preview() ) $classes[] = 'ww-shop-draft-preview'; }
 return $classes;
} );
add_action( 'wp_enqueue_scripts', function () {
 if ( ! wonderwish_is_catalogue() ) return;
 wp_enqueue_style( 'wonderwish-shop', get_stylesheet_directory_uri() . '/assets/css/shop.css', array(), filemtime( __DIR__ . '/../assets/css/shop.css' ) );
 wp_enqueue_script( 'wonderwish-world-glitter', get_stylesheet_directory_uri() . '/assets/js/world-glitter.js', array(), filemtime( __DIR__ . '/../assets/js/world-glitter.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );
}, 25 );
add_action( 'after_setup_theme', function () { add_editor_style( 'assets/css/shop.css' ); } );
add_action( 'template_redirect', function () {
 if ( ! wonderwish_is_catalogue() || ! isset( $_GET['ww_catalogue_preview'] ) ) return;
 nocache_headers();
 header( 'X-Robots-Tag: noindex, nofollow', true );
 if ( ! defined( 'DONOTCACHEPAGE' ) ) define( 'DONOTCACHEPAGE', true );
} );
add_filter( 'wp_robots', function ( $robots ) {
 if ( wonderwish_is_catalogue() && isset( $_GET['ww_catalogue_preview'] ) ) { $robots['noindex'] = true; $robots['nofollow'] = true; }
 return $robots;
} );
add_action( 'woocommerce_product_query', function ( $query ) {
 if ( ! $query->is_main_query() || ! wonderwish_is_catalogue() ) return;
 $query->set( 'posts_per_page', 12 );
 if ( wonderwish_shop_preview() ) $query->set( 'post_status', array( 'publish', 'draft' ) );
} );
add_filter( 'woocommerce_product_is_visible', function ( $visible, $id ) {
 if ( wonderwish_is_catalogue() && wonderwish_shop_preview() && 'draft' === get_post_status( $id ) && current_user_can( 'edit_post', $id ) ) return true;
 return $visible;
}, 10, 2 );
add_filter( 'woocommerce_loop_product_link', function ( $url, $product ) {
 if ( wonderwish_is_catalogue() && wonderwish_shop_preview() && 'draft' === $product->get_status() ) return get_preview_post_link( $product->get_id() );
 return $url;
}, 10, 2 );
add_filter( 'woocommerce_structured_data_product', function ( $data ) { return wonderwish_is_catalogue() && wonderwish_shop_preview() ? array() : $data; } );
add_filter( 'woocommerce_show_page_title', function ( $show ) { return wonderwish_is_catalogue() ? false : $show; } );
add_filter( 'loop_shop_columns', function ( $columns ) { return wonderwish_is_catalogue() ? 4 : $columns; } );

/** Filters use native product_cat archives and WooCommerce's layered-nav attribute query. */
add_action( 'woocommerce_before_main_content', function () {
 if ( ! wonderwish_is_catalogue() ) return;
 $shop = wc_get_page_permalink( 'shop' ); $world = wonderwish_shop_world();
 ?>
 <section class="ww-shop-browse" id="ww-shop-products" aria-label="Browse the gift collection">
 <div class="ww-shop-browse-top"><div><p class="ww-shop-kicker">FIND YOUR LITTLE TREASURE</p><h2>What will make you smile?</h2></div>
 <form role="search" method="get" action="<?php echo esc_url( $shop ); ?>" class="ww-shop-search"><label for="ww-product-search">Search gifts</label><div><input id="ww-product-search" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="Try a favorite character…"><input type="hidden" name="post_type" value="product"><?php if ( $world ) : ?><input type="hidden" name="filter_franchise" value="<?php echo esc_attr( $world ); ?>"><?php endif; ?><?php if ( is_product_category() ) : ?><input type="hidden" name="product_cat" value="<?php echo esc_attr( get_queried_object()->slug ); ?>"><?php endif; ?><?php if ( wonderwish_shop_preview() ) : ?><input type="hidden" name="ww_catalogue_preview" value="1"><input type="hidden" name="_wpnonce" value="<?php echo esc_attr( wp_create_nonce( 'ww-catalogue-preview' ) ); ?>"><?php endif; ?><button type="submit">Search</button></div></form></div>
 <nav class="ww-category-filters" aria-label="Product categories"><a href="<?php echo esc_url( wonderwish_catalogue_url( $world ? add_query_arg( 'filter_franchise', $world, $shop ) : $shop ) ); ?>" <?php if ( ! is_product_category() ) echo 'aria-current="page"'; ?>>All gifts</a>
 <?php foreach ( array( 'accessories', 'plush-toys', 'collectibles', 'gift-sets' ) as $slug ) : $term = get_term_by( 'slug', $slug, 'product_cat' ); if ( ! $term ) continue; $url = get_term_link( $term ); if ( is_wp_error( $url ) ) continue; if ( $world ) $url = add_query_arg( 'filter_franchise', $world, $url ); ?>
 <a href="<?php echo esc_url( wonderwish_catalogue_url( $url ) ); ?>" <?php if ( is_product_category( $slug ) ) echo 'aria-current="page"'; ?>><?php echo esc_html( $term->name ); ?></a>
 <?php endforeach; ?></nav>
 <nav class="ww-franchise-filters" aria-label="Favorite world"><?php $base = is_product_category() ? get_term_link( get_queried_object() ) : $shop; foreach ( array( '' => 'All worlds', 'disney' => 'Disney', 'dreamworks' => 'DreamWorks' ) as $slug => $label ) : $url = $slug ? add_query_arg( 'filter_franchise', $slug, $base ) : $base; ?>
 <a class="<?php echo $slug ? 'ww-world-logo-filter' : 'ww-world-reset'; ?>" href="<?php echo esc_url( wonderwish_catalogue_url( $url ) ); ?>" <?php if ( $world === $slug ) echo 'aria-current="page"'; ?>><?php if ( $slug ) : ?><img class="ww-franchise-logo" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logos/' . $slug . '.svg' ); ?>" alt="<?php echo esc_attr( $label ); ?>" width="130" height="52" decoding="async"><?php if ( $world === $slug ) : ?><span class="ww-world-check" aria-hidden="true">✓</span><?php endif; ?><?php else : ?>All worlds<?php endif; ?></a><?php endforeach; ?></nav>


 <?php if ( wonderwish_shop_preview() && wp_count_posts( 'product' )->draft > 0 ) : ?><aside class="ww-shop-preview-note" aria-label="Private catalogue preview"><strong>Private local preview · <?php echo esc_html( (string) wp_count_posts( 'product' )->draft ); ?> draft proposals</strong><p>Draft images and suggested prices are for review. Supplier, inventory and commercial image rights are unverified. Drafts cannot be purchased.</p><a href="<?php echo esc_url( $shop ); ?>">View the public shop</a></aside>
 <?php elseif ( wp_count_posts( 'product' )->draft > 0 && 'local' === wp_get_environment_type() && current_user_can( 'manage_woocommerce' ) && current_user_can( 'edit_others_products' ) ) : ?><aside class="ww-shop-preview-note"><strong>Administrator preview</strong><p>Your product drafts remain private. Review the catalogue layout locally without publishing them.</p><a href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'ww_catalogue_preview', '1', $shop ), 'ww-catalogue-preview' ) ); ?>">Preview draft catalogue →</a></aside><?php endif; ?>
 </section>
 <?php
}, 25 );
add_filter( 'woocommerce_loop_add_to_cart_link', function ( $html, $product ) {
 if ( ! wonderwish_is_catalogue() ) return $html;
 if ( wonderwish_shop_preview() && 'draft' === $product->get_status() ) return ''; 
 return $html; // Native AJAX Add to cart, variation selection or out-of-stock Read more.
}, 10, 2 );
add_action( 'woocommerce_no_products_found', function () {
 if ( ! wonderwish_is_catalogue() ) return;
 echo '<div class="ww-shop-empty"><span aria-hidden="true">✦</span><h2>' . esc_html( is_search() || is_product_category() || wonderwish_shop_world() ? 'A little more exploring?' : 'A little magic is on its way' ) . '</h2><p>' . esc_html( is_search() || is_product_category() || wonderwish_shop_world() ? 'There are no matching gifts to show. Try another category, world or search.' : 'Our gift collection is getting ready. Please check back for new arrivals.' ) . '</p><a href="' . esc_url( wonderwish_catalogue_url( wc_get_page_permalink( 'shop' ) ) ) . '">Explore all gifts →</a></div>';
}, 20 );

add_filter( 'single_product_archive_thumbnail_size', function ( $size ) { return wonderwish_is_catalogue() ? 'full' : $size; } );

// Keep WooCommerce's page calculation/links; make the controls explicit and compact.
add_filter( 'woocommerce_pagination_args', function ( $args ) {
 if ( wonderwish_is_catalogue() ) {
  $args['prev_text'] = '<span aria-hidden="true">←</span> Previous';
  $args['next_text'] = 'Next <span aria-hidden="true">→</span>';
  $args['mid_size'] = 1;
  $args['end_size'] = 1;
 }
 return $args;
} );

add_filter( 'wp_get_attachment_image_attributes', function ( $attr, $attachment ) {
 if ( wonderwish_is_catalogue() && 'product' === get_post_type( $attachment->post_parent ) ) {
  $attr['sizes'] = '(max-width: 700px) calc((100vw - 80px) / 2), (max-width: 1000px) calc((100vw - 130px) / 3), 280px';
 }
 return $attr;
}, 10, 2 );

// Keep the catalogue controls focused on native category/world browsing and search.
add_action( 'wp', function () {
 if ( wonderwish_is_catalogue() ) remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
} );
