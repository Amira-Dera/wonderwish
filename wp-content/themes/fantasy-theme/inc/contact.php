<?php
/** Native contact form: scoped presentation, validation and WordPress mail delivery. */
defined( 'ABSPATH' ) || exit;

function wonderwish_contact_submission( $data, $sender = null ) {
 foreach ( array( 'ww_name', 'ww_email', 'ww_message', 'ww_contact_nonce', 'ww_website' ) as $field ) {
  if ( isset( $data[$field] ) && ! is_string( $data[$field] ) ) return array( 'sent' => false, 'notice' => 'Please check your form and try again.', 'values' => array() );
 }
 $values = array(
  'name' => sanitize_text_field( $data['ww_name'] ?? '' ),
  'email' => sanitize_email( $data['ww_email'] ?? '' ),
  'message' => sanitize_textarea_field( $data['ww_message'] ?? '' ),
 );
 $fail = static function ( $text ) use ( $values ) { return array( 'sent' => false, 'notice' => $text, 'values' => $values ); };
 if ( ! wp_verify_nonce( sanitize_text_field( $data['ww_contact_nonce'] ?? '' ), 'wonderwish_contact' ) ) return $fail( 'Your form has expired. Refresh the page and try again.' );
 if ( ! empty( $data['ww_website'] ) ) return $fail( 'Your message could not be sent. Please email info@wonderwish.ly instead.' );
 $message_length = function_exists( 'mb_strlen' ) ? mb_strlen( $values['message'] ) : strlen( $values['message'] );
 if ( ! $values['name'] || strlen( $values['name'] ) > 160 || ! is_email( $values['email'] ) || strlen( $values['email'] ) > 254 || ! $values['message'] || $message_length > 5000 ) return $fail( 'Please enter your name, a valid email address, and a message of up to 5,000 characters.' );
 $key = 'ww_contact_' . hash_hmac( 'sha256', (string) ( $_SERVER['REMOTE_ADDR'] ?? 'unknown' ), wp_salt( 'nonce' ) );
 $attempts = (int) get_transient( $key );
 if ( $attempts >= 5 ) return $fail( 'Please wait 15 minutes before sending another message, or email info@wonderwish.ly directly.' );
 set_transient( $key, $attempts + 1, 15 * MINUTE_IN_SECONDS );
 $send = $sender ?: 'wp_mail';
 $sent = $send( 'info@wonderwish.ly', 'WonderWish — Contact enquiry', "Name: {$values['name']}\nEmail: {$values['email']}\n\n{$values['message']}", array( 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $values['email'] ) );
 return $sent ? array( 'sent' => true, 'notice' => 'Thank you. Your message has been submitted to WonderWish.', 'values' => array() ) : $fail( 'We couldn’t send your message. Please try again, or email info@wonderwish.ly directly.' );
}

add_action( 'template_redirect', function () {
 if ( ! is_page( array( 'contact', 'contact-us' ) ) ) return;
 // Avoid cached visitor nonces or cached submission responses.
 if ( ! defined( 'DONOTCACHEPAGE' ) ) define( 'DONOTCACHEPAGE', true );
 nocache_headers();
 if ( 'POST' === ( $_SERVER['REQUEST_METHOD'] ?? '' ) && isset( $_POST['ww_contact_submit'] ) ) {
  $GLOBALS['wonderwish_contact_result'] = wonderwish_contact_submission( wp_unslash( $_POST ) );
 }
} );

function wonderwish_contact_form() {
 $result = $GLOBALS['wonderwish_contact_result'] ?? null;
 $values = $result['values'] ?? array();
 ob_start(); ?>
 <form class="ww-contact-form" method="post" action="<?php echo esc_url( get_permalink() ); ?>#contact-form" id="contact-form" aria-labelledby="ww-contact-form-title">
 <h2 id="ww-contact-form-title">Send us a message</h2>
 <p class="ww-contact-form-intro">We’d love to hear from you.</p>
 <?php if ( $result ) : ?><div class="ww-contact-feedback <?php echo $result['sent'] ? 'is-success' : 'is-error'; ?>" role="<?php echo $result['sent'] ? 'status' : 'alert'; ?>" tabindex="-1"><?php echo esc_html( $result['notice'] ); ?></div><?php endif; ?>
 <p><label for="ww-contact-name">Name <span aria-hidden="true">*</span></label><input id="ww-contact-name" name="ww_name" type="text" autocomplete="name" maxlength="160" required value="<?php echo esc_attr( $values['name'] ?? '' ); ?>"></p>
 <p><label for="ww-contact-email">Email <span aria-hidden="true">*</span></label><input id="ww-contact-email" name="ww_email" type="email" autocomplete="email" maxlength="254" required value="<?php echo esc_attr( $values['email'] ?? '' ); ?>"></p>
 <p><label for="ww-contact-message">Message <span aria-hidden="true">*</span></label><textarea id="ww-contact-message" name="ww_message" rows="6" maxlength="5000" required><?php echo esc_textarea( $values['message'] ?? '' ); ?></textarea></p>
 <div class="ww-contact-honeypot" aria-hidden="true"><label for="ww-contact-website">Leave this field empty</label><input id="ww-contact-website" type="text" name="ww_website" tabindex="-1" autocomplete="off"></div>
 <?php wp_nonce_field( 'wonderwish_contact', 'ww_contact_nonce', false ); ?>
 <p class="ww-contact-privacy">Your details are used to reply to your enquiry. Please don’t include passwords or payment details.<?php if ( get_privacy_policy_url() ) : ?> <a href="<?php echo esc_url( get_privacy_policy_url() ); ?>">Privacy policy</a><?php endif; ?></p>
 <button type="submit" name="ww_contact_submit" value="1">Send message <svg aria-hidden="true" width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="m5 12 14 0m-5-5 5 5-5 5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
 </form>
 <?php return ob_get_clean();
}
add_action( 'init', function () {
 wp_register_script( 'wonderwish-contact-editor', get_stylesheet_directory_uri() . '/assets/js/contact-editor.js', array( 'wp-blocks', 'wp-element', 'wp-server-side-render' ), filemtime( __DIR__ . '/../assets/js/contact-editor.js' ), true );
 register_block_type( 'wonderwish/contact-form', array( 'api_version' => 3, 'editor_script' => 'wonderwish-contact-editor', 'render_callback' => 'wonderwish_contact_form' ) );
} );

/** Upgrade only the old generated Contact layout; keep a normal editable page. */
function wonderwish_upgrade_contact_page() {
 $page = get_page_by_path( 'contact-us' ) ?: get_page_by_path( 'contact' );
 if ( ! $page || ! current_user_can( 'edit_post', $page->ID ) || ! str_contains( $page->post_content, 'ww-contact-questions' ) ) return;
 wp_save_post_revision( $page->ID );
 ob_start(); include __DIR__ . '/../patterns/contact-us.php'; $content = ob_get_clean();
 wp_update_post( array( 'ID' => $page->ID, 'post_content' => $content ) );
}
add_action( 'admin_init', 'wonderwish_upgrade_contact_page' );
