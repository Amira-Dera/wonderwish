---
name: visual-block-engineer
description: Build high-fidelity, visually editable WordPress blocks that match approved Figma designs while locking layout and styling. Use when an editor needs direct canvas editing through native React blocks or an existing block framework without gaining controls that can break the design system.
---

# Visual Block Engineer

Deliver a direct WYSIWYG editing experience that keeps editors focused on the canvas while protecting the approved design from drift.

## Establish the implementation contract

1. Read repository instructions and inspect the exact Figma nodes, variables, components, assets, responsive states, and interaction details when available.
2. Inspect the existing block architecture, WordPress and plugin versions, build workflow, design tokens, shared components, block registration conventions, and frontend/editor styles.
3. Use the repository's existing block framework when one is established. Do not introduce a new framework or dependency without explicit authorization.
4. Define which values are content, which are approved variants, and which structural properties must remain locked.
5. Preserve supplied copy and exact exported assets. Do not substitute generic graphics, icons, or guessed tokens when the approved source exists.

## Direct canvas editing

- Implement inline editing with native `RichText` components or equivalent framework features for headings, paragraphs, prices, labels, and button text.
- Make the editor preview mirror the frontend closely in typography, spacing, widths, colors, responsive intent, and component states.
- Keep content editing on the canvas whenever the value has a direct visual representation.
- Provide useful placeholders without saving placeholder text as real content.
- Preserve semantic element choices and prevent rich-text formats that the design system does not support.

## Contextual controls and complex data

- Give images, icons, and links small contextual toolbars or popovers activated from the canvas.
- Keep frequently used controls close to the selected element and avoid duplicating the same setting across multiple panels.
- Reserve `InspectorControls` or the framework equivalent for complex arrays, repeaters, structural configuration, and data that cannot be edited clearly in place.
- Use the sidebar for items such as pricing rows, FAQs, workflow steps, namespace cards, or approved behavior variants.
- Label controls in editor language and make ordering, addition, removal, and empty states predictable.

## Strict design lockdown

- Expose content controls, not unrestricted design controls. Editors may change approved text, links, images, icons, cards, prices, and list items.
- Lock layout, grids, spacing, typography scales, breakpoints, widths, and responsive rules.
- Disable arbitrary margin, padding, typography, color, border, and custom-CSS controls unless explicitly required by the approved system.
- Offer variations only as named, approved block styles or constrained attributes, such as `is-style-dark-card`.
- Define block supports deliberately rather than accepting broad defaults.
- Keep editor and frontend class names, attributes, and style sources aligned so saved content remains stable.

## Asset accuracy and structural protection

- Use exact exported Figma graphics and SVGs, optimized without changing their intended appearance.
- Ensure each page section is an independently movable and duplicable block when the content model requires section-level composition.
- For complex internal layouts, use locked nested templates such as `templateLock="all"` when editors must not delete, reorder, or insert structural children.
- Use less restrictive locking only when a specific editor task requires controlled insertion or ordering.
- Do not encode editable copy inside images or CSS-generated content.
- Preserve semantic HTML, heading order, link behavior, alternative text, keyboard access, and meaningful source order.

## Data and rendering

- Choose static or dynamic rendering based on the content's actual needs and the repository's conventions.
- Keep attribute schemas minimal, explicit, versionable, and compatible with existing saved content.
- Sanitize server-rendered values and escape output by context.
- Avoid storing derived presentation data that can be calculated from canonical attributes.
- Add deprecations or migrations when changing existing saved markup would otherwise invalidate blocks.
- Ensure important content remains present in rendered HTML for accessibility and indexing.

## Responsive and accessible behavior

- Match the approved mobile, tablet, desktop, and intermediate-width behavior in both editor and frontend.
- Keep controls keyboard accessible with visible focus and correct names, roles, and states.
- Prefer native elements and minimize ARIA.
- Respect zoom, reflow, reduced motion, touch target sizing, and logical reading order.
- When dense structures transform at smaller widths, preserve the meaning of labels and values rather than relying on visual position.

## Verify

1. Test block insertion, selection, inline typing, contextual controls, Inspector controls, duplication, movement, undo/redo, save, reload, and copy/paste.
2. Confirm forbidden design controls are unavailable and locked structures cannot be broken through normal editor actions.
3. Compare the editor and frontend against the approved Figma design at mobile, tablet, intermediate, and desktop widths.
4. Test short, long, empty, and maximum practical content without layout breakage.
5. Validate frontend semantics, keyboard behavior, accessible names, focus, images, links, and responsive transformations.
6. Check for invalid-block warnings, console errors, PHP notices, asset failures, and editor/frontend style drift.
7. Report files changed, editable fields, locked properties, approved variations, tests performed, and any remaining design or data-model gap.
