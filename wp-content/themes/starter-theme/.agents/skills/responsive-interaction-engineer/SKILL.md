---
name: responsive-interaction-engineer
description: Transform complex desktop interfaces such as pricing tables, comparison grids, data tables, and mega-menus into clear mobile and tablet interaction patterns while preserving semantic, indexable content. Use when a dense interface must remain usable by touch, keyboard, assistive technology, and crawlers across breakpoints.
---

# Responsive Interaction Engineer

Adapt complex interfaces for smaller screens without hiding essential information, duplicating conflicting content, or weakening semantics.

## Inspect before choosing a pattern

1. Read the repository instructions and inspect the existing component, content hierarchy, CSS, JavaScript, breakpoints, and comparable responsive patterns.
2. Identify the user's primary comparison or navigation task, the information that must remain visible, and any relationships conveyed by rows, columns, headings, or groups.
3. Test intermediate tablet widths as distinct layouts rather than treating them as scaled desktop or enlarged mobile.
4. Prefer the simplest pattern that keeps relationships understandable. Do not introduce a carousel, accordion, or alternate markup solely to make the layout fit.

## Select an appropriate transformation

- Keep a table when simultaneous row-and-column comparison is central. Use an accessible horizontal scroll region, a visible scroll cue, sticky labels where helpful, and adequate column widths.
- Use plan cards when users evaluate one package at a time. Repeat the relevant feature label beside each value so meaning does not depend on position.
- Use an accordion when content is naturally grouped and users do not need every group open for comparison. Use real buttons and expose accurate expanded states.
- Use a touch slider only when sequential browsing is appropriate. Provide visible controls, position feedback, swipe support, keyboard operation, and a non-drag alternative.
- Convert mega-menus into progressively disclosed navigation with clear parent links, back controls, and predictable focus handling.
- Avoid cramped wrapping that separates a label from its value or makes columns visually ambiguous.

## Preserve content and indexability

- Keep the complete meaningful content in semantic HTML in source order. Do not rely on JavaScript to inject primary content after load.
- Prefer one shared DOM representation that CSS and minimal JavaScript adapt across breakpoints.
- If an alternate representation is genuinely necessary, prevent duplicate accessible content and keep a single canonical reading order.
- Preserve real headings, lists, tables, links, buttons, captions, and relationships. Do not replace meaningful elements with generic containers.
- Never encode essential labels only in CSS pseudo-elements, icons, hover states, or visual position.

## Interaction requirements

- Support touch, keyboard, pointer, screen-reader, zoom, and reduced-motion use.
- Keep touch targets comfortably sized and separated.
- Make focus visible and prevent focus from moving into collapsed or visually hidden content.
- Use native scrolling and controls where possible. Do not trap horizontal page scrolling or require precision gestures.
- Preserve user state during reasonable viewport changes when practical.
- Announce meaningful state through native semantics or accurate ARIA attributes; do not announce ordinary visual movement unnecessarily.
- Keep JavaScript progressive and ensure core content remains readable when it is unavailable.

## Protect performance and layout stability

- Avoid unnecessary libraries and duplicate event handlers.
- Reserve media dimensions and avoid breakpoint changes that cause large layout shifts.
- Use CSS for layout changes when behavior does not require JavaScript.
- Scope selectors and behavior to the component so unrelated pages are not affected.

## Verify

1. Inspect narrow mobile, wide mobile, tablet portrait, tablet landscape, laptop, and wide desktop layouts.
2. Test long labels, translated text, missing optional values, many items, and the smallest supported viewport.
3. Navigate every control using only the keyboard and confirm a logical focus order.
4. Verify headings, labels, table associations, expanded states, and hidden content with accessibility inspection.
5. Confirm primary content exists in the rendered HTML, remains understandable in source order, and does not depend on visual position.
6. Check overflow, clipping, scroll affordances, sticky elements, touch targets, layout shifts, and console errors.
7. Report the selected responsive pattern, why it fits the task, files changed, checks performed, and any remaining limitation.
