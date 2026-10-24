# WonderWish

WonderWish's custom Gutenberg child theme and read-only maintenance tools.

- Theme: `wp-content/themes/fantasy-theme`
- Parent theme: Twenty Twenty-Five
- Store functionality: WooCommerce and the existing TI WooCommerce Wishlist integration
- Editing and maintenance: [theme guide](wp-content/themes/fantasy-theme/MAINTENANCE.md)
- Destination URL and migration checklist: [migration guide](docs/maintenance/MIGRATION.md)

Install the theme in an existing compatible WordPress/WooCommerce installation
with Twenty Twenty-Five available. This repository intentionally excludes
WordPress core, third-party plugins, credentials, uploads and the database.

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
