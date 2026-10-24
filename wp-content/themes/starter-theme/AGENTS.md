## Pre-Build Inspection

* **Identify Environment:** Check the WP version, active theme, plugins, and target page ID.
* **Audit Existing Tools:** Review `theme.json`, patterns, templates, and registered custom blocks/styles before building.
* **Backup:** Save a copy of the current page's block markup before replacing it.
* **Design Prep:** Establish desktop, tablet, and mobile target widths based on design references.

## Block Implementation Hierarchy

Choose the simplest architecture that accurately represents the design and remains easy to edit:

* **Core Blocks:** Use native blocks, or their existing styles and variations.
* **Patterns:** Compose core blocks into synced or unsynced patterns for reusable layouts.
* **New Styles/Variations:** Register a new block style (visual changes only) or variation (default attribute/nested template changes) for core blocks.
* **Custom Blocks:** Build parent/child custom blocks only when core blocks cannot support the required behavior or content model.
* **Dynamic Blocks (PHP):** Use for server-side data or protected functional markup.

> **Note:** Use ACF strictly for structured fields, relationships, or complex repeaters. Standard headings, text, and images belong in native blocks or InnerBlocks.

## Content & Page Structure

* **Store Content Natively:** Keep page content in Gutenberg block markup—never hardcode marketing copy in PHP templates or CSS.
* **Outline in List View:** Assign descriptive names (e.g., Hero, FAQ) to major Group blocks via `metadata.name`.
* **Use Semantic HTML:** Maintain a logical heading hierarchy with a single `h1`. Use native Button blocks for CTAs; never use generic divs as buttons.
* **Nesting:** Use InnerBlocks for editable nested content within custom blocks.

## Styling & theme.json

* **Centralize the Design System:** Define colors, typography, spacing, layout widths, and per-block defaults in `theme.json`.
* **Use Core Variables:** Rely on generated preset variables (e.g., `var(--wp--preset--color--primary)`) in your CSS instead of hardcoding values.
* **Avoid Inline Styles:** Use block attributes and `theme.json` presets. Do not use generic Additional CSS Classes as the sole way editors apply reusable styles.

## Media Management

* **Reuse First:** Check the Media Library before uploading new assets. Download third-party URLs to the local library.
* **Block Selection:** Use Image or Cover blocks for editable media. Reserve CSS backgrounds and pseudo-elements strictly for non-editable, decorative visuals.
* **Optimization:** Prefer SVG for icons/logos and WebP/AVIF for raster artwork. Preserve intrinsic aspect ratios to prevent layout shift.
* **Accessibility:** Write concise alt text for informative images; leave it empty for purely decorative ones. Never embed `<img>` or `<svg>` inside RichText.

## Custom Blocks & Interactivity

* **Architecture:** Define blocks via `block.json` (registered in PHP and JS). Load assets only when the block is present on the page.
* **Repeatable UI:** Use a parent/child model for sliders, tabs, and accordions so items are individually editable and reorderable.
* **Accessibility:** Semantic controls need accessible names, visible focus, and keyboard support. Pause animations on hover/focus and respect `prefers-reduced-motion`.
* **Migrations:** Add deprecated definitions before altering saved markup for existing blocks.

## Responsive Design & Architecture

* **Separation of Concerns:** Templates manage the layout shell; Template Parts handle headers/footers; Patterns provide reusable sections; Pages own their unique content.
* **Intrinsic Layouts:** Utilize CSS grid, flexbox, `min()`, `max()`, and `clamp()` alongside `theme.json` widths to minimize media queries.
* **Mobile Constraints:** Prevent horizontal overflow at 320px. Ensure touch targets are large enough and do not rely exclusively on hover states.