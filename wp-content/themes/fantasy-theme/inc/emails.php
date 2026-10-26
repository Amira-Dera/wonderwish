<?php
/** Shared transactional email presentation. No recipients, tokens or order data changed. */
defined( 'ABSPATH' ) || exit;

// Correct the legacy local-store name without changing a custom sender address.
add_filter( 'woocommerce_email_from_name', function ( $name ) {
 return in_array( strtolower( trim( (string) $name ) ), array( '', 'toys store', 'toy store', 'wonder wish' ), true ) ? 'WonderWish' : $name;
} );

/** Attach just the theme logo as an inline CID; never fetch remote image URLs.
 * Other attachments and all authentication/recipient data remain untouched.
 */
function wonderwish_embed_email_logo( $mailer ) {
 $logo_url = get_stylesheet_directory_uri() . '/assets/images/brand/wonderwish-magical-logo.png';
 if ( ! is_string( $mailer->Body ) || false === strpos( $mailer->Body, $logo_url ) ) return;
 $file = get_stylesheet_directory() . '/assets/images/brand/wonderwish-magical-logo.png';
 if ( ! is_readable( $file ) ) return;
 try {
  if ( $mailer->addEmbeddedImage( $file, 'wonderwish-email-logo', 'WonderWish-logo.png', 'base64', 'image/png' ) ) {
   $mailer->Body = str_replace( $logo_url, 'cid:wonderwish-email-logo', $mailer->Body );
  }
 } catch ( \Exception $exception ) {
  // Keep the public URL as a fallback; a logo must never prevent mail delivery.
 }
}
add_action( 'phpmailer_init', 'wonderwish_embed_email_logo', 100 );

add_filter( 'woocommerce_email_styles', function ( $css ) {
 return $css . "\n" . file_get_contents( __DIR__ . '/../assets/css/emails.css' );
}, 30 );

// Preserve any footer written by the store owner; replace only WooCommerce's default.
add_filter( 'woocommerce_email_footer_text', function ( $text, $email = null ) {
 if ( $email instanceof WC_Email && 'plain' === $email->get_email_type() ) return $text;
 $legacy_default = '{site_title} &mdash; Built with {WooCommerce}';
 if ( $text && trim( $text ) !== $legacy_default ) return $text;
 return '<strong>WonderWish</strong><br>' . esc_html__( 'A little magic in every gift.', 'fantasy-theme' ) . '<br><a href="' . esc_url( wc_get_page_permalink( 'myaccount' ) ) . '">' . esc_html__( 'My Account', 'fantasy-theme' ) . '</a> &nbsp; · &nbsp; <a href="' . esc_url( wc_get_page_permalink( 'shop' ) ) . '">' . esc_html__( 'Explore the store', 'fantasy-theme' ) . '</a>';
}, 10, 2 );

/** Wrap only unwrapped messages. Existing WooCommerce documents are styled once. */
function wonderwish_wrap_transactional_email( $message, $heading ) {
 if ( ! function_exists( 'WC' ) || ! class_exists( 'WC_Email' ) || ! is_string( $message ) ) return $message;
 if ( preg_match( '/id=[\'\"](?:template_container|inner_wrapper)[\'\"]/', $message ) ) {
  $html = $message;
 } elseif ( preg_match( '/<(?:html|body)\b/i', $message ) ) {
  // Respect a third-party full HTML document rather than nesting a second one.
  return $message;
 } else {
  $content = preg_match( '/<(?:p|div|a|table|br)\b/i', $message ) ? $message : wpautop( make_clickable( esc_html( $message ) ) );
  $html = WC()->mailer()->wrap_message( $heading, $content );
 }
 $email = new WC_Email();
 $email->email_type = 'html';
 return $email->style_inline( $html );
}

// WPFactory's public sending hook covers separate activation/confirmation emails.
// It does not alter activation tokens, verification requirements or sending triggers.
add_filter( 'alg_wc_ev_send_mail_message', function ( $message ) {
 if ( is_string( $message ) && class_exists( 'WP_HTML_Tag_Processor' ) ) {
  $html = new WP_HTML_Tag_Processor( $message );
  while ( $html->next_tag( 'A' ) ) {
   $href = $html->get_attribute( 'href' );
   if ( is_string( $href ) && false !== strpos( $href, 'alg_wc_ev_verify_email' ) ) $html->add_class( 'button' );
  }
  $message = $html->get_updated_html();
 }
 return wonderwish_wrap_transactional_email( $message, __( 'Your WonderWish account', 'fantasy-theme' ) );
}, 30 );

// Core account emails sometimes originate outside WooCommerce (e.g. wp-login).
function wonderwish_style_core_account_email( $mail, $heading ) {
 if ( ! is_array( $mail ) || empty( $mail['message'] ) ) return $mail;
 $original = $mail['message'];
 $mail['message'] = wonderwish_wrap_transactional_email( $original, $heading );
 if ( $mail['message'] === $original ) return $mail;
 $headers = $mail['headers'] ?? array();
 $headers = is_array( $headers ) ? $headers : preg_split( '/\r?\n/', $headers );
 $headers = array_values( array_filter( $headers, static function ( $header ) { return ! preg_match( '/^Content-Type:/i', trim( $header ) ); } ) );
 $headers[] = 'Content-Type: text/html; charset=UTF-8';
 $mail['headers'] = $headers;
 return $mail;
}
add_filter( 'retrieve_password_notification_email', function ( $mail ) {
 return wonderwish_style_core_account_email( $mail, __( 'Reset your password', 'fantasy-theme' ) );
}, 30 );
add_filter( 'wp_new_user_notification_email', function ( $mail ) {
 return wonderwish_style_core_account_email( $mail, __( 'Welcome to WonderWish', 'fantasy-theme' ) );
}, 30 );
foreach ( array( 'password_change_email', 'email_change_email' ) as $hook ) {
 add_filter( $hook, function ( $mail ) {
  return wonderwish_style_core_account_email( $mail, __( 'Your account update', 'fantasy-theme' ) );
 }, 30 );
}
