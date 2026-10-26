# WonderWish transactional email design

Implementation: `fantasy-theme/inc/emails.php` and `assets/css/emails.css`.
Native WooCommerce templates and its CSS inliner remain in charge. No email
template copies, plugin modifications, SMTP changes or mail sends were needed.

Shared HTML styling covers WooCommerce order/admin notices, invoices/order
details, processing/completed/refund/fulfillment messages, customer notes,
new accounts and password resets that use the native wrapper. Existing email
subjects, enabled states, recipients and content/settings remain native.
A dashboard-selected email logo and custom footer remain honored; the theme
logo fills an empty logo setting. Solid colors are fallbacks for gradients.
CSS is inlined; no animation, JavaScript, external fonts or SVG email assets.
Plain-text WooCommerce email formats remain plain.

Core WordPress customer reset/new-account/account-change email filters apply the
same wrapper and HTML content type while preserving the original message,
recipient, subject, reply-to and attachments. Already wrapped WooCommerce HTML
is not nested. Third-party full HTML documents are left alone rather than
wrapped twice or destructively rewritten.

Verification: uses WPFactory's public `alg_wc_ev_send_mail_message` filter.
Activation URLs are preserved; only their existing link gets a button class.
Source inspected from the public WordPress.org latest-stable plugin archive
on 26 October 2026 (inspection only, not installed locally). The live plugin
was previously identified in its dashboard but is absent from this local site.
Delivery/trigger/security settings and proprietary template options are not
changed. Custom full-HTML verification templates are left intact.
Reference: https://wpfactory.com/docs/configure-email-settings/

Validation:
- `studio wp eval-file tools/preview-emails.php` renders seven native email
  variants plus a verification-hook fixture and a core WordPress reset fixture.
  Uses an unsaved synthetic order and invalid preview-only reset/verification
  links. No users/orders saved and no email triggers/send functions called.
- Preview HTML goes in local-only `private-email-previews/`, excluded from its
  own Git folder and not part of cPanel theme deployment. No real customer data.
- Invoice, reset, verification and core reset checked at 390px without horizontal
  overflow; desktop invoice/reset screenshots saved locally.
- Verification URL, reset key, mail metadata and single-wrapper assertions pass.
- Theme PHP and WooCommerce override audit pass.

After deployment: inspect WooCommerce → Settings → Emails previews. Send a real
verification/reset/invoice test only to an inbox you control. Actual Gmail,
Outlook, dark-mode rendering, SMTP delivery and the installed live verification
plugin version/hook execution are not verified by the browser-only previews.
Remote images may be blocked by the recipient; native alt text remains.
No PDF invoice plugin was available to inspect: this styles WooCommerce's invoice
email, not an independently generated PDF attachment. Other plugins' mailers
(e.g. form notifications) need their own integration if they bypass these hooks.

## Email logo and sender follow-up

- Reused the owner-supplied `WonderWish Magical Star Logo.png` unchanged as `assets/images/brand/wonderwish-email-logo.png`. Its opaque blue background keeps the white lettering readable when surrounding email colors change. Owner-supplied branding; no third-party source added.
- Native WooCommerce logo selection maps the existing theme logo to this email-specific PNG; unrelated custom selections remain intact. PHPMailer embeds this local file with a CID for delivery rather than requiring Gmail to retrieve a remote image. No remote fetches or recipient/address changes.
- Corrected both WooCommerce sender name and WP Mail SMTP's forced From Name to WonderWish in the live dashboard. SMTP had been forcing the legacy toys store label. Address, authentication and connection settings were preserved.
- Local synthetic previews and offline MIME assembly passed, including inline PNG Content-ID, unchanged unrelated emails and preserved reset/verification links. Desktop and 390px layouts checked without horizontal overflow. No emails sent. Gmail/Outlook delivery and actual dark-mode rendering still need a newly received message after deployment; old received emails do not update.

## Centered banner logo revision

The native email-header.php (template version 10.7.0) now has a child-theme override placing the existing transparent white WonderWish PNG horizontally centered inside the blue gradient banner above the native email heading. The external logo area is removed. This shared header covers WooCommerce emails and wrapped account/verification messages. CID embedding now targets the white PNG. Native body, headings, links and data remain unchanged. Preview/MIME checks pass; dark-mode client rendering still requires a received-message check.
