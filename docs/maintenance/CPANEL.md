# cPanel deployment

`.cpanel.yml` deploys the WonderWish child theme to
`/home/dera/public_html/wonderwish/wp-content/themes/fantasy-theme/`.
It intentionally does not deploy the entire repository: plugins, uploads,
WordPress configuration, database files and the Studio SQLite integration are
not part of routine theme updates. No existing files are deleted.

Keep the Git checkout in a separate folder, such as a cPanel repositories
directory, rather than using the live WordPress directory as the checkout.

In cPanel → Git Version Control → Manage → Pull or Deploy:

1. Select branch `main`, then Update from Remote.
2. Click Deploy HEAD Commit.
3. Clear website caches and verify account/reset-password and checkout notices.

If cPanel reports uncommitted changes, use its Terminal in the **repository
checkout** to inspect `git status --short` and `git diff`. Preserve any intentional
hosting changes before resolving them. Do not blindly reset or clean the working
tree, and do not commit database/configuration secrets. If SQLite files were
renamed in the checkout, keep that hosting adjustment in the separate live site;
the deployment script does not copy those files.

Do not reimport the database for CSS/theme updates. User accounts, orders,
products, settings and saved Gutenberg content remain in the live database.

Validation: shell syntax checked locally. Deployment on the hosting server still
requires executing Deploy HEAD Commit; the local machine cannot verify the
server's working-tree state or permissions. Deployment uses standard shell,
find and copy commands; rsync is not required.

## Diagnose a successful deployment with an unchanged website

The deployment log prints source and destination folders,
compares the account/notice files byte-for-byte, and writes the deployed
commit to `wp-content/themes/fantasy-theme/deployment-version.txt`.
Open that file under the website URL to confirm the web server serves the same
folder that deployment updated. If it is missing or old, check cPanel Domains →
Document Root and the deployment log paths. If it is current but PHP output is
old, purge page/server caching and ask hosting to reset PHP OPcache if needed.
Never publish configuration files or credentials as diagnostics.
