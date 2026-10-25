#!/bin/bash
# Deploy presentation changes only; never copy Studio's database integration.
set -euo pipefail
REPO_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd -P)"
DEPLOY_ROOT="/home/dera/public_html/wonderwish"
SOURCE="$REPO_ROOT/wp-content/themes/fantasy-theme"
TARGET="$DEPLOY_ROOT/wp-content/themes/fantasy-theme"

command -v rsync >/dev/null || { echo 'Deployment requires rsync.' >&2; exit 1; }
test -f "$DEPLOY_ROOT/wp-config.php" || { echo 'Expected WonderWish WordPress installation was not found.' >&2; exit 1; }
test -f "$SOURCE/style.css" || { echo 'Theme source is missing.' >&2; exit 1; }
mkdir -p "$TARGET"
test "$(cd "$SOURCE" && pwd -P)" != "$(cd "$TARGET" && pwd -P)" || {
 echo 'Keep the cPanel Git checkout separate from the live theme directory.' >&2; exit 1;
}
# No --delete: preserve existing files. No database, plugins, uploads or config.
rsync -rlt --exclude='.git' --exclude='.DS_Store' "$SOURCE/" "$TARGET/"
echo 'WonderWish theme deployed. Clear the website cache and verify the changed pages.'
