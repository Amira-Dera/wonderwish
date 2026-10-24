# WonderWish subdirectory migration

Destination: **https://dera.demo.ly/wonderwish** (not the domain root).

The theme uses WordPress/WooCommerce URL helpers. Keep those helpers; do not
hardcode the destination in PHP or JavaScript. Local settings remain unchanged.
Saved blocks and database settings also contain absolute local URLs, so copying
theme files alone is insufficient.

## On migration

1. Back up the destination. Install/import WonderWish in its own `/wonderwish`
   directory and its own database or dedicated table prefix. Do not overwrite the
   existing domain-root site's database or rewrite rules.
2. Export from Studio using its Export interface (full-site backup), or
   `studio export wonderwish.zip`. For a MySQL-compatible database-only export use
   `studio export wonderwish.sql --mode db`. Store exports securely outside public
   web access: they contain customer information and configuration.
3. On the **imported destination database only**, use a serialized-data-aware
   migration tool to replace the exact source `http://localhost:8889` with
   `https://dera.demo.ly/wonderwish`. Replace all WordPress-prefixed tables,
   including saved block content, metadata and options; skip the `guid` column.
   Do not perform a plain text replacement on a SQL dump, which can corrupt
   serialized settings. Do not replace `https://dera.demo.ly` globally: it could
   duplicate `/wonderwish` or alter unrelated links.
4. If using the destination hosting's WP-CLI console, run its `search-replace`
   command with these arguments, first with `--dry-run`, review the report, then
   repeat without `--dry-run`:

   ```text
   search-replace 'http://localhost:8889' 'https://dera.demo.ly/wonderwish' --all-tables-with-prefix --skip-columns=guid --report-changed-only --dry-run
   ```

   This is a destination-console command, not a command to apply to the local
   Studio site. Ensure the console targets the imported WonderWish installation.
5. In destination Settings → General, verify both WordPress Address and Site
   Address are `https://dera.demo.ly/wonderwish` (WordPress installed in that
   directory). Check configuration constants do not override these with the root
   URL, localhost, or an old content URL. Keep custom upload URL unset unless the
   hosting arrangement requires it.
6. Save Settings → Permalinks on the destination so WordPress generates rules for
   `/wonderwish/`. Configure equivalent subdirectory routing if the web server
   does not use `.htaccess`. Clear destination caches.
7. Verify Home, logo, navigation, category/world filters, character search,
   product, wishlist, cart, checkout, My Account endpoints, password recovery,
   gift-finder results, images and 404. Internal links, API requests and assets
   must stay below `/wonderwish/`. Check for mixed HTTP content and localhost
   URLs. Test guest and signed-in sessions without placing unintended orders.
8. Google OAuth remains unavailable until configured. If configured later, use
   the plugin's exact destination callback URL including `/wonderwish`; do not
   guess it or enable an untested provider.

## Local verification — 24 October 2026

- Serialized-safe replacement **dry run**: 52 occurrences across 7 tables;
  actual counts can change after edits. Nothing replaced in the local database.
- Native URLs simulated with `studio wp eval-file tools/audit-migration-urls.php`.
  Theme content-root bootstrap is simulated because the command runs inside the
  already bootstrapped local installation. This is not a remote deployment test.
- No hardcoded storefront root paths or localhost URLs found in theme output
  source. The localhost-only draft-preview guard intentionally remains local.
- Destination hosting, imported database, redirects, HTTPS and rewrite rules
  still require verification after migration. This document does not deploy.
