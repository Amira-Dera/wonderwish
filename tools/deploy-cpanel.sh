#!/bin/bash
# Deploy presentation changes only; never copy Studio's database integration.
set -euo pipefail
REPO_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd -P)"
DEPLOY_ROOT="/home/dera/public_html/wonderwish"
SOURCE="$REPO_ROOT/wp-content/themes/fantasy-theme"
TARGET="$DEPLOY_ROOT/wp-content/themes/fantasy-theme"

test -f "$DEPLOY_ROOT/wp-config.php" || { echo 'Expected WonderWish WordPress installation was not found.' >&2; exit 1; }
test -f "$SOURCE/style.css" || { echo 'Theme source is missing.' >&2; exit 1; }
mkdir -p "$TARGET"
test "$(cd "$SOURCE" && pwd -P)" != "$(cd "$TARGET" && pwd -P)" || {
 echo 'Keep the cPanel Git checkout separate from the live theme directory.' >&2; exit 1;
}
# Preserve existing files. No database, plugins, uploads or config.
echo "Source theme: $SOURCE"
echo "Live theme target: $TARGET"
# Minimal shared hosting may not provide rsync. Copy each theme file directly,
# independent of size/timestamps, excluding nested Git and desktop metadata.
while IFS= read -r -d '' FILE; do
 RELATIVE="${FILE#"$SOURCE/"}"
 mkdir -p "$(dirname "$TARGET/$RELATIVE")"
 cp -f "$FILE" "$TARGET/$RELATIVE"
done < <(find "$SOURCE" -type d -name .git -prune -o -type f ! -name .DS_Store -print0)
for FILE in assets/css/account.css assets/css/notices.css inc/site-consistency.php woocommerce/myaccount/form-login.php; do
 cmp "$SOURCE/$FILE" "$TARGET/$FILE" || { echo "Verification failed: $FILE" >&2; exit 1; }
done
COMMIT="$(git -C "$REPO_ROOT" rev-parse HEAD)"
printf '%s\n' "$COMMIT" > "$TARGET/deployment-version.txt"
echo "Verified deployed commit: $COMMIT"
echo 'WonderWish theme files verified. Clear hosting/PHP caches and verify the changed pages.'
