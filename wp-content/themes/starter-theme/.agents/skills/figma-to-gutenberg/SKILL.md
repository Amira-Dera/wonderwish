---
name: figma-to-gutenberg
description: Turn an approved Figma frame into an accurate, responsive, editable Gutenberg page in this starter repository. Use for end-to-end Figma-to-WordPress page implementation; do not use for a visual audit with no implementation request.
---

# Figma to Gutenberg

Build the page from design evidence while preserving native WordPress editing and the theme's design system. This is a boilerplate: discover project facts at runtime and never assume content, plugins, URLs, or architecture from a previous site.

## Establish the contract

1. Read `AGENTS.md`, `PROJECT.md`, `README.md`, and the current theme before editing.
2. Inspect the exact Figma frame, variables, components, assets, variants, and available responsive frames using the environment's Figma design-inspection workflow.
3. Inspect WordPress, the target page's saved blocks, Media Library, active plugins, theme registrations, and supported versions when access exists.
4. Preserve a recoverable page revision and create a draft unless publishing is explicitly authorized.

Begin when the frame and repository are accessible. Infer ordinary implementation details when safe. Record material unknowns in `PROJECT.md`; ask only when an answer changes content, behavior, architecture, rights, or external state.

## Plan from evidence

- Map Figma variables to `theme.json` presets before styling sections.
- Inventory reusable components and existing WordPress equivalents.
- Classify each element as page content, pattern, block style, variation, custom block, template part, or decoration.
- Follow the repository's Gutenberg capability priority. Do not default to custom blocks or ACF.
- Treat missing responsive frames as design work: preserve hierarchy and content priority rather than scaling desktop down. State inferred behavior.

## Implement

- Put the page shell in templates, shared site chrome in template parts, reusable compositions in patterns, and page-specific content in Gutenberg markup.
- Keep one page-level `h1`; use semantic blocks and descriptive Group names.
- Export approved assets locally. Use Image or Cover blocks for replaceable media and theme CSS only for decoration.
- Keep editor and frontend appearance aligned. Expose content and approved variants while locking structural design decisions.
- For justified custom blocks, use `block.json`, server registration, stable attributes or `InnerBlocks`, and migrations for changed saved markup.
- Implement interactions progressively with keyboard support, visible focus, reduced motion, touch controls, and useful no-JavaScript content.

Invoke the repository's specialized accessibility, responsive-interface, SEO/GEO, or visual-block skills when that work is materially present. They refine this workflow; they do not replace its architecture decision.

## Verify and hand off

1. Run relevant PHP, JavaScript, and JSON checks and confirm block registration.
2. Parse saved markup and complete a Gutenberg save/reload without invalid-block warnings.
3. Test representative editing, movement, duplication, links, media replacement, undo/redo, and locked structures.
4. Compare editor and frontend with Figma at supplied widths and sensible intermediate widths.
5. Check 320px overflow, keyboard flow, focus, contrast, reduced motion, asset failures, console errors, and layout shift.
6. Report the page ID, status, edit URL, preview URL, editable areas, locked decisions, inferred behavior, checks performed, and unresolved gaps.
