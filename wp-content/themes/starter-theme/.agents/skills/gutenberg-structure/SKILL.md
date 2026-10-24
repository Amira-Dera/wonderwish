---

name: gutenberg-structure
description: Define and maintain the file organization and architecture of the WordPress Gutenberg starter theme. Use when deciding where templates, template parts, patterns, block styles, block variations, custom blocks, theme style variations, assets, scripts, and animations belong, or when adding or reorganizing theme files.
-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

# Gutenberg Structure

Maintain a clear, scalable WordPress block theme architecture. Place every component, style, asset, and behavior according to its purpose and ownership while preserving native Gutenberg editing, the theme design system, and WordPress conventions.

This skill documents the starter theme's architecture and organizational rules. It complements implementation skills such as `figma-to-gutenberg`; it does not replace their design-to-code workflow.

## Establish the contract

1. Read `AGENTS.md`, `PROJECT.md`, `README.md`, and the current theme files before changing the architecture.
2. Inspect `theme.json`, `functions.php`, `inc/`, `templates/`, `parts/`, `patterns/`, `styles/`, `assets/`, `src/`, and `build/` where present.
3. Identify the WordPress version, theme type, block registration approach, build tooling, asset-loading mechanisms, and existing naming conventions.
4. Treat the actual repository as the source of truth. Verify registrations and build configuration before assuming a file is automatically discovered or loaded.
5. Preserve existing conventions unless a documented architectural problem justifies changing them.

## Understand file ownership

* Put site-wide design tokens, settings, and global styles in `theme.json`.
* Put block templates in `templates/` and shared header or footer template parts in `parts/`.
* Put reusable Gutenberg block compositions in `patterns/`. Keep patterns focused on content structure rather than duplicating shared functionality.
* Put PHP theme setup and registration logic in the appropriate existing files under `inc/`, with `functions.php` loading those modules.
* Put reusable theme assets in `assets/`, organized by asset type and responsibility.
* Put custom block source code in `src/blocks/<block-name>/` when the repository uses this custom-block architecture.
* Treat `build/` as generated output when the build configuration confirms it. Edit source files rather than generated files unless the project explicitly requires otherwise.
* Keep project documentation and development instructions in their designated documentation files.

## Distinguish Gutenberg variations

Do not treat every variation as the same WordPress feature.

### Block style variations

* Use `styles/blocks/` for the project's organized collection of JSON-based block style presets.
* Keep each preset in a clearly named file and identify its target block types explicitly when supported by the chosen format.
* Use block style variations when an editor should be able to select an alternative visual treatment for a block.
* Verify the expected schema, WordPress version, file format, and registration mechanism before implementation.

### Block variations

* Treat block variations as alternative configurations of a registered core or custom block.
* Use the supported Block Variation API or block metadata mechanism appropriate to the project's WordPress version.
* Keep variation registration with the relevant block implementation or registration module.
* Do not assume a block variation is equivalent to a JSON style preset.

### Custom blocks

* Keep custom block implementation files together under `src/blocks/<block-name>/`.
* Use `block.json` for supported block metadata and asset registration.
* Organize editor components, saved markup or server rendering, styles, scripts, and deprecated implementations according to the block's actual requirements.
* Add migrations or deprecations when changes to saved markup require backward compatibility.
* Do not create a custom block when native Gutenberg blocks, patterns, or supported variations adequately satisfy the requirement.

### Theme style variations

* Distinguish theme-wide style variations from variations belonging to an individual block.
* Organize theme-wide style variations according to the active WordPress conventions and the theme's existing configuration.
* Keep global visual-system changes separate from individual block presets.

## Organize styles and assets

* Use `styles/blocks/` for block style presets, `styles/colors/` for color presets, `styles/typography/` for typography presets, `styles/sections/` for section-level presets, and `styles/global/` for global style presets when these categories are supported by the project's registration and loading implementation.
* Use `theme.json` for supported theme settings, design tokens, global styles, and block-level defaults.
* Keep reusable CSS separate from PHP, JavaScript, and JSON configuration.
* Prefer theme design tokens and WordPress presets over duplicated hardcoded values.
* Avoid creating duplicate stylesheets or competing implementations of the same visual treatment.
* Do not assume that arbitrary nested JSON files are automatically discovered or registered by WordPress. Verify the implementation before relying on directory conventions.

## Organize animations

Choose the animation's location according to what owns the effect and whether it requires JavaScript.

### Shared theme animations

* Keep reusable animation CSS in `assets/css/animations/`.
* Keep reusable animation controllers in `assets/js/animations/` when JavaScript is necessary.
* Examples include shared reveal effects, hover treatments, and reusable transitions.
* Register and enqueue these assets through the theme's established loading mechanism.
* Load assets only where needed; prefer CSS when it can provide the required behavior.

### Pattern and section animations

* Keep the section composition in `patterns/`.
* Apply effects through supported block styles, descriptive wrapper classes, and shared animation assets.
* Keep reusable animation behavior outside the pattern unless the project's architecture explicitly assigns ownership differently.
* Do not create a custom block solely to animate an otherwise suitable native block composition.

### Custom block animations

* Keep block-specific animation styles and scripts within `src/blocks/<block-name>/` when the behavior belongs exclusively to that block.
* Use `block.json` and the existing build pipeline to register and compile the appropriate assets.
* Prefer frontend-only assets for frontend-only behavior when supported.
* Keep shared effects in the theme's animation system rather than duplicating them across multiple custom blocks.

### Animation implementation requirements

* Prefer CSS transitions and animations for visual effects.
* Use JavaScript only when the interaction requires it, such as triggering an animation when an element enters the viewport.
* Respect `prefers-reduced-motion`.
* Ensure content remains accessible if JavaScript fails or is unavailable.
* Preserve keyboard access, visible focus, and usable touch interactions.
* Test animation behavior in both the editor and frontend where applicable.

## Follow the architecture decision

Before adding a file, answer these questions:

1. Is this a template, template part, pattern, style preset, block variation, custom block, or shared asset?
2. Which component or system owns the functionality?
3. Can native Gutenberg functionality satisfy the requirement?
4. Does the proposed location match the repository's actual registration and build mechanisms?
5. Can an existing component, stylesheet, script, or preset be reused?
6. Does the change introduce duplication, unnecessary global loading, or a maintenance burden?

Choose the simplest architecture that satisfies the requirement. Do not introduce new directories, custom blocks, dependencies, or registration mechanisms without a clear reason.

## Verify and maintain

1. Validate JSON, PHP, JavaScript, and block metadata affected by the change.
2. Confirm that new files are registered, loaded, or discovered through the actual theme implementation.
3. Test relevant blocks in the Gutenberg editor and on the frontend.
4. Confirm that block styles and variations appear as intended and do not interfere with unrelated blocks.
5. Check responsive layouts, accessibility, reduced-motion behavior, browser console errors, and missing assets where applicable.
6. Confirm that generated assets are current and that source files remain the maintainable implementation.
7. Update `AGENTS.md`, `PROJECT.md`, or other architecture documentation when a lasting project rule changes.

When documenting a new architectural convention, distinguish WordPress requirements from repository-specific decisions. Verify official documentation and version compatibility before introducing or changing implementation rules.

