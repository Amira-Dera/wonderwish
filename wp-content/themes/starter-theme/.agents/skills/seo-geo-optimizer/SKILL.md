---
name: seo-geo-optimizer
description: Audit and directly improve HTML or WordPress pages for technical SEO, on-page SEO, accessibility-related discoverability, structured data, internal linking, and generative engine optimization (GEO) or AI-search readability. Use when Codex must implement evidence-based search improvements, metadata guidance or integration, schema/JSON-LD, semantic content structure, and citation-friendly answers without keyword stuffing, fabricated facts, or guaranteed rankings.
---

# SEO and GEO Optimizer

Improve the actual page and its discoverability. Treat scores as diagnostic signals, not the goal, and never promise rankings or AI citations.

## Establish evidence and scope

1. Inspect repository instructions, page content, templates, SEO-plugin conventions, global metadata ownership, existing schema, analytics constraints, sitemap/robots behavior, and relevant internal pages.
2. Determine the page's audience, primary task, search intent, canonical topic, business goal, locale, and conversion action from supplied evidence.
3. If keyword, competitor, entity, or current search-result research is requested or necessary, use current authoritative sources and document the date and evidence. Do not fabricate volumes, difficulty, competitor claims, testimonials, statistics, credentials, or citations.
4. Preserve the author's meaning and brand voice. Flag claims needing subject-matter approval.

## Audit before changing

Review:

- indexability, status/canonical signals, duplicate or thin content, crawlable links, and rendering;
- title, meta description ownership, URL guidance, headings, opening answer, topical coverage, media, and calls to action;
- semantic landmarks, link text, alternative text, form labels, focus/keyboard behavior, contrast, and content hidden from assistive technology or crawlers;
- performance risks affecting discovery and user experience, including oversized media, layout shift, render blocking, and unnecessary scripts;
- existing JSON-LD, plugin-generated schema, breadcrumbs, organization/sitewide entities, and duplicate graphs;
- internal-link opportunities based on actual repository pages, not invented URLs.

Separate actionable findings from items that cannot be verified locally. Prioritize by likely impact, confidence, and effort.

## Implement improvements

- Write a unique, accurate title and concise meta description through the project's existing SEO mechanism. Do not create competing tags if a plugin owns them.
- Use one clear page topic, a logical heading hierarchy, descriptive section labels, and an early direct summary that answers the core intent.
- Improve clarity with concise definitions, concrete facts, scannable steps, comparison tables, FAQs, and attributed evidence only where they genuinely help users.
- Make entity relationships explicit: identify the organization, product/service, audience, location, dates, authorship, and sources when verified and relevant.
- Add contextual internal links to real, useful destinations with descriptive anchor text. Avoid forced link counts and orphaned claims.
- Improve semantic HTML and accessibility issues that affect comprehension and discovery. Keep important content in crawlable HTML.
- Preserve natural language. Do not keyword-stuff, pad content, create doorway copy, hide text, or optimize for bots at users' expense.
- Give crawlers and AI systems self-contained, consistent passages that can be quoted accurately, while retaining nuance and limitations.

## Structured data

1. Select only schema types supported by visible page content and the page's real purpose.
2. Prefer integration with the existing SEO plugin or schema graph. Avoid duplicate `WebPage`, organization, breadcrumb, article, product, or local-business entities.
3. Use stable canonical URLs and consistent `@id` references.
4. Include only truthful properties visible on or supported by the site. Do not invent ratings, reviews, prices, availability, authors, locations, or dates.
5. Add FAQ or HowTo markup only when the corresponding content is visible and the type is appropriate; do not assume it will receive a rich result.
6. Encode JSON-LD safely. In WordPress, follow existing hooks/helpers and use safe JSON encoding rather than hand-built JSON strings.

## WordPress and ACF constraints

- Respect theme/plugin ownership of titles, canonicals, Open Graph, robots directives, and schema.
- When content comes from ACF, use only existing fields unless explicitly authorized to change the field model.
- Escape output by context and do not weaken the page's security to add metadata.
- Keep global changes separate from page-specific changes and identify their wider impact before editing.

## Verify and report

1. Run available lint, tests, render checks, link checks, structured-data validation, and accessibility/performance audits appropriate to the project.
2. Inspect the rendered source to ensure one canonical, coherent metadata output, valid JSON-LD, crawlable content, and no duplicate plugin/theme tags.
3. Confirm schema matches visible content and every new internal URL resolves within the known site.
4. Recheck mobile layout and interactions after content changes.
5. Report implemented changes, guidance that requires CMS/plugin configuration, validation results, unresolved blockers, and prioritized next steps. Distinguish measured results from estimates.
