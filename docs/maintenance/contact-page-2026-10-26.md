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
