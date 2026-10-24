<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$ww_render_google = static function ( $context ) {
 if ( class_exists( 'NextendSocialLogin' ) && NextendSocialLogin::isProviderEnabled( 'google' ) ) {
  echo '<div class="ww-auth-google">' . do_shortcode( '[nextend_social_login provider="google" redirect="' . esc_url( wc_get_page_permalink( 'myaccount' ) ) . '"]' ) . '</div>';
 } else {
  $notice_id = 'ww-google-unavailable-' . $context;
  ?><div class="ww-auth-google"><button type="button" class="ww-google-unavailable" disabled aria-describedby="<?php echo esc_attr( $notice_id ); ?>"><span aria-hidden="true" class="ww-google-mark">G</span>Continue with Google</button><p id="<?php echo esc_attr( $notice_id ); ?>" class="ww-google-status">Google sign-in is currently unavailable. Please use email.</p></div><?php
 }
 if ( 'register' === $context ) { ?><p class="ww-auth-divider"><span><?php esc_html_e( 'or create an account with email', 'fantasy-theme' ); ?></span></p><?php }
};

do_action( 'woocommerce_before_customer_login_form' ); ?>
<section class="ww-auth-stage" aria-label="WonderWish customer sign in">
<div class="ww-world-glitter ww-auth-glitter" aria-hidden="true"><canvas class="ww-world-canvas"></canvas></div>
<div class="ww-auth-sky" aria-hidden="true"><span class="ww-auth-cloud ww-cloud-one"></span><span class="ww-auth-cloud ww-cloud-two"></span><img class="ww-auth-toothless" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/treasures/toothless.webp' ); ?>" alt="" width="362" height="640"><img class="ww-auth-light" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/account/light-fury.webp' ); ?>" alt="" width="829" height="418"><span class="ww-auth-star">✦</span><span class="ww-auth-star">✧</span><span class="ww-auth-star">✦</span></div>
<div class="ww-auth-card">
<a class="ww-auth-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">WonderWish<span aria-hidden="true">✦</span></a>
<p class="ww-auth-welcome">Your little world of wonder.</p>


<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<div class="u-columns col2-set" id="customer_login">

	<div class="u-column1 col-1" id="ww-sign-in">

<?php endif; ?>

		<h2><?php esc_html_e( 'Welcome back', 'fantasy-theme' ); ?></h2>


		<form class="woocommerce-form woocommerce-form-login login" method="post" novalidate>

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) && is_string( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required aria-required="true" /><?php // @codingStandardsIgnoreLine ?>
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span></label>
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" required aria-required="true" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
				</label>
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<button type="submit" class="woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
			</p>
			<?php $ww_render_google( 'login' ); ?>
			<p class="woocommerce-LostPassword lost_password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot password?', 'fantasy-theme' ); ?></a>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>
<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?><p class="ww-auth-switch">New to WonderWish? <a href="#ww-create-account" data-auth-view="register">Create account</a></p><?php endif; ?>
<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

	</div>

	<div class="u-column2 col-2" id="ww-create-account">

		<h2><?php esc_html_e( 'Create account', 'fantasy-theme' ); ?></h2>
<?php $ww_render_google( 'register' ); ?>

		<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required aria-required="true" /><?php // @codingStandardsIgnoreLine ?>
				</p>

			<?php endif; ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span></label>
				<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" required aria-required="true" /><?php // @codingStandardsIgnoreLine ?>
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" required aria-required="true" />
				</p>

			<?php else : ?>

				<p><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?></p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_register_form' ); ?>

			<p class="woocommerce-form-row form-row">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<button type="submit" class="woocommerce-Button woocommerce-button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
			</p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>
<p class="ww-auth-switch">Already have an account? <a href="#ww-sign-in" data-auth-view="login">Sign in</a></p>

		</form>

	</div>

</div>
<?php endif; ?>

</div></section>
<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
