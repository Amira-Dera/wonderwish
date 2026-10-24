<?php
/**
 * Account navigation: card shortcuts replace the default tab list.
 * @version 9.3.0
 */
defined( 'ABSPATH' ) || exit;
do_action( 'woocommerce_before_account_navigation' );
if ( is_wc_endpoint_url() ) { get_template_part( 'template-parts/account/cards' ); }
do_action( 'woocommerce_after_account_navigation' );
