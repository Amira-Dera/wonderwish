# Current project organization

## Theme folders

| Location | Purpose |
| --- | --- |
| `theme.json`, `style.css`, `functions.php` | Child-theme configuration and hook registration |
| `templates/` | Gutenberg page/archive/product wrappers; `front-page.html` renders the saved Home page |
| `parts/` | Shared Gutenberg header and footer references |
| `patterns/` | Reusable starting layouts; inserting one creates editable page blocks |
| `inc/` | Scoped native WooCommerce integration and the live product-stream block |
| `template-parts/account/cards.php` | Theme-only shared account cards |
| `woocommerce/myaccount/` | Three actual WooCommerce template overrides |
| `assets/css/`, `assets/js/` | Presentation and progressive interactions |
| `assets/images/` | Current local character, world-logo and brand assets, grouped by use |

The white header logo and inverse-blue footer logo are both required. Animated and still character images are both required. Account/category character filenames are sometimes constructed dynamically; a literal search alone cannot determine whether an asset is unused.

The favicon's active copy is a native Media Library attachment in uploads. Product photographs and WordPress-generated image sizes also belong to Media Library; do not clean these by deleting files manually.

## Site editing

Use **Pages → Home** for homepage content, **Products** for catalogue data and **Appearance → Editor → Patterns** for the shared header/footer. Decorative SVG/form behavior is theme-managed. Do not rerun old migrations or overwrite the saved Home content with a pattern export.

## Project-root tools and records

- `tools/audit-woocommerce-templates.php`: reusable, read-only compatibility/PHP audit.
- `docs/maintenance/completed-migrations/`: archived one-time migration sources as `.txt`, retained for traceability.
- `docs/maintenance/asset-cleanup-2026-10-24.json`: removed file list, sizes and hashes.
- `docs/maintenance/rendered-asset-audit.json`: checked live routes and asset references.
- Other `docs/` subfolders retain earlier visual QA and source/license records. The theme README preserves chronological artwork provenance.

Run the audit from the site root:

```sh
studio wp eval-file tools/audit-woocommerce-templates.php
```

## Cleanup performed

Removed the obsolete gift-arc SVG logo, the unused theme duplicate of the active Media Library favicon, and three former demo-product illustrations (Mickey, Po and Stitch). Removed the old fictitious-product fallback from the reusable featured-products pattern; it now uses the existing live WooCommerce block, including its honest empty-catalogue message. The four treasure illustrations still used in the benefits section are retained.

Six image files removed: **834,255 bytes**. The duplicate login Toothless image now shares the identical file already used by the homepage benefits. Three Finder metadata files removed. Two completed migration scripts archived. No Media Library records/uploads, saved Home/template content, products, orders, customers or store settings were changed.

## Verification

- 13 live routes checked; all collected local content-asset references resolve to existing files, with no horizontal overflow on the inspected desktop routes.
- Both Po and Stitch dynamically loaded hover animations still load.
- Live product stream still renders eight actual product cards.
- Empty product stream tested using an in-process query-result filter; proper empty message and no fake cards. No catalogue records changed.
- Existing WooCommerce overrides remain current; all theme PHP parses successfully.

This cleanup intentionally retains assets used by saved content, inactive saved templates and reachable dynamic endpoints. Source/usage-rights records are preserved.
