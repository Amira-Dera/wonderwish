# Contact Us

- Editable native Gutenberg page at `/contact-us/`, local page ID 83. Content is seeded from `patterns/contact-us.php` by explicit `tools/setup-contact-page.php` CLI setup; existing contact pages are preserved without overwriting edits.
- Public address `info@wonderwish.ly` provided by the owner. Email CTA uses mailto (opens visitor's mail application); no fake form or submission confirmation, no messages sent during testing.
- Uses existing page template, gradient introduction, site navigation, glitter and footer. Existing footer automatically discovers the published contact page and adds its Contact link.
- Scoped contact.css supplies responsive two-column layout, original envelope SVG, native details questions, visible keyboard focus and rounded native buttons. No new plugins or motion added.
- Checked registered Gutenberg blocks, desktop and 390px layout (no horizontal overflow), public email hrefs, footer link and FAQ expansion. No homepage edits.

## Hosting setup after theme deployment

From `/home/dera/repositories/wonderwish`, run:

```bash
wp --path=/home/dera/public_html/wonderwish eval-file tools/setup-contact-page.php
```

This creates the actual WordPress page once; Git theme deployment alone does not import database pages. Future manual edits are preserved. Edit in Pages → Contact Us.

## Alice banner artwork

New character asset: Alice, sourced from https://www.realclipart.com/middle/m2i8H7d3G6i8H7G6_alice-in-wonderland-character-alice/ . Original linked PNG: https://www.realclipart.com/png/full/58-582426_king-queen-clipart.png . Downloaded original without editing; checked true alpha transparency. Displays with object-fit contain so full silhouette stays visible. The page lists Personal Use: this is design-preview artwork and is NOT commercially cleared. Obtain permission or replace before commercial launch. A generated illustration was attempted but unavailable; no generated output was used.

## Simplified contact details and real form revision

Reference inspected: https://lncstore.ly/contact/ (name, email, message alongside store contact details). Removed the old FAQ and extra navigation buttons. Owner-provided info@wonderwish.ly is the only public contact detail; no phone, opening hours or address invented.

The page remains a normal editable WordPress Page. Details are native Gutenberg blocks; the real form is the registered `wonderwish/contact-form` server-rendered block with a matching editor preview. No new plugins. Submissions use native wp_mail and the existing hosting SMTP connection, with visitor email only in sanitized Reply-To; no From-address change. Message contents are not saved to the database. A nonce, honeypot, validation/length checks and hashed-IP rate limit protect submissions. Error responses preserve entered values; only wp_mail acceptance produces the success message (not a delivery guarantee).

The old generated layout is upgraded once when an authorized editor visits wp-admin after deployment. The updater checks for the old `ww-contact-questions` marker on contact/contact-us, saves a revision, and changes only that page's content. It does not overwrite the new layout or other pages. If the old marker was manually removed, update the page through its editor instead of forcing a replacement. No terminal or reinserting a pattern is required for the existing generated page.

Validation: offline mail stub covered valid submission, sender recipient/Reply-To, invalid nonce/email, missing/oversized message, array input, honeypot, rate limit, and mail failure with preserved fields. No actual email was sent. Browser checked required-field focus, labels, form action, desktop and 390px layout without horizontal overflow, and retained Alice banner. Actual SMTP inbox delivery must be confirmed after live deployment. If an external cache already holds the old page, clear that cache; runtime contact requests are marked non-cacheable.
