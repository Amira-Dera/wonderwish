# Project Context

## WordPress

- Site URL: `http://localhost:8887`
- WordPress version: 7.1.2
- Active theme: starter-theme (activated for this draft)
- Active plugins: Advanced Custom Fields 6.8.10; SQLite database integration is a must-use plugin
- Front-page setting: latest posts
- Target page title and ID: .LY Success Stories, page ID 7
- Draft, staging, or production: local draft; publishing not authorized
- Existing content backup: no page was replaced; Sample Page (ID 2) and Privacy Policy (ID 3) were left unchanged

## Design

- Figma frame: https://www.figma.com/design/wn6sB8vrYJPFx0yzv8sgMX/Register.ly-Test-Trial?node-id=7-2
- Desktop frame: 1461 × 3160 px; main content measures approximately 1084 px wide
- Tablet target: 768 px, inferred from the desktop layout
- Mobile target: 375 px with a 320 px minimum, inferred from the desktop layout
- Font: the Figma guest view did not expose inspect metadata; Plus Jakarta Sans is a visual approximation, packaged locally as a variable WOFF2 under the OFL license, with Arial fallback
- Assets: the target frame uses typographic marks and CSS shapes; no exportable design assets were exposed to the guest view
- Interactions: links and buttons; no custom interactive component was visible

## Content and acceptance

- Copy: transcribed from the visible Figma frame into editable core blocks
- Link destinations: Figma guest view did not reveal destinations; `#` is used where unverified, and `#stories` for the internal hero link
- Media Library: empty
- SEO plugin: none
- Locale and audience: English; audience not specified
- Accessibility target: WCAG 2.2 AA
- Publishing authorized: no

## Installation

The draft is available at `http://localhost:8887/wp-admin/post.php?post=7&action=edit` and previews at `http://localhost:8887/?page_id=7&preview=true`. The editable composition remains reusable as `patterns/success-stories.php`, with its saved block markup in `page-content/success-stories.html`. Replace placeholder `#` URLs before publishing.

## Why Choose .LY (first two sections)

- New page: ID 31, status `draft`, template `page-why-choose-ly`.
- Figma hero: node `77-6`, 1461 × 689.5 px. Benefits section: node `77-19`, 1461 × 1066.88 px. Badge treatment: Register.ly Test Trial node `1-2027`.
- Editable source: `page-content/why-choose-ly.html`; reusable pattern: `patterns/why-choose-ly.php`.
- Shared header and footer remain template parts. The header overlays this page's CSS radial-gradient hero.
- Tablet target 768 px and mobile target 320–375 px are inferred because responsive Figma frames were not supplied.
- The Figma frames do not specify button destinations. Their draft URLs are `#` pending real destinations.

## Why Choose .LY (features and FAQ)

- Figma feature frame: node `77-170`, 1461 × 833 px. FAQ frame: node `77-258`, 1461 × 710 px.
- Page 31 remains a draft. A backup of its prior saved block markup is at `page-content/backups/why-choose-ly-before-features-faq.html`.
- Feature content uses editable core Group, Heading, Paragraph, Image, and Button blocks. The seven decorative SVG icons are local files in `assets/images/why-*.svg`; the feature and FAQ background glows are CSS radial gradients.
- FAQ questions are `ly_faq` posts in the dashboard. Their answers and display order are ACF fields registered in `inc/why-faq.php`; the dynamic `starter-theme/ly-faq-list` block renders published entries on the page. Edit at `http://localhost:8887/wp-admin/edit.php?post_type=ly_faq`.
- Figma supplied collapsed questions only. Initial answer text was written from NIC.LY help and Register.ly domain guidance; review editorial wording before publishing. The feature CTA and FAQ support link remain `#` placeholders because the Figma frames supplied no destinations.

## Why Choose .LY (final domain hack call to action)

- Figma node `77-327`: 1461 × 472 px panel with a 1152 × 408 px dark card, 24 px radius, 40 px horizontal and 56 px vertical inner padding.
- Added after the FAQ with editable core heading, paragraph, Button, and example/status text blocks. The examples are illustrative content, not live availability search results.
- Backup before this addition: `page-content/backups/why-choose-ly-before-domain-hack-cta.html`. The existing draft page ID 31 and prior sections were preserved.
- The generator destination is unspecified in Figma; its Button URL remains `#` until the real URL is supplied.

## Why Choose .LY motion and interaction refinement

- Page 31 was already `publish` when this refinement began; its status was preserved. Backup: `page-content/backups/why-choose-ly-before-motion-refinement.html`.
- The hero gradient now uses the layered green and blue radial values inspected on `https://register.ly/why-choose-ly/`; blue source colors are theme presets.
- The word card types through its editable domain example badges on the frontend. The editor retains its stable `exact.ly` heading. Motion starts near the viewport and pauses on hover, focus, or reduced-motion preference.
- The world card has a decorative local SVG planet with two CSS orbiting dots; its copy and link remain core blocks. Orbit motion starts near the viewport and pauses on hover/focus or reduced-motion preference.
- The dynamic FAQ block renders two independent columns so opening a question only moves later questions in that column. On mobile, the columns stack in their document reading order.
- Benefits, feature cards, and FAQ cards now have hover feedback matched to the live reference.

## Supplied planet SVG

- Replaced `assets/images/why-orbit-planet.svg` byte-for-byte with the user's 220 × 200 Figma SVG. The world card's core Image block still points to this asset, so its Gutenberg markup did not need a migration.
- Updated the two decorative moving dots to rotate around the supplied globe's center and radius. The original SVG paths, colors, network nodes, and gradients remain intact; motion still pauses outside the viewport, on hover/focus, and for reduced motion.
