# WooCommerce overrides

Only files that genuinely replace installed WooCommerce PHP templates belong here. Do not copy the whole plugin templates directory or templates from another site's WooCommerce version.

Audited against installed WooCommerce **11.2.1**:

| Override | Installed template version | Reason |
| --- | --- | --- |
| `myaccount/form-login.php` | 9.9.0 | WonderWish login/registration presentation; native fields, actions and nonces retained |
| `myaccount/dashboard.php` | 4.4.0 | Welcome artwork, native account shortcuts and real customer-order summary |
| `myaccount/navigation.php` | 9.3.0 | Existing account cards in place of tabs; native before/after hooks retained |
| `myaccount/lost-password-confirmation.php` | 3.9.0 | Contained reset-email confirmation card; native notice, message filter and hooks retained |

The theme-only shared card markup is `template-parts/account/cards.php`, loaded with WordPress `get_template_part()`. It is not a WooCommerce override.

## Why the other pictured folders are not copied

- `checkout/thankyou.php`, `checkout/order-received.php`: native fallback PHP remains available; the block checkout uses the theme's `templates/order-confirmation.html` with native WooCommerce confirmation blocks.
- `global/quantity-input.php`: use the installed template plus the existing before/after quantity hooks. No duplicate quantity/business logic.
- Password recovery, My Account wrapper, addresses and orders: installed native PHP plus existing scoped styles/hooks. Copy only if a concrete markup change requires it.
- `notices/error.php`, `notice.php`, `success.php`: native notice messages/ARIA behavior plus theme styles. Cart/Checkout blocks also use their native notices.
- `order/order-details.php`, `order-details-customer.php`: native authorized order data and markup, with scoped theme styling.
- `content-product.php`: native product loop and existing WooCommerce hooks/styles; the Gutenberg homepage has a separate live server-rendered WooCommerce product stream.
- `woo-city.dropdown.class.php`: not a standard WooCommerce template. Do not import another site's custom location/shipping behavior without examining its source and business requirements.

## After a WooCommerce update

From the site root run:

```sh
studio wp eval-file tools/audit-woocommerce-templates.php
```

This read-only check compares local versions, required upstream action hooks and actual override resolution, checks login nonce markers, and parses the theme PHP without executing it. Review changed upstream source even when version markers are unchanged; this check is not a substitute for behavioral QA. Never bump version comments without actually reconciling changes.

Also check WooCommerce → Status → System status → Templates, then test guest account views, registered-customer endpoints, wishlist, product quantities, cart and checkout. Submit orders only in an authorized test workflow.

## Verification for this change

All three overrides match installed versions; no missing upstream action hooks; all theme PHP parses. One five-card navigation on dashboard, Orders, Addresses, Account Details and Wishlist; native existing order detail renders. Guest login/registration nonces present; registration/recovery UI accessible. Native product quantity increments/decrements 1→2→1. Existing populated Cart and Checkout render; COD option present. Mobile dashboard has no horizontal overflow. No order submitted, no form/account details saved, no email triggered, no inventory/settings modified. Order-completion/thank-you submission was not exercised.
