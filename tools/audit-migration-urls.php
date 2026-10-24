<?php
/** Read-only destination simulation: studio wp eval-file tools/audit-migration-urls.php */
$destination = 'https://dera.demo.ly/wonderwish';
$original = array('home' => get_option('home'), 'siteurl' => get_option('siteurl'));
$simulate = static function () use ($destination) { return $destination; };
add_filter('option_home', $simulate);
add_filter('option_siteurl', $simulate);
// WP_CONTENT_URL was initialized before eval-file. Simulate its normal target
// bootstrap value as well; this does not verify the destination's server config.
$content_root = static function ($uri) use ($destination, $original) {
    return str_replace($original['siteurl'] . '/', $destination . '/', $uri);
};
add_filter('theme_root_uri', $content_root);
try {
    $urls = array(
        'home' => home_url('/'),
        'shop' => wc_get_page_permalink('shop'),
        'cart' => wc_get_cart_url(),
        'checkout' => wc_get_checkout_url(),
        'account' => wc_get_page_permalink('myaccount'),
        'orders' => wc_get_account_endpoint_url('orders'),
        'password_recovery' => wc_lostpassword_url(),
        'theme_assets' => get_stylesheet_directory_uri(),
        'store_api' => rest_url('wc/store/v1/products'),
        'search' => add_query_arg(array('s' => 'gift', 'post_type' => 'product'), home_url('/')),
    );
    foreach (array('accessories', 'plush-toys', 'collectibles', 'gift-sets') as $slug) {
        $term = get_term_by('slug', $slug, 'product_cat');
        if ($term) $urls['category_' . $slug] = get_term_link($term);
    }
    foreach (array('disney', 'dreamworks') as $world) {
        $urls[$world] = add_query_arg('filter_franchise', $world, wc_get_page_permalink('shop'));
    }
    $products = wc_get_products(array('limit' => 1, 'status' => 'publish'));
    if ($products) $urls['product'] = $products[0]->get_permalink();
    $failures = array();
    foreach ($urls as $label => $url) {
        if (is_wp_error($url) || !preg_match('~^https://dera\\.demo\\.ly/wonderwish(?:/|\\?|$)~', $url)) $failures[] = $label;
    }
    echo wp_json_encode(array('original_settings' => $original, 'simulation_only' => true, 'urls' => $urls, 'failures' => $failures), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";
} finally {
    remove_filter('option_home', $simulate);
    remove_filter('option_siteurl', $simulate);
    remove_filter('theme_root_uri', $content_root);
}
