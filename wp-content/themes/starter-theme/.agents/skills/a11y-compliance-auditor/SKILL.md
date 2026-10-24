---
name: a11y-compliance-auditor
description: Audit and improve web interfaces against applicable WCAG 2.1 and 2.2 Level AA requirements, including semantics, keyboard access, focus, forms, contrast, responsive reflow, and accurate ARIA states. Use for accessibility reviews or fixes that must support screen readers and reliable machine content extraction.
---

# Accessibility Compliance Auditor

Find and fix accessibility barriers using evidence from the implemented interface. Do not claim complete legal or WCAG compliance from automated checks alone.

## Establish scope

1. Read repository instructions and identify the pages, components, interaction states, supported browsers, and available testing environment.
2. Determine whether WCAG 2.1 AA, WCAG 2.2 AA, or both are required. Apply the stricter relevant success criterion when their requirements differ.
3. Inspect the rendered interface as well as its source. Include responsive, empty, error, loading, expanded, selected, and modal states that users can encounter.
4. Preserve the existing visual design unless a change is required to remove a barrier; explain material design implications.

## Audit priorities

Review at minimum:

- document language, page title, landmarks, heading hierarchy, source order, lists, tables, and meaningful grouping;
- accessible names, descriptions, roles, values, states, relationships, and status announcements;
- keyboard reachability, logical focus order, visible focus, focus restoration, skip mechanisms, and absence of traps;
- forms, labels, instructions, required states, errors, validation summaries, and autocomplete purpose;
- links, buttons, menus, tabs, accordions, dialogs, carousels, disclosures, and custom widgets;
- alternative text, captions, transcripts, decorative media treatment, and text embedded in images;
- text and non-text contrast, color-independent meaning, zoom, text spacing, orientation, reflow, and target size;
- animation, flashing, autoplay, time limits, drag-only actions, hover/focus content, and reduced-motion behavior;
- content hidden visually or from assistive technology, including breakpoint-specific interfaces.

## Remediation rules

- Prefer native HTML elements and browser behavior. Add ARIA only when native semantics cannot express the required interaction.
- Ensure every ARIA role and state matches actual behavior. Update states such as `aria-expanded`, `aria-selected`, `aria-current`, `aria-pressed`, and dialog attributes when interaction changes.
- Do not add redundant roles, inaccessible positive `tabindex` values, or broad `aria-label` overrides that conceal useful visible text.
- Keep meaningful content in the DOM and in a logical reading order so assistive technologies and machine extraction receive the same essential information as visual users.
- Use actual buttons for actions and actual links for navigation.
- Associate data-table headers correctly and retain captions or concise accessible context when needed.
- Move focus deliberately only when the interaction requires it. Restore focus after dismissing overlays and keep background content inert while a modal is active.
- Make error identification specific and programmatically associated with the affected field. Do not rely on color alone.
- Maintain visible focus indicators with sufficient contrast and ensure sticky content does not obscure focused elements.
- Avoid hiding focus outlines without an equally clear replacement.

## Testing approach

Use automated tools to find detectable issues, then verify manually. Automated success is not proof of conformance.

1. Navigate the complete scope with keyboard only.
2. Inspect the accessibility tree, accessible names, roles, states, and reading order.
3. Test at 200% zoom and the applicable reflow viewport without loss of content or functionality.
4. Check text and interface-component contrast with measured values.
5. Test representative screen-reader flows when the environment supports them.
6. Exercise form errors and all interactive states.
7. Verify pointer cancellation, target sizing, alternatives to dragging, reduced motion, and orientation behavior where applicable.
8. Re-run relevant automated checks after remediation and confirm no regressions at desktop, tablet, and mobile widths.

## Report findings

For each unresolved issue, provide:

- severity and user impact;
- affected component or file;
- applicable WCAG success criterion and level;
- evidence and reproduction steps;
- recommended remediation;
- whether the finding was fixed, requires design/content input, or could not be verified.

Distinguish confirmed failures from risks and manual-review items. State exactly what was tested and avoid a blanket compliance claim when coverage was incomplete.
