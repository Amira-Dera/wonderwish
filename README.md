# WonderWish

WonderWish's custom Gutenberg child theme and read-only maintenance tools.

- Theme: `wp-content/themes/fantasy-theme`
- Parent theme: Twenty Twenty-Five
- Store functionality: WooCommerce and the existing TI WooCommerce Wishlist integration
- Editing and maintenance: [theme guide](wp-content/themes/fantasy-theme/MAINTENANCE.md)
- Destination URL and migration checklist: [migration guide](docs/maintenance/MIGRATION.md)

Install the theme in an existing compatible WordPress/WooCommerce installation
with Twenty Twenty-Five available. This repository intentionally excludes
WordPress core, credentials and the database. The tracked `wp-content` includes
the installed plugins, all themes, MU plugins, the Studio database drop-in, and
public Media Library uploads. Runtime caches, logs, temporary upgrade files,
private WooCommerce downloads and nested Git metadata are excluded.

The included `wp-content/db.php` and SQLite MU plugin belong to the local Studio
environment. When migrating to a MySQL hosting environment, use a MySQL-compatible
database export and omit the Studio SQLite drop-in/integration from deployment;
do not remove them from the working local Studio site.

The manually edited Home page, saved Site Editor templates, products, orders and
store settings are database content. Use a separate secure full-site export to
preserve them; cloning this repository alone does not reproduce the whole site.
Do not commit that export or customer information here.

Character asset sources and licensing limitations are documented in the theme
README. Repository inclusion does not establish commercial-use permission.

Local audit commands (from the Studio site root):

```sh
studio wp eval-file tools/audit-woocommerce-templates.php
studio wp eval-file tools/audit-migration-urls.php
```
