# Native notice styling

Changes: shared `assets/css/notices.css` enqueued by `inc/site-consistency.php`.
No plugin files, templates, database settings or validation logic changed.
Supports classic WooCommerce error/info/success notices, Blocks banners,
warning/success/error variants, checkout inline field errors and password
recovery/reset fields. Native alert/status semantics, message text, IDs, links,
focus behavior and dismissal controls remain intact.

Local checks:
- Nonexistent username login: native error displayed with new styling.
- Nonexistent username password recovery: native error displayed; no real
  account used and no reset email requested for a real customer.
- Empty recovery field: native required-field validation retained.
- Checkout invalid email: aria-invalid=true; native inline error visible,
  computed text color #813348. No order submitted.
- No horizontal overflow on tested narrow account/recovery and checkout views;
  password recovery also checked at 1366px width.
- Test guest cart returned to empty after checkout check.
- WooCommerce override audit: no outdated overrides, no missing action hooks,
  no theme PHP parse errors; login/register nonce markers preserved.

Not tested: a successful real password reset, email delivery, actual customer
registration, order placement or live-host rendering. Clear hosted caches after
pulling. These CSS changes style frontend email validation, not email messages
sent to customers or browser-owned validation popovers.
