<?php
/** Render synthetic local previews only. Never triggers/sends mail or saves objects.
 * Run: studio wp eval-file tools/preview-emails.php
 */
if ( ! defined( 'WP_CLI' ) || ! WP_CLI || ! in_array( wp_parse_url( home_url(), PHP_URL_HOST ), array( 'localhost', '127.0.0.1', '::1' ), true ) ) {
 throw new RuntimeException( 'Email previews are restricted to local CLI execution.' );
}
// Preview brand label only; never change the saved local site title.
add_filter( 'option_blogname', static function () { return 'WonderWish'; } );
$directory = ABSPATH . 'private-email-previews/';
wp_mkdir_p( $directory );
file_put_contents( $directory . '.gitignore', "*\n!.gitignore\n" );
$mailer = WC()->mailer();
$emails = $mailer->get_emails();
$order = new WC_Order(); // Unsaved, synthetic preview; never inserted in catalogue/orders.
$order->set_billing_first_name( 'Preview' );
$order->set_billing_last_name( 'Customer' );
$order->set_billing_email( 'preview@example.invalid' );
$order->set_currency( 'LYD' );
$order->set_payment_method( 'cod' );
$order->set_payment_method_title( 'Cash on delivery' );
$order->set_status( 'processing' );
$order->set_date_created( time() );
$products = wc_get_products( array( 'limit' => 1, 'status' => 'publish' ) );
if ( $products ) {
 $item = new WC_Order_Item_Product();
 $item->set_product( $products[0] );
 $item->set_quantity( 1 );
 $item->set_subtotal( (float) $products[0]->get_price() );
 $item->set_total( (float) $products[0]->get_price() );
 $order->add_item( $item );
 $order->set_total( (float) $products[0]->get_price() );
}
$report = array();
foreach ( array( 'WC_Email_Customer_Processing_Order', 'WC_Email_Customer_Completed_Order', 'WC_Email_Customer_Invoice', 'WC_Email_Customer_Note', 'WC_Email_New_Order', 'WC_Email_Customer_Reset_Password', 'WC_Email_Customer_New_Account' ) as $class ) {
 $email = $emails[$class] ?? null;
 if ( ! $email ) continue;
 $email->email_type = 'html';
 if ( 'WC_Email_Customer_Reset_Password' === $class ) {
  $email->user_id = 0; $email->user_login = 'preview-customer'; $email->user_display_name = 'Preview'; $email->reset_key = 'design-preview-not-a-valid-key';
 } elseif ( 'WC_Email_Customer_New_Account' === $class ) {
  $email->user_id = 0; $email->user_login = 'preview-customer'; $email->user_email = 'preview@example.invalid'; $email->user_pass = ''; $email->password_generated = false; $email->set_password_url = '';
 } else {
  $email->object = $order;
  if ( 'WC_Email_Customer_Note' === $class ) $email->customer_note = 'Design preview only. No order has been created.';
 }
 $html = $email->style_inline( $email->get_content_html() );
 file_put_contents( $directory . $email->id . '.html', $html );
 $report[$email->id] = array( 'bytes' => strlen( $html ), 'blue_brand' => str_contains( $html, '#205e9c' ), 'native_wrapper' => str_contains( $html, 'template_container' ) );
}
$url = add_query_arg( array( 'alg_wc_ev_verify_email' => 'design-preview-invalid', 'uid' => 0 ), wc_get_page_permalink( 'myaccount' ) );
$content = '<p>Hello Preview,</p><p>Please confirm your email address to finish setting up your account.</p><p><a class="button" href="' . esc_url( $url ) . '">Verify email address</a></p><p>This is a design preview; this link cannot activate an account.</p>';
$verification = apply_filters( 'alg_wc_ev_send_mail_message', $content );
file_put_contents( $directory . 'verification.html', $verification );
$report['verification'] = array( 'wrapped' => str_contains( $verification, 'template_container' ), 'link_retained' => str_contains( html_entity_decode( $verification ), $url ) );
$core = apply_filters( 'retrieve_password_notification_email', array( 'to' => 'preview@example.invalid', 'subject' => 'Preview', 'message' => "Reset preview:\n" . home_url( '/wp-login.php?action=rp&key=design-preview-invalid&login=preview-customer' ), 'headers' => array() ) );
file_put_contents( $directory . 'wordpress-reset.html', $core['message'] );
$report['wordpress_reset'] = array( 'html_header' => in_array( 'Content-Type: text/html; charset=UTF-8', $core['headers'], true ), 'key_retained' => str_contains( $core['message'], 'design-preview-invalid' ) );
// Assemble MIME locally; never connect to SMTP or send a message.
require_once ABSPATH . WPINC . '/PHPMailer/Exception.php';
require_once ABSPATH . WPINC . '/PHPMailer/PHPMailer.php';
$mime = new \PHPMailer\PHPMailer\PHPMailer( true );
$mime->setFrom( 'preview@example.invalid', 'WonderWish' );
$mime->addAddress( 'preview@example.invalid' );
$mime->Subject = 'Offline logo check';
$mime->isHTML( true );
$mime->Body = $verification;
wonderwish_embed_email_logo( $mime );
$mime->preSend();
$assembled = $mime->getSentMIMEMessage();
$report['embedded_logo'] = str_contains( $mime->Body, 'cid:wonderwish-email-logo' ) && str_contains( $assembled, 'Content-ID: <wonderwish-email-logo>' ) && str_contains( $assembled, 'image/png' );
$unrelated = new \PHPMailer\PHPMailer\PHPMailer();
$unrelated->Body = 'Unrelated email';
wonderwish_embed_email_logo( $unrelated );
$report['unrelated_email_unchanged'] = 'Unrelated email' === $unrelated->Body && ! $unrelated->getAttachments();
$report['legacy_sender_normalized'] = 'WonderWish' === apply_filters( 'woocommerce_email_from_name', 'toys store' );
$again = apply_filters( 'alg_wc_ev_send_mail_message', $verification );
$report['no_nested_wrapper'] = 1 === substr_count( $again, 'id="template_container"' );
$original = array( 'to' => 'preview@example.invalid', 'subject' => 'Unchanged subject', 'message' => 'Preview account update', 'headers' => array( 'Reply-To: preview@example.invalid' ), 'attachments' => array() );
$styled = wonderwish_style_core_account_email( $original, 'Preview account update' );
$report['mail_metadata_preserved'] = $original['to'] === $styled['to'] && $original['subject'] === $styled['subject'] && $original['attachments'] === $styled['attachments'] && in_array( 'Reply-To: preview@example.invalid', $styled['headers'], true );
echo wp_json_encode( array( 'synthetic_previews_only' => true, 'mail_sent' => false, 'objects_saved' => false, 'checks' => $report ), JSON_PRETTY_PRINT ) . "\n";
