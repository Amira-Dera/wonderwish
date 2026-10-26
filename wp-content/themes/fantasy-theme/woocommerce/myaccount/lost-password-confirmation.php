<?php
/**
 * WonderWish password-reset confirmation presentation.
 * Native WooCommerce message, filter and action hooks retained.
 * @version 3.9.0
 */
defined( 'ABSPATH' ) || exit;
?>
<section class="ww-reset-confirmation" aria-labelledby="ww-reset-confirmation-title">
 <div class="ww-reset-envelope" aria-hidden="true"><svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="7" y="14" width="34" height="25" rx="5"/><path d="m9 17 15 11 15-11M34 5v7m-3-3h6M13 6v4m-2-2h4"/></svg></div>
 <h1 id="ww-reset-confirmation-title"><?php esc_html_e( 'Check your inbox', 'fantasy-theme' ); ?></h1>
 <?php wc_print_notice( esc_html__( 'Password reset email has been sent.', 'woocommerce' ) ); ?>
 <?php do_action( 'woocommerce_before_lost_password_confirmation_message' ); ?>
 <p class="ww-reset-confirmation-copy"><?php echo esc_html( apply_filters( 'woocommerce_lost_password_confirmation_message', esc_html__( 'A password reset email has been sent to the email address on file for your account, but may take several minutes to show up in your inbox. Please wait at least 10 minutes before attempting another reset.', 'woocommerce' ) ) ); ?></p>
 <?php do_action( 'woocommerce_after_lost_password_confirmation_message' ); ?>
 <a class="ww-reset-signin" href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"><?php esc_html_e( 'Back to sign in', 'fantasy-theme' ); ?></a>
</section>
