# Gutenberg Theme Starter

A minimal starter repository for building editable WordPress block themes. It favors native Gutenberg blocks, patterns, styles, and variations, with custom blocks reserved for interfaces that core blocks cannot represent cleanly.

The repository intentionally contains only the theme foundation. Empty directories mark where project-specific files belong as the theme grows.

## Current Structure

```text
starter-wp-theme/
├── .agents/
│   └── skills/
│       ├── a11y-compliance-auditor/
│       ├── figma-to-gutenberg/
│       ├── responsive-interaction-engineer/
│       ├── seo-geo-optimizer/
│       └── visual-block-engineer/
├── .gitignore
├── acf-json/
├── assets/
│   ├── fonts/
│   ├── images/
│   └── js/
│       └── main.js
├── blocks/
├── parts/
│   ├── footer.html
│   └── header.html
├── patterns/
├── templates/
│   ├── index.html
│   └── page.html
├── AGENTS.md
├── functions.php
├── PROJECT.md
├── README.md
├── screenshot.png
├── style.css
└── theme.json
```

## Directory Guide

- `.agents/skills/` contains the end-to-end Figma-to-Gutenberg workflow plus focused accessibility, responsive-interface, SEO/GEO, and visual-block skills.
- `acf-json/` is available when a project genuinely benefits from ACF field groups. ACF is optional, not the default content architecture.
- `assets/` contains theme-owned fonts, images, and frontend JavaScript.
- `blocks/` contains justified custom blocks, normally registered with `block.json` and PHP.
- `parts/` contains shared block-theme template parts such as the header and footer.
- `patterns/` contains reusable Gutenberg block compositions.
- `templates/` contains block-theme templates that define page shells and include Post Content.
- `theme.json` owns reusable design tokens, layout settings, and global or per-block styles.
- `functions.php` registers theme support, assets, patterns, styles, variations, and custom blocks as needed.
- `style.css` contains the required theme header and limited styles not better expressed in `theme.json`.
- `PROJECT.md` records site, design, content, and acceptance details without placing project-specific assumptions in the boilerplate instructions.

## Implementation Priorities

Use the first option that represents the design accurately and remains easy to edit:

1. Core Gutenberg block
2. Existing core-block variation
3. Existing registered block style
4. Pattern composed from core blocks
5. New variation or block style
6. Custom parent/child block
7. Dynamic server-rendered block

Use ACF only when structured fields, validation, relationships, conditional fields, or repeated records materially improve editing. Ordinary page content belongs in native blocks or `InnerBlocks`.

## Building a Theme

1. Define colors, typography, spacing, widths, gradients, and block defaults in `theme.json`.
2. Build shared headers and footers in `parts/` and page shells in `templates/`.
3. Add reusable page sections to `patterns/`.
4. Store page-specific headings, copy, media, cards, and calls to action in page block content.
5. Add custom blocks to `blocks/` only when behavior or content structure requires them.
6. Keep replaceable images in Image or Cover blocks and decorative assets in theme CSS.

Do not hardcode a page's marketing content into a template. Templates define the shell; pages own their content.

## Custom Blocks

When a custom block is necessary:

- Define it with `block.json` and register it on the server.
- Use attributes or `InnerBlocks` for editable content.
- Use parent/child blocks for repeatable slides, tabs, or panels.
- Keep editor and frontend output consistent.
- Provide semantic controls, keyboard access, visible focus, and reduced-motion support.
- Add saved-markup migrations before changing blocks already used in content.

## Validation

Before considering a page complete:

- Confirm block registration and parse the saved block markup.
- Test representative content edits.
- Check desktop, tablet, and mobile layouts.

## Getting Started

1. Rename the theme directory and update the header in `style.css`.
2. Complete `PROJECT.md` with known WordPress and design context.
3. Replace the starter presets in `theme.json` with the project's design system.
4. Extend the templates, template parts, and patterns as required.
5. Activate the theme in a supported WordPress installation.
6. Provide an inspectable Figma frame and invoke `figma-to-gutenberg` to begin implementation.
