<?php
/**
 * Title: WonderWish Contact Us
 * Slug: fantasy-theme/contact-us
 * Categories: text
 */
defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"className":"ww-contact-layout","layout":{"type":"default"}} -->
<div class="wp-block-group ww-contact-layout">
<!-- wp:group {"className":"ww-contact-card","layout":{"type":"default"}} -->
<div class="wp-block-group ww-contact-card">
<!-- wp:html --><div class="ww-contact-envelope" aria-hidden="true"><svg viewBox="0 0 100 80" width="100" height="80" fill="none"><rect x="12" y="23" width="76" height="49" rx="10" fill="#e6f3ff" stroke="#286eac" stroke-width="2"/><path d="m14 27 36 27 36-27M14 68l25-22m47 22L61 46" stroke="#286eac" stroke-width="2"/><path d="m50 1 4 10 11 4-11 4-4 10-4-10-11-4 11-4Z" fill="#68b8eb"/></svg></div><!-- /wp:html -->
<!-- wp:heading {"level":2} --><h2 class="wp-block-heading">A little help, a little magic.</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Have a question about a gift, an order, or delivery availability? Send us an email and tell us how we can help.</p><!-- /wp:paragraph -->
<!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="mailto:info@wonderwish.ly">Email WonderWish</a></div><!-- /wp:button --></div><!-- /wp:buttons -->
<!-- wp:paragraph {"className":"ww-contact-email"} --><p class="ww-contact-email"><a href="mailto:info@wonderwish.ly">info@wonderwish.ly</a></p><!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"ww-contact-note"} --><p class="ww-contact-note">For an existing order, include your order number and the email address used at checkout. Please don’t send passwords or payment details.</p><!-- /wp:paragraph -->
</div><!-- /wp:group -->
<!-- wp:group {"className":"ww-contact-questions","layout":{"type":"default"}} --><div class="wp-block-group ww-contact-questions">
<!-- wp:heading {"level":2} --><h2 class="wp-block-heading">Before you send your wish</h2><!-- /wp:heading -->
<!-- wp:details --><details class="wp-block-details"><summary>A question about your order?</summary><!-- wp:paragraph --><p>Sign in to My Account to view your order details. If you need help, email us with your order number.</p><!-- /wp:paragraph --></details><!-- /wp:details -->
<!-- wp:details --><details class="wp-block-details"><summary>Can you deliver to my area?</summary><!-- wp:paragraph --><p>Email us with your city and area before ordering to confirm delivery availability and any delivery charge.</p><!-- /wp:paragraph --></details><!-- /wp:details -->
<!-- wp:details --><details class="wp-block-details"><summary>Looking for a particular character or gift?</summary><!-- wp:paragraph --><p>Tell us the character or product you have in mind. You can also browse the shop by category and world to explore the current collection.</p><!-- /wp:paragraph --></details><!-- /wp:details -->
<!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} --><div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>">My Account</a></div><!-- /wp:button --><!-- wp:button {"className":"is-style-outline"} --><div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">Explore the shop</a></div><!-- /wp:button --></div><!-- /wp:buttons -->
</div><!-- /wp:group -->
</div><!-- /wp:group -->
