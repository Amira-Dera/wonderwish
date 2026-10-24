# WonderWish — Fantasy Theme

Twenty Twenty-Five child block theme for the WonderWish WooCommerce store.

## Current editing locations

- **Pages → Home:** saved homepage headings, text, buttons and sections. Preserve these manual edits; theme pattern changes do not overwrite saved page blocks.
- **Appearance → Editor → Patterns → Header / Footer:** shared site parts.
- **Products:** actual product images, prices, categories and attributes.
- **Settings → General → Site Icon:** the favicon stored in WordPress uploads.

See [MAINTENANCE.md](MAINTENANCE.md) for the current folder map, verification commands and cleanup record. See [woocommerce/README.md](woocommerce/README.md) for the three genuine WooCommerce overrides.

The remaining sections are chronological implementation notes and artwork provenance. Some older layouts and paths have been superseded; use the current editing guide above.

## Implementation history and asset provenance

- `assets/css/hero.css`: scoped blue gradients, static light accents, responsive typography, header, and button styles. The gradient, text and controls remain usable without JavaScript.
- `assets/js/magic-hero.js`: one 2.6-second original light orbit, then pointer glitter. A fixed particle pool, capped drawing resolution and frame-rate-independent lifetimes bound the work. Rendering stops after particles expire.
- Fine hover pointers receive glitter. Coarse/touch pointers receive the lighter brief intro only. Reduced motion disables the canvas and entrance animations. Hidden pages are paused, and listeners/frames are removed on exit.

The previous character implementation and its bundled images, pupil script, labels, and animations have been removed. There are no external assets or animation dependencies.

## Shop by World — local character preview

`patterns/shop-by-world.php` sits directly after the unchanged hero in Blog Home. Native Group, Heading, Paragraph, Image and Button blocks remain editable in Appearance → Editor → Templates → Blog Home. Scoped `assets/css/worlds.css` is also loaded in the editor. White bordered cards stack on mobile. Explicit image dimensions reserve space; transparent WebPs are lazy-loaded locally. No extra JavaScript, libraries or remote image requests.

Gentle vertical floating and decorative sparkles finish after 16–18 seconds. Hover lifts the card and strengthens the character shadow. Reduced-motion disables transitions and animation. Neither flat image has separable hand layers; **no hand waving or fake rotation is implemented**.

Links use the existing Shop URL with native WooCommerce `filter_franchise=disney` / `dreamworks`. Attribute archives remain disabled. Both destinations open correctly; actual inventory filtering remains untested because the store has no published products.

### Asset provenance and launch blocker (checked 2026-10-19)

**Development evaluation only. Neither asset is verified for commercial storefront use. Replace or obtain rights-holder permission covering the intended use before launch.** The source websites' stated licenses do not establish Disney or DreamWorks authorization. A visible attribution/development notice is included below the cards. No site visibility or commerce settings were changed.

| Asset | Source / stated license | Selection and processing |
| --- | --- | --- |
| Stitch | PNGimg, https://pngimg.com/image/109294 ; original https://pngimg.com/uploads/stitch/stitch_PNG72.png ; site states CC BY-NC 4.0 (https://creativecommons.org/licenses/by-nc/4.0/). Underlying character belongs to Disney; commercial rights not verified. | Happy full-body seated pose, 906×1219 RGBA. Trimmed transparent margins, resized to 557×760. Local `assets/images/characters/stitch.png` and optimized `stitch.webp` (46,442 bytes). |
| Po | User-supplied `/Users/amira/Downloads/43620-kung-fu-panda.png`, matching https://freepngimg.com/png/43620-kung-fu-panda ; site lists Shirley Keller and CC BY-NC 4.0. Underlying character belongs to DreamWorks; commercial rights not verified. | Full-body raised-paw pose, 1200×1239 RGBA; resized to 736×760. Local `assets/images/characters/po.png` and optimized `po.webp` (63,700 bytes). |

PNG copies preserve alpha for future editing; only WebPs (about 108 KiB combined) load on the page. Transformations are resizing, transparent-margin trim and format conversion; no watermark removal, upscaling or generative edits. Original files in Downloads are untouched.

### Compared alternatives

- Supplied Stitch WebP (`stitch-comic-happy-cute-transparent-png-11720398915n6bh5qrndc.webp`): 850×701 RGB, baked-in checkerboard and TopPNG watermark. Rejected; not modified or bundled.
- PNGimg https://pngimg.com/image/109254 (`stitch_PNG32.png`): 690×876, hands against face, visibly lower detail. Downloaded for comparison; not bundled. Same stated CC BY-NC 4.0.
- PNGimg https://pngimg.com/image/109290 (`stitch_PNG68.png`): 1422×1710, inverted acrobatic pose. Higher resolution but less suitable for an upright greeting card; not bundled. Same stated license.
- PNGimg https://pngimg.com/image/20729: Po 1200×1239 alternative, same dimensions and pose as supplied file, stated CC BY-NC 4.0; no quality advantage.
- PNGGallery https://pnggallery.com/stitch/ and https://pnggallery.com/kung-fu-panda/ state noncommercial use; no stronger permission found.
- TopPNG https://toppng.com/free-image/disney-stitch-png-PNG-free-PNG-Images_492946 claims commercial use but identifies an individual uploader without verified Disney authority. Not used.

Licensing references: https://disneytermsofuse.com/english/ ; Disney permission route https://help.disney.com/article/dcom-can-i-get-permission-to-use-disney-property ; DreamWorks https://prod.dreamworks.com/terms-of-use ; IMG lists Kung Fu Panda representation including Libya at https://imglicensing.com/brands/kung-fu-panda/ . No license purchase or agreement was made.

## Current hover animation revision

The displayed characters now use the two user-supplied GIFs, converted without upscaling to animated WebP and a lossless first-frame WebP. Previous PNG assets remain as unused alternatives.

| Current asset | Supplied source | Dimensions / animation | Optimized size |
| --- | --- | --- | --- |
| Po waving | `/Users/amira/Downloads/_.gif` | 294×284, 12 frames, 960 ms cycle | 109,548 bytes |
| Stitch waving | `/Users/amira/Downloads/Lilo And Stitch Waving GIF - Lilo And Stitch Waving Hi - Discover & Share GIFs.gif` | 240×240, 8 frames, 800 ms cycle | 87,822 bytes |

No source URL or license accompanied these GIF files. The Stitch filename suggests a GIF-sharing service but does not establish provenance or commercial rights. **Local development evaluation only; obtain clearance or replace before commercial launch.** The visible preview notice reflects this. No third-party source attribution from the previous assets is represented as applying to these GIFs. Original Downloads files are untouched.

`assets/js/world-cards.js` switches from first-frame stills to animation on fine-pointer hover or keyboard focus. It restores the still on leave/blur, document hiding, media preference changes, or after four seconds. Touch and reduced-motion keep stills. Native links retain their behavior. No fake rotation or independent limb simulation.

Po's red decorative “Hi” is hidden through a fixed CSS clipping region that excludes the text in all 12 frames without clipping the head or moving paw. This is a presentation mask, not an alteration of original frames. No watermark was removed. Stitch has no extra text. White-background blending and removal of box-shaped image shadows keep the characters visually centered against white cards.

Quality limit: these are low-resolution GIF originals. WebP conversion preserves their animation and avoids enlargement beyond native dimensions; it cannot recover absent detail. No AI upscaling or sharpening claims are made.

## Current simplified logo cards

Removed the card kicker paragraphs and replaced the visible franchise headings with locally loaded SVG wordmarks. Accessible h3 names are retained through logo alt text. Removed all orbit outlines, card glows, image shadows and card shadows. Character display widths increased from 240/294px to 320/352px on desktop, constrained on mobile. The low-resolution GIFs cannot gain true detail from this enlargement. Hover wave script and Po text mask are preserved.

The section has six sparse static blue/green accents and a small blue/green/white pointer glitter canvas (`assets/js/world-glitter.js`). Fixed 56-particle pool, capped DPR, no animation work while idle, and no tracking on touch or reduced motion. Canvas is decorative, cannot intercept clicks, and adds no animation library. Hero files remain untouched.

### Logo sources (downloaded 2026-10-19)
- `assets/images/logos/disney.svg`: https://commons.wikimedia.org/wiki/File:Disney_wordmark.svg — author listed as Disney Enterprises, Inc.; page labels public-domain text logo (PD-textlogo), with trademark restrictions separately noted.
- `assets/images/logos/dreamworks.svg`: https://commons.wikimedia.org/wiki/File:DreamWorks2016.svg — author listed as DreamWorks Animation LLC; page labels public-domain text logo (PD-textlogo), with trademark restrictions separately noted.

Files downloaded via Commons Special:Redirect/file, inspected for scripts, embedded images, external hrefs and event handlers, then used as local img resources. These copyright labels do not grant trademark endorsement or establish permission for the store's commercial branding. Existing local-development licensing status remains in place.

## Current higher-resolution wave sources (2026-10-19)

The displayed GIF derivatives now use larger downloaded masters, not upscaled copies of the supplied 240×240 / 294×284 files. Original hover behavior, character display size, logos and glitter are preserved. Po's obsolete text mask is removed because this source has no greeting text.

- Stitch: https://tenor.com/view/stitch-lilo-and-stitch-disney-wave-bye-gif-17559031 ; original download https://media1.tenor.com/m/MXK5aazbwlsAAAAC/stitch-lilo-and-stitch.gif ; verified 498×498, 8 frames, 800 ms. The alternate 640×640 compressed preview had visibly worse posterization and was rejected.
- Po: https://gifdb.com/gif/kung-fu-pandapo-waving-ub3ic92611g1yvxk.html ; download https://gifdb.com/images/high/kung-fu-pandapo-waving-ub3ic92611g1yvxk.gif ; verified 500×500, 10 frames. A 640×640 Tenor alternative was rejected for visible posterization.

Local `stitch-hq-wave.webp`, `po-hq-wave.webp` and their `-still.webp` companions use lossless conversion to avoid additional encoding degradation. Frame dimensions, timing and existing pixel content are preserved; no sharpening or AI reconstruction. Existing softness and palette dithering remain in the source. Older assets are unused alternatives.

License status: no commercial rights verified. Tenor's https://tenor.com/legal-terms expressly restricts commercial use; no commercial license for the GIFDB character asset was established. These remain local development evaluation assets and must be cleared or replaced before launch. Downloads are not rights clearance.

## Little Treasures, Big Smiles — third homepage section

`patterns/little-treasures.php` follows Shop by World in `templates/home.html`. `assets/css/treasures.css` is scoped to this section and loaded in both the editor and homepage. Previous hero/world pattern and animation files were not changed. Text, category links, cards and images are native Gutenberg blocks, editable in Blog Home. No products, stock, prices, taxonomies, commerce settings or plugins were created or changed.

Catalogue inspection: zero published products. Eight clearly marked demo concepts cover Mickey Mouse, Toothless, Elsa, Po, Simba, Shrek and Stitch, with all four existing categories. Character illustrations are concept imagery, **not photographs of products for sale**. Every card says Demo concept and Sample price; the section explicitly states the items are unavailable. Prices are arbitrary LYD design samples, never catalogued or purchasable. Card names and Browse actions lead to the existing category archives; the final CTA opens Shop.

The file-backed pattern uses WooCommerce's native `[products limit="8" columns="4" visibility="visible" orderby="date" order="DESC"]` when published catalogue-visible products exist. It does not rebuild WooCommerce product logic. Actual-product rendering could not be exercised with this empty catalogue. If an editor saves an expanded pattern into a template, that saved copy is editable static block content; replace it with the native Products block/shortcode when inventory is ready.

Responsive grid: 4 desktop, 3 tablet, 2 mobile columns (1 at very narrow widths). Images have reserved panels, local lazy-loaded WebPs, no hotlinks or image dependencies. Gentle two-cycle floating, hover lift, keyboard focus and reduced-motion rules. Decorative sparkles are CSS shapes excluded from spoken text.

### Sources and licensing (checked 2026-10-19)

**Local design evaluation only. No commercial character rights verified. Clear or replace all illustrative assets before launch.** PNGimg pages state CC BY-NC 4.0 (https://creativecommons.org/licenses/by-nc/4.0/). PNG All galleries state personal/non-commercial projects. These source statements do not establish authorization from Disney/DreamWorks. The section includes visible attribution and a launch-rights notice.

| File in assets/images/treasures | Source page | Download/original | Stated permission |
| --- | --- | --- | --- |
| mickey.webp | https://pngimg.com/image/29482 | https://pngimg.com/uploads/mickey_mouse/mickey_mouse_PNG76.png | CC BY-NC 4.0 |
| toothless.webp | https://pngimg.com/image/115933 | https://pngimg.com/uploads/night_fury/night_fury_PNG115933.png | CC BY-NC 4.0 |
| elsa.webp | https://www.pngall.com/elsa-png/ | https://www.pngall.com/wp-content/uploads/5/Elsa-PNG.png | Personal/non-commercial stated |
| simba.webp | https://www.pngall.com/simba-png/ | https://www.pngall.com/wp-content/uploads/15/Simba-Transparent.png | Personal/non-commercial stated |
| shrek.webp | https://pngimg.com/image/29182 | https://pngimg.com/uploads/shrek/shrek_PNG10.png | CC BY-NC 4.0 |
| stitch.webp | https://pngimg.com/image/109294 | Existing theme character PNG, originally stitch_PNG72.png | CC BY-NC 4.0 |
| po.webp | https://freepngimg.com/png/43620-kung-fu-panda | Existing user-supplied/previous theme PNG; source lists Shirley Keller | CC BY-NC 4.0 |

Preparation: verified alpha, trimmed transparent margins, downscaled to at most 640px, encoded WebP quality 92. No image was upscaled or generatively altered; no watermark removed. The higher-detail Toothless was selected over https://pngimg.com/image/115927 (small cartoon styling). A product-photography search included https://commons.wikimedia.org/wiki/Category:Stuffed_Mickey_Mouse ; available documentary/event photos were unsuitable for clean individual product cards. No unapproved retailer product photography is presented as real inventory.

Optimized asset dimensions and bytes:
- elsa.webp: 278×640, 49,590 bytes.
- mickey.webp: 508×640, 75,354 bytes.
- po.webp: 620×640, 65,472 bytes.
- shrek.webp: 590×640, 79,336 bytes.
- simba.webp: 640×630, 64,878 bytes.
- stitch.webp: 469×640, 47,778 bytes.
- toothless.webp: 362×640, 51,142 bytes.

## Current circular showcase revision

The eight local demo cards now travel around a slow 70-second elliptical orbit on desktop/fine-pointer devices (900px+). Perspective, depth-based scale and stacking create a circular showcase. `assets/js/treasure-orbit.js` pauses the entire orbit on stage hover or keyboard focus, brings a keyboard-focused card to the front, and provides an explicit Pause/Resume button. Animation stops when offscreen or the document is hidden. On touch, narrow screens, reduced motion, or without JS, all cards remain in a readable native grid. No autoplaying mobile carousel.

Pastel fills were removed; cards now use plain white surfaces and thin borders so overlapping text stays legible. Each image has a top-right native category CTA. Existing demo/sample-price notices, destination links and image licensing status remain. Real inventory still uses the native WooCommerce product grid; the current orbit applies to the empty-catalogue demo showcase.

The existing pointer-glitter engine now also targets this section, with blue, green, lilac, gold and white particles plus sparse decorative background sparkles. Prior Shop by World colors remain unchanged. Static background marks are decorative/aria-hidden; the canvas does not intercept links. No new image sources or commerce changes.

## Corrected reference motion: full-width curved stream

The elliptical orbit has been replaced with one continuous row moving from right to left at 35px/second. Cards follow a shallow curve (edges rise slightly) with gentle perspective/tilt, fade at the viewport edges, and wrap only outside the visible area. No rear row or circular return path is shown. The stage spans the full section width. Hover/focus/manual pause, keyboard centering, mobile and reduced-motion grid fallback remain. Controls are labeled Pause/Resume motion.

## Compact colorful stream revision

Demo cards now retain only artwork, name and top-right category CTA; redundant labels, sample prices and duplicate Browse links were removed from each card. The section-level demo and rights notices remain. Soft pastel card colors and sparse decorative specks restore color without adding image requests. Stream speed increased from 35 to 55 pixels/second. Hover listeners are attached to individual cards, so empty stage space no longer pauses the stream. Keyboard focus/manual pause and mobile/reduced-motion fallbacks are preserved.

## Section 4 — Find Your Perfect Gift

`patterns/gift-finder.php` follows Little Treasures in Blog Home. Native Heading/Paragraph/Group blocks surround a core HTML block containing the accessible interactive form. The block is editable in Gutenberg's HTML view; the interaction is enhanced by scoped `assets/js/gift-finder.js` and `assets/css/gift-finder.css`. Previous sections and store configuration remain intact.

Original, theme-owned inline SVG gift-box artwork was created specifically for this section; there are no external illustration assets, stock licenses or network dependencies for decoration. The lid opens on reveal, two gift boxes float briefly, and sparse sparkles twinkle. All decorative artwork is aria-hidden. Animations are finite and disabled by reduced-motion preferences.

### Native catalogue matching
The finder makes a read-only same-origin GET to WooCommerce's existing `/wc/store/v1/products` endpoint, maximum three results. It requires all three chosen dimensions: the global Franchise attribute and two native product tags. It does not create products, terms, assignments, settings, custom REST routes or a parallel catalogue.

Assign these terms to actual products in the WordPress dashboard when inventory is ready:

| Choice | Native term |
| --- | --- |
| Kids | Product tag `gift-for-kids` |
| Friends | Product tag `gift-for-friends` |
| Family | Product tag `gift-for-family` |
| Myself | Product tag `gift-for-yourself` |
| Disney / DreamWorks | Existing Franchise attribute terms `disney` / `dreamworks` |
| Birthday | Product tag `gift-occasion-birthday` |
| Celebration | Product tag `gift-occasion-celebration` |
| Just because | Product tag `gift-occasion-just-because` |

Manage/create tags under Products → Tags; assign tags and Franchise under Products → Edit product. Only assign recipient tags after checking the actual product's suitability, especially age suitability for kids. Tags are matching labels and do not infer suitability from a character image. No recipient or occasion tags existed when built; none were created.

`tag_operator=and` ensures both tag matches, combined with `attributes[0][attribute]=pa_franchise` / selected slug. `catalog_visibility=catalog` excludes hidden/search-only products. Native stock and pricing data are displayed without altering inventory policy; out-of-stock matches are labeled. Product cards link to their real WooCommerce permalinks. Products without catalogue images are shown without a fabricated image.

The catalogue currently has zero published products. Native API verification returned HTTP 200 with an empty array; the browser displays a helpful empty state and existing filtered Shop link. No demo product cards or fabricated prices appear in this finder. Positive matches cannot be verified against actual inventory until real tagged products exist.

### Interaction and failure behavior
Native required radio groups, keyboard focus, polite live status, an announced result heading, Start again, loading state, request cancellation, stale-response protection and 12-second timeout. Changing a choice clears old results. Errors reveal an honest retry/browse message. Without JavaScript, a native Shop link is provided. Form choices are not persisted, tracked or transmitted to a third-party service. Result text uses textContent; catalogue links and endpoint URLs are protocol-checked, with same-origin enforcement for the endpoint and product links.

## Gift finder palette refinement

The finder now shares the surrounding character-card palette: blue, lilac, blush/coral, gold and sage. Original gift boxes use lilac wrapping, golden ribbons and a blush mini gift. Existing Stitch and Toothless cutouts are reused as decorative, aria-hidden cameos; these inherit the development-only source/licensing status in the Treasures asset table above. No new third-party assets were sourced or rights claimed.

Pastel choice tiles, matching checked borders, a blue/lilac CTA, soft multicolor panel glows and more visible sparkles connect this section to the rest of the homepage. The existing glitter engine now also targets `.ww-gifts` with the multicolor palette; prior sections keep their current palettes. All glitters are noninteractive overlays, with reduced-motion/touch guards. Catalogue filtering and form behavior are unchanged.

## Open box with new characters; consistent blue choices

The gift box is permanently open, including before selection and after reset. Olaf and Puss in Boots are layered behind the box's front face inside the original SVG scene. This replaces Stitch/Toothless cameos, so the gift finder introduces two characters not used in earlier homepage sections. The form tiles now all use the same blue palette, with a stronger blue checked state and visible keyboard focus. Matching behavior is unchanged.

New local preview assets in `assets/images/gift-finder/`:
- `olaf.webp`: https://pngimg.com/image/86867 ; downloaded https://pngimg.com/uploads/frozen/frozen_PNG35.png ; site states CC BY-NC 4.0.
- `puss-in-boots.webp`: https://pnggallery.com/puss-in-boots ; downloaded https://pnggallery.com/wp-content/uploads/puss-in-boots-01.png ; site states CC BY-NC 4.0.

Both were inspected, trimmed for transparent margins, downscaled to at most 500px, and converted to WebP quality 92. No generative edits or watermark removal. Visible attribution appears under the illustration. **Development preview only; commercial rights are not verified and these assets need clearance or replacement before launch.** Source license statements do not establish Disney/DreamWorks authorization.

### Gift box entrance refinement
The gift finder uses a solid ice-blue illustration panel on white, blue packaging and warm cream/gold ribbon accents. Its lid opens once as 45% of the illustration enters the viewport; Olaf and Puss rise from behind the front face. Search/reset do not replay the entrance. Without JavaScript, IntersectionObserver, or with reduced motion, the illustration stays open. Existing preview-only artwork restrictions still apply.

### Section 5: A Little More Magic in Every Order
`patterns/order-magic.php` provides editable native Group, Heading and Paragraph blocks for four general benefits. The decorative star, gift, shopping bag and help icons are original inline SVGs created for this theme; no third-party assets are required. `assets/css/order-magic.css` supplies the responsive four/two/one-column layout, finite sparkle animation, subtle hover and reduced-motion rules. Copy makes no authenticity, delivery, packaging or response-time guarantees. No additional JavaScript or commerce settings are used.

Section 5 visual revision: original full-color SVG storybook castle, opening present, heart shopping bag and storybook replace the line icons. Shared pointer glitter now includes this section, with its existing touch/reduced-motion guards. These decorative scenes are theme-original, not official Disney artwork.

Section 5 character revision: Simba and Elsa (Disney), Toothless and Shrek (DreamWorks) reuse the existing locally optimized `assets/images/treasures/` artwork. All original source and non-commercial/uncleared-rights restrictions recorded for the treasure section also apply here. No new asset licenses are claimed. Pointer glitter and reduced-motion support are preserved.

Benefit artwork now combines characters with original foreground props: Simba with a favorites storybook, Elsa with a present, Toothless with a shopping basket and wishlist heart, and Shrek with a conversation bubble. Props are decorative original SVGs, while the previously documented character rights restrictions remain.

### Homepage finale and footer
`stay-in-magic` follows the existing difference/benefits section, replacing the starter blog feed as the homepage ending. No newsletter plugin was installed: this is an honest visual introduction with a coming-soon notice and no email input, submission or data collection. No configured social links, contact details, published privacy or terms pages were found. Footer links resolve native shop/account pages, the published wishlist and existing category terms; privacy/terms appear automatically only when assigned and published. No contact details are fabricated. Connect a newsletter service, provide public contact/social details, and publish/assign policies before enabling those destinations.
The finale reuses the local Olaf/Puss preview assets under their previously documented non-commercial/uncleared character-rights restrictions. Glowing gifts are original SVG artwork. Shared pointer glitter, one-time viewport reveal and responsive/reduced-motion styles are included.

### Finale: unique characters and aligned container
Replaced the repeated Olaf/Puss figures with Rapunzel and a Madagascar penguin, unused elsewhere on this homepage. Local sources: Rapunzel https://pnggallery.com/rapunzel (original https://pnggallery.com/wp-content/uploads/rapunzel-01.png); penguin https://pngimg.com/image/31115 (original https://pngimg.com/uploads/madagascar_penguins/madagascar_penguins_PNG9.png). Both source pages state CC BY-NC 4.0. Trimmed transparent margins and converted to WebP; attribution appears in the section. These are local development preview assets only: underlying Disney/DreamWorks commercial rights are unverified and must be cleared or replaced before launch. The blue background stays full width while its contents now use the same 1160px centered limit as adjacent sections.

### Joy and memory orbs
Joy replaces Rapunzel in the finale, layered as an SVG image between the box back and front with an opening-shaped clip. Original CSS glowing memory-inspired orbs sit beside the present. Joy source: https://www.stickpng.com/img/cartoons/inside-out/joy ; original https://assets.stickpng.com/images/5a0c69c382e02d31ecb8d012.png . Source explicitly states personal use only and commercial usage not allowed. Trimmed and converted to WebP for local evaluation only; replace or obtain commercial permission before launch. No commercial license is claimed.

### Dimensional lighting revision
An attempted built-in image generation was rejected; no generated asset was integrated. Existing Joy and penguin source artwork remains, with all previously recorded rights restrictions. The present now has dimensional face/ribbon shading and rim highlights; memory orbs use original layered SVG glass highlights, translucent internal swirls, refraction-style edges and soft glow instead of plain CSS circles. These are illustrative effects, not actual film frames or official memory-ball assets.

### Shared WonderWish footer
Inspected and replaced the existing footer pattern referenced exclusively by `parts/footer.html`. The homepage continues to reference that template part once; no page-embedded footer was added. `assets/css/footer.css` is enqueued site-wide and in the block editor. Blue gradient, four desktop columns, mobile stacking, keyboard focus and finite/reduced-motion sparkles. Native shop, franchise filters, category, account, wishlist and cart links; current year via `wp_date`. Help repeats the supplied selected-city Libya delivery guidance. Public contact details/social accounts and published assigned policy pages are absent; no email/address/phone or fake links were added. Publish contact/delivery pages and assign Privacy/Terms when ready; the relevant existing page links are conditional.

### WooCommerce customer login design
The existing My Account shortcode/page is preserved. `woocommerce/myaccount/form-login.php` copies the installed WooCommerce template (version 9.9.0) and retains native fields, nonces, actions, registration options and handlers. Update this override when WooCommerce flags its template version. `account.css` and `account.js` load only on logged-out My Account screens. WooCommerce itself provides show/hide password and Remember me. The small theme script switches login/registration panels with ordinary anchor fallbacks; without JavaScript both forms remain available. No accounts or catalogue entries were created. Logged-in account screens and wishlist integration are unchanged.

Nextend Social Login 3.1.26 was installed from WordPress.org (200,000+ active installations, updated within three months; listed tested WordPress 7.0.7, while this site is 7.1.3). Local installation/rendering passed, but full Google flow cannot be verified without credentials. Google remains disabled. The theme uses the documented free Google shortcode only when `isProviderEnabled('google')` is true; no fake or disabled sign-in button. Nextend Pro offers automatic WooCommerce placement; this override uses the public shortcode instead and does not claim Pro features.

Configure under **Settings → Nextend Social Login → Google**: create a Google Cloud OAuth Web application, configure the consent screen and test users as required, then enter Client ID and Client Secret directly in the dashboard. Register the exact redirect URL shown by the plugin: currently `http://localhost:8889/wp-login.php?loginSocial=google`. Use the final HTTPS production callback when deploying; a localhost callback is only for development. Verify configuration in Nextend, then enable Google. Do not put secrets in theme files or chat. Verify customer roles/account linking, first-time registration and return-to-account behavior before launch. Documentation: https://social-login.nextendweb.com/documentation/providers/google/ and https://social-login.nextendweb.com/documentation/getting-started/usage/ .

Authentication artwork: flying Toothless from https://freepngimg.com/png/167588-flying-toothless-download-hd (original https://freepngimg.com/thumb/toothless/167588-flying-toothless-download-hd.png), contributor Gordon Scott, source states CC BY-NC 4.0. Light Fury from https://www.pngaaa.com/detail/1394176 (original obtained via https://www.pngaaa.com/api-download/1394176), source states Non-commercial Use. Transparent margins trimmed and optimized to local WebP files in `assets/images/account/`; checkerboard preview was rejected in favor of the actual alpha PNG. Cloud/sky/sparkle effects are original CSS. These character assets are for local evaluation only; underlying DreamWorks commercial rights are not verified. Clear or replace before launch.

Verification: browser guest view, native empty-login error, password visibility toggle, Remember me checked state, registration panel and recovery destination, login/registration nonces, desktop and 390px no-overflow layout and loaded alpha assets. No successful customer login, new registration, recovery email delivery or Google OAuth round trip was performed. Existing WooCommerce registration privacy text links to draft Privacy Policy page ID 3: publish/assign approved policy before launch. No legal or email settings were changed.

Login sky refinement: the aggressive open-mouth Toothless cutout is replaced with the existing closed-mouth flying render from the documented treasure assets, copied to `assets/images/account/toothless-gentle.webp`. An alternative PNGimg gliding render (https://pngimg.com/image/84901, CC BY-NC 4.0 stated) was inspected but rejected because its expression still looked aggressive; it is not bundled. Full-page fixed sky gradient and transparent header styles are scoped to `.ww-auth-page` only. Header links remain white with a dark blue mobile menu overlay. Logged-in account and all other site headers are unaffected. Existing preview-only character rights restrictions remain.

Final login Toothless choice: softer closed-mouth, large-eyed illustrated pose from https://pnggallery.com/toothless/ (variant 03, original https://pnggallery.com/wp-content/uploads/toothless-03.png), source states CC BY-NC 4.0, credit PNG Gallery. Converted/trimmed to `assets/images/account/toothless-soft.webp`. This replaces the intermediate treasure cutout in the login page only. Commercial character/artwork rights remain unverified; local preview only.

Login revision: replaced the 2D Toothless illustration with the cinematic gliding PNGimg render (https://pngimg.com/image/84901; original https://pngimg.com/uploads/night_fury/night_fury_PNG54.png), source CC BY-NC 4.0, resized to `assets/images/account/toothless-cinematic.webp`. This pose matches the 3D Light Fury style. Still local preview only pending commercial character clearance. Card width increased from 430px to 510px. Each native login/registration panel now has its own Google option and email divider. While the Google provider is disabled, an explicitly disabled button explains that email must be used; it never initiates fake OAuth. When credentials are verified and Google enabled in Nextend, both panels render the plugin’s real shortcode instead.

Smiling login Toothless: selected a rounded-eye, closed-mouth-smile 3D pose after visually comparing the source gallery. Source https://freepngimg.com/png/167996-toothless-free-transparent-image-hd , contributor Gertrude Woods; original https://freepngimg.com/thumb/toothless/167996-toothless-free-transparent-image-hd.png . Source states CC BY-NC 4.0 and requests credit to FreePNGimg. Transparent margins trimmed and converted to `assets/images/account/toothless-smiling.webp`. This replaces the stern gliding render; all non-commercial/local-preview and underlying character-rights restrictions still apply.

User-selected login pose: supplied `/Users/amira/Downloads/download (14).png` has a fully opaque gray background. The same pose already exists as the clean transparent treasure asset, so its alpha version is reused as `assets/images/account/toothless-user-pose.webp`, mirrored toward the form with CSS `scale: -1 1`. No gray-background image was added to the page and no image-generation edit was needed. Existing source/rights notes for the treasure Toothless apply; no new license is asserted.

Login polish: smaller mirrored Toothless for a distant effect; Google option moved below the native Log in submit button. The login stage now reuses the shared bounded pointer-glitter script with existing touch and reduced-motion guards. Google remains honestly disabled until OAuth is verified; registration retains both options.

### Logged-in WooCommerce customer dashboard
`woocommerce/myaccount/dashboard.php` (upstream template version 4.4.0) replaces only the native dashboard intro. `assets/css/dashboard.css` and the shared pointer glitter load only for signed-in My Account pages. Guest login and homepage styles are unchanged. Personalized heading prefers the current user's first name, then display name, escaped at output. Native navigation and extension hooks remain; cards use WooCommerce endpoint URLs and nonce-protected logout. Wishlist is resolved by TI's `tinv_url_wishlist_default()` rather than a separate list/account system.

Recent orders use `wc_get_orders` filtered strictly to `get_current_user_id()`, five latest recognized-status orders, with a second customer ownership check before output. Status labels, stored-currency totals, dates and view URLs come directly from each WooCommerce order. No fake orders or customer records are created. The current admin account has no orders: the real empty state and native Orders destination were verified. A populated order table was not verified because no existing orders were available; logout URL was verified as native/nonce-bearing without logging out the user's admin session. Addresses, Account Details and TI Wishlist links were opened successfully. Desktop/mobile no-overflow, character loading and active glitter verified; no console errors observed. Reduced-motion rules disable float/twinkle and the shared glitter respects touch/reduced-motion.

Dumbo preview artwork: https://www.stickpng.com/img/cartoons/dumbo/dumbo-with-yellow-hat ; original https://assets.stickpng.com/images/59cfcd4fd3b1936210a5ddee.png . Source explicitly permits personal use only, excludes commercial usage and reserves character rights. Trimmed transparent margins and converted to local `assets/images/account/dumbo.webp`; on-page source credit included. This is local development artwork only: obtain commercial permission or replace before launch. Sky styling and navigation SVGs are theme-original. No new plugin or account/authentication system added.

### Cards-only navigation and native inner account pages
`woocommerce/myaccount/navigation.php` (upstream 9.3.0) retains the before/after navigation hooks but replaces the tab list with the shared `wonderwish-cards.php` on endpoints. Dashboard renders the shared cards once in its content. Active Orders/Addresses/Details/Wishlist cards have `aria-current=page`; inner pages have a dashboard return link. Logout remains WooCommerce's nonce-protected action, with no artificial logout page.

The `woocommerce_account_content` hooks wrap native endpoint output in a heading and styled panel. Orders, view-order, address editor, account form and downloads use native handlers/permissions/data. The existing TI wishlist page is detected from its configured page ID, wrapped through the main content filter, and styled without replacing its list storage or template behavior. Guest wishlist storage remains supported by the existing plugin. No forms were submitted and no address/account settings, orders or wishlist items were written.

Logged-in account and standalone wishlist pages now use a fixed viewport-sized, pointer-transparent glitter canvas attached to the body; its event scope covers header, content and footer. Shared particle pool remains bounded with existing fine-pointer, reduced-motion and page-visibility guards. No extra glitter layer is created inside the dashboard. Homepage/guest login keep their previous independent scopes.

Verified: no default tab list, five shortcut cards, active states, native Orders empty state, TI Wishlist empty state, Addresses screen and billing form, Account Details form and nonce, full-page glitter activity, desktop/mobile layout and no console errors. Populated order/view-order and populated wishlist states remain unverified because the account has no such data. Styling covers their native tables but no fake records were created.

Inner-page heading characters: Orders—Po; Wishlist—Stitch; Addresses (including editors)—Simba; Account Details—Elsa; Order Details—Mickey; Downloads—Shrek. Dashboard keeps Dumbo. Each uses the existing local treasure asset and the same previously documented source/non-commercial/uncleared-rights restrictions. Decorative images have empty alt text, fixed dimensions and reduced-motion support. Logout remains a native action rather than a fabricated page. No account data or endpoint behavior changed.

### Revised inner-page characters (no homepage reuse)
Replaced the previous Po/Stitch/Simba/Elsa heading set: Orders and its order-detail view use Tigress; Wishlist uses Genie; Addresses and its editors use Tinker Bell; Account Details uses Baymax. Downloads uses Genie. Dashboard remains Dumbo. Artwork is trimmed by alpha bounds, resized down to at most 600px and encoded as transparent WebP under `assets/images/account/`. No homepage artwork or functionality changed.

Source credit: PNG Gallery, https://pnggallery.com/genie/ (genie-01.png), https://pnggallery.com/tinker-bell/ (tinker-bell-01.png), https://pnggallery.com/baymax/ (baymax-02.png); originals at https://pnggallery.com/wp-content/uploads/ followed by each filename. Source pages state CC BY-NC 4.0 and request PNG Gallery attribution. Tigress: FreePNGimg, https://freepngimg.com/png/14892-kung-fu-panda-tiger-png ; original https://freepngimg.com/download/kung_fu_panda/2-2-kung-fu-panda-tiger-png.png ; source states CC BY-NC 4.0, credit FreePNGimg. Retrieved 2026-10-21. These third-party statements do not establish Disney/DreamWorks commercial permission. Local development preview only: clear rights or replace these assets before commercial launch.

Wishlist/Addresses pose revision: compared three additional poses per character and selected PNG Gallery genie-04.png (smooth shaded smiling pose with welcoming hands) and tinker-bell-02.png (full winged standing pose). Originals: https://pnggallery.com/wp-content/uploads/genie-04.png and https://pnggallery.com/wp-content/uploads/tinker-bell-02.png . Source galleries and CC BY-NC 4.0/non-commercial limitations above still apply, credit PNG Gallery. Trimmed alpha margins, downscaled only, encoded to genie-welcome.webp and tinker-bell-wings.webp. These replace only Wishlist/Addresses images; commercial rights remain unverified.

### Native Shop and collection archives
The child theme now provides `archive-product.html`, `taxonomy-product_cat.html`, `taxonomy-product_attribute.html` and `product-search-results.html`. They use the editable `fantasy-theme/shop-intro` Gutenberg pattern and WooCommerce's own `woocommerce/legacy-template` catalogue block, retaining upstream loop templates, native sorting, pagination, product links and notices. No copied product-loop PHP template or separate product store was added. Presentation hooks and the gated preview live in `inc/shop.php`; styles are scoped to `ww-shop-page` in `assets/css/shop.css`. Shared pointer glitter adds only the shop-body scope. Existing homepage, account templates, footer, product records and store settings are unchanged.

The normal Shop displays published products only and currently has a deliberate empty state. **While logged in as administrator on localhost, open Shop and click “Preview draft catalogue →”.** This includes drafts in the native main WooCommerce query only for that explicit request. Preview requires the local WordPress environment, loopback configured site hostname, management/edit-others capabilities and a valid user nonce. The flag is preserved across catalogue category/world links, search, ordering and pagination. Nonces expire; return to the regular Shop to generate a fresh preview link. Public links and product statuses are not changed. No draft is published or made purchasable. Preview responses use no-cache and noindex/nofollow; draft cards open WordPress's normal permission-checked preview links. Draft-only cart/wishlist actions are not offered by the catalogue preview. Native TI controls remain available for ordinary published product cards.

Category chips use the existing product_cat archives and preserve the selected franchise. World links use WooCommerce's existing `filter_franchise` query, including the existing homepage collection URLs. Product search is native WordPress product search; descriptions may produce broader character matches than product names. Ordering and pagination are native WooCommerce. Twelve cards per page, 4/3/2 responsive columns. Empty searches have a clear reset link; no filler products are shown.

Heading characters: Shop—Donald Duck; Accessories—Marie; Plush Toys—Bambi with friends; Collectibles—WALL·E; Gift Sets—Belle; Disney—Tiana; DreamWorks—Master Shifu. None reuses homepage/account artwork. Source credit **PNG Gallery**, downloaded 21 October 2026. Each source page states **CC BY-NC 4.0** and requests attribution; this does not establish Disney/DreamWorks commercial rights. These assets are local design previews only: clear or replace before commercial launch. Transparent bounds were trimmed, resized down to at most 650px and encoded as WebP. Sources:
- donald-duck: https://pnggallery.com/donald-duck/ ; original https://pnggallery.com/wp-content/uploads/donald-duck-01.png
- marie: https://pnggallery.com/marie/ ; original https://pnggallery.com/wp-content/uploads/marie-01.png
- bambi: https://pnggallery.com/bambi/ ; original https://pnggallery.com/wp-content/uploads/bambi-01.png
- wall-e: https://pnggallery.com/wall-e/ ; original https://pnggallery.com/wp-content/uploads/wall-e-01.png
- belle: https://pnggallery.com/belle/ ; original https://pnggallery.com/wp-content/uploads/belle-01.png
- tiana: https://pnggallery.com/tiana/ ; original https://pnggallery.com/wp-content/uploads/tiana-01.png
- master-shifu: https://pnggallery.com/master-shifu/ ; original https://pnggallery.com/wp-content/uploads/master-shifu-01.png

Verification: regular Shop has zero product cards; authorized preview shows 12 of 18 and native page 2 shows 6. Category totals 4 Accessories / 6 Plush Toys / 4 Collectibles / 4 Gift Sets. Disney returns 8, DreamWorks 10; Disney + Accessories returns 2. Native price ascending produced 70, 80, 130, 145, 160, 195, 200, 200, 200, 280 within DreamWorks. Native Toothless keyword search returned three matching descriptions/titles; unmatched search returned zero with recovery link. All seven hero assets loaded. Native draft product link opened its actual product preview and remained unavailable for purchase. Invalid nonce returned zero cards; a guest following a valid administrator preview URL saw the existing Coming Soon screen with no product data. Separate authorization readback rejected guest and invalid nonce.

Desktop and 390px mobile: no horizontal overflow, one h1 and one main landmark, labeled search, current-filter states, keyboard focus styling and native mobile menu open/close verified. Full-page pointer glitter activity verified. CSS and shared script include reduced-motion/fine-pointer guards; ambient hero animations finish within five seconds. Console had no errors. All 18 products remain drafts, zero published; comparison against the existing settings/page snapshot found no changes. Existing Coming Soon mode remains enabled and blocks guest storefront access; it was not disabled for testing. Published-product purchase behavior was not exercised because there are no published products.

### Shop refinement and user-authorized local product publication
All 18 catalogue proposals were published locally at the user’s request. The original draft notes were archived into `_ww_catalogue_editorial_notes` and `docs/initial-catalogue/before-local-publication.json`, then removed from visible product descriptions. Prices and inventory values were preserved. Coming Soon remains enabled; this is not commercial launch or clearance of asset rights. The existing private-preview feature is retained for future drafts but shows no notice when none exist. Removed per-card draft badges and the visible “Pick your world” label. Native pagination arguments now provide Previous/Next labels; CSS styles only direct page controls, avoiding nested-span/screen-reader styling. Product images use full originals, responsive sizes and padded contain frames.

Replaced heading art with PNG Gallery variants: Donald Duck 02, Marie 03, Bambi 02, WALL·E 03, Belle 02, Tiana 02 and Master Shifu 02. Each is downscaled only, centered on an 800px transparent canvas with safe margins, saved as `assets/images/shop/*-catalogue.webp`. Exact original URLs and source pages are in `docs/shop-preview/character-sources.json`. Source-stated CC BY-NC 4.0 and all unresolved commercial character rights still apply. Catalogue references: Disney Store plush collection and Shop Universal Shrek collection, reviewed 21 October 2026. No external storefront code copied.

### Franchise logo filters and woodland character revision — 22 October 2026
Replaced the plain Disney/DreamWorks filter links with logo selection tiles using the theme’s existing local SVG logos. Links retain native WooCommerce filter_franchise behavior and current category context; selected tiles have aria-current plus a visible border/check, and logo alt text supplies accessible link names. “All worlds” remains a reset. No catalogue data or settings changed.

Plush Toys now uses classic standing Bambi (PNG Gallery bambi-04.png), and Collectibles replaces WALL·E with seated Thumper (PNG Gallery thumper-03.png). Thumper source page https://pnggallery.com/thumper/ states CC BY-NC 4.0 and requests PNG Gallery credit, as does the existing Bambi source. Both were compared against alternative poses, trimmed, downscaled only and safely centered on transparent 800px canvases. Commercial character/artwork permissions remain unverified; clear or replace before launch. Current exact sources are in docs/shop-preview/character-sources.json. Existing logo provenance/rights restrictions remain unchanged.

### Princess artwork replacement and unused image cleanup — 22 October 2026
Disney now uses Tiana variant 05, with a clean lily gown pose; Gift Sets uses Belle variant 04 reading a book. Sources: https://pnggallery.com/wp-content/uploads/tiana-05.png and https://pnggallery.com/wp-content/uploads/belle-04.png, galleries https://pnggallery.com/tiana/ and https://pnggallery.com/belle/ . Source-stated CC BY-NC 4.0; credit PNG Gallery. Rights remain unresolved for commercial launch. Both are centered on transparent padded canvases and optimized as tiana-lily-catalogue.webp and belle-storybook-catalogue.webp.

Removed 26 unused alternate image files (2,189,709 bytes) after checking literal theme references, dynamic PHP character maps, JS-derived animated URLs and saved WordPress content/theme/widget references. Retained 32 referenced image assets, including HQ hover animation pairs, native-account artwork and homepage fallbacks. Product media in WordPress uploads was left intact. Cleanup inventory: docs/shop-preview/asset-cleanup-2026-10-22.json. Historical README entries describe earlier choices; deleted alternatives are no longer runtime assets.

## Native single-product design and English LYD display (2026-10-22)

`templates/single-product.html` uses Gutenberg navigation and WooCommerce's native single-product legacy block. `inc/product.php` and `assets/css/product.css` provide presentation, real franchise/character metadata and native gallery/lightbox support. Purchasing, stock decisions, variations, grouped/external product actions, tabs, reviews and related products remain with WooCommerce. No duplicated plugin PHP templates. The shared glitter now covers the product page and retains reduced-motion/touch protection.

WooCommerce's default LYD symbol is Arabic even for English. English requests now receive `LYD` and native left-space positioning through read-time filters; Store API cart/checkout metadata uses the same values. Numeric prices, separators, precision and persisted settings remain unchanged. Arabic requests retain the original symbol/position. Gift finder dynamic prices use English currency-code display for LYD. These formatting filters live in this theme and stop applying when switching themes.

Verification and changed-file inventory: `docs/product-preview/verification.md` at the project root. Actual catalogue inspection found 18 published simple/out-of-stock products and zero drafts; no statuses or inventory were changed. Use native signed-in WordPress Preview for future drafts. No fake purchase controls are displayed on out-of-stock products and no real transaction was performed.

### Product/card refinements inspired by LNC (2026-10-22)

Reference reviewed: https://lncstore.ly/shop/ and https://lncstore.ly/product/allmax-creatine-hcl/ (layout only; no source assets copied). Product summary is now a compact light bordered panel. Removed native summary SKU/category/tag metadata and the theme's duplicate franchise/character summary fields. Original data and native Additional information tab remain intact. `inc/product.php` now disables hover zoom at priority 100 because WooCommerce's legacy block re-enables it at priority 10. Clicking the gallery still opens its native PhotoSwipe lightbox.

`assets/css/commerce-ui.css` styles TI Wishlist's existing buttons: a readable single-product pill and 44px corner hearts on catalogue/related cards. State/storage/actions stay with TI. Native loop purchase actions are restored in `inc/shop.php`: purchasable simple products use WooCommerce AJAX Add to cart; variants use Select options; out-of-stock products use Read more. No stock or visibility changes.

`assets/js/commerce-ui.js` animates a cart icon and small sparkle trail toward the cart after a successful native AJAX event, or after a normal product-form POST and matching server-generated success notice. It never writes a cart or fabricates counts. No animation runs for failed/unconfirmed/expired submissions, hidden documents or reduced motion. Session storage is optional and contains only product ID, timestamp and button coordinates for up to 30 seconds. No autoplay. Current redirect-after-add setting is no; redirect-to-cart workflows were not tested.

Verification: desktop/mobile product and shop layouts show no overflow or broken images; image click opens native lightbox with zero hover zoom images. Real signed-in TI Wishlist add succeeded and the test item was removed afterward. Native notice sanitization preserves the success marker. Eight isolated JS guard tests cover missing/mismatched/expired confirmation, reduced motion and valid/invalid native AJAX events; syntax check passes. All 18 products remain published/out of stock as found, so no real cart addition or populated checkout was attempted. Cart-flight appearance in a real successful purchase flow remains unverified until actual purchasable inventory is supplied. No extra plugins, settings or homepage content changed.

### Active stock and shopping polish (2026-10-22)

At the user's explicit request, all 18 existing WooCommerce products now manage stock with quantity 15 and status in stock. Native product CRUD was used; prices, publication statuses, backorders and other store settings were preserved. Previous inventory/wishlist values are backed up in `docs/product-preview/before-stock-15.json`. Fresh verification found 18 products, zero stock mismatches and unchanged publication count.

TI Wishlist → General Settings now has native "Remove product from Wishlist on the second click" enabled, and add-to-wishlist redirection disabled. Existing default Remove from Wishlist texts are used. `commerce-ui.js` follows TI's real state classes to synchronize accessible labels/pressed state; it does not implement wishlist storage or actions. Single-page add/remove labels and second-click removal were verified, restoring the original saved item afterward.

`commerce-ui.css` reduces product titles to 34px desktop / 26px mobile, increases card/image padding, adds subtle static button sparkles, and reserves a compact View cart link space so AJAX additions do not shift card buttons. The native Add to cart controls now replace Read more because inventory is available. Rechecked LNC's live product purchase layout as reference; WonderWish colors and identity retained.

Live tests: product-form POST added Po to the real native cart, and the native block cart displayed LYD 80.00. Catalogue AJAX added the Anna/Elsa ornament, with a real cart-flight sprite observed after native confirmation. Both temporary cart items were removed; cart confirmed empty afterward. No order or checkout submission, stock deduction, payment or publication changes occurred. All 18 quantities remain 15. Desktop/mobile no overflow; no console errors observed. Reduced-motion suppression remains intact. Updated preview: `docs/product-preview/product-stock-and-cart.png`.

### Recording-based control corrections (2026-10-22)

Inspected the user's 8-second LNC recording locally. The decorative cart motion now travels from the start to the right end *inside its own button*, with small blue/white sparkles, on hover/focus and native confirmed additions. It no longer flies toward the header. Reduced motion suppresses the animation; native validation and cart writes remain unchanged. Native catalogue View cart links are removed after AJAX success and hidden defensively; native add-to-cart notices retain confirmation text without their View cart action.

English currency position now reads `right_space`, producing `200.00 LYD` in PHP and Store API metadata (empty prefix, ` LYD` suffix). Gift finder dynamic English prices match. Arabic symbol/position remain unchanged; numeric prices and precision unchanged.

WooCommerce → Settings → Products → Inventory → Stock display format is now native `no_amount` (Never show quantity remaining in stock). Users see In stock, not a count; saved quantities remain 15. Product reviews tab and rating widgets/sorting are removed from presentation only; stored review data and backend review settings are untouched.

The native TI Wishlist toggle is relocated from inside the cart form to a stable summary row via existing hooks; only one button renders. Fixed 222×46px footprint prevents shifts between Add and Remove labels. Real removal/re-add restored the original saved product; relative summary position and button dimensions were identical before/after. No new wishlist storage or network implementation.

Native quantity fields now have accessible minus/plus buttons, using the field's own min/max/step and retaining manual entry. Verified 1→2→1, disabled decrease at 1, disabled increase at 15, and no increase above 15; variation limit attribute changes are observed. Native styles required an explicit horizontal flex override. Desktop/mobile no overflow and no duplicated wishlist. Animation sprite bounds verified within the actual button. No cart writes in this correction pass; existing customer cart left untouched. Native success-message filtering and currency metadata checked independently without creating orders or adding items.

Current screenshot: `docs/product-preview/controls-corrected.png`. This entry supersedes earlier currency-prefix/header-flight documentation.

### Plain controls and wishlist state (2026-10-22)

Removed all custom cart animation code, pending-cart storage and animation confirmation markers. Purchase buttons now use a static blue background and cart icon. Removed the in-stock label from product presentation; actual inventory and out-of-stock protection remain unchanged. Quantity has separate 40×40px circular minus/plus borders, no outer oval.

Wishlist unsaved state has a neutral outline heart and Add to Wishlist; real TI saved state has a filled blue heart and Remove from Wishlist. Existing saved memberships remain accurate across reloads. TI's native show_notice=true verified, simple_flow=true and redirect=false retained. Verified native card addition alert (Light Fury Character Pin added to Default wishlist), blue heart, removal state and real removal; verified single-product toggle too. Temporary membership restored to its original unsaved state; existing saved products were not reset.

New global `assets/css/site-ui.css`, enqueued in functions.php, suppresses mouse-click/programmatic focus outlines while retaining keyboard focus-visible styling. Native mini-cart badge now overrides conflicting white-on-white inline colors with dark blue text on white. Actual count remains supplied by WooCommerce. Verified circular geometry, mouse outline none, keyboard outline solid, zero custom animation elements, hidden in-stock text, readable real badge count, no overflow. Current user cart left untouched.

Current preview: docs/product-preview/plain-controls.png. This entry supersedes all previous button-motion documentation.

## Remaining store pages (2026-10-22)

Cart and Checkout now use dedicated theme templates around their existing native Gutenberg/WooCommerce page content. A shared page shell covers regular pages, keeps existing Account/Wishlist inner designs, and supplies WonderWish navigation, blue headings, original CSS gift decoration, light content panels and the existing guarded pointer glitter. Added matching native WordPress search/empty results and 404 templates. Order confirmation retains WooCommerce's installed native block structure, with shared chrome; no fake order or submission was used to verify it.

All page content, draft policies, products, inventory, cart items, legal details, payment and shipping settings remain as found. Checkout currently reports no available payment methods; styling preserves that notice. Privacy and Returns policies remain drafts with their existing sample content and need owner review before publication. Sample Page content is unchanged.

Detailed changed-file inventory and verification limits: project-root `docs/store-pages/verification.md`. No custom cart/checkout engine, no plugins or new third-party artwork. Mobile native cart layout was corrected so line totals do not overlap product details. Buttons remain static; keyboard focus, screen-reader labels, native errors and responsive form controls are preserved.

### Page header and mini-cart refinement — 22 October 2026
Cart, Checkout and generic page banners now share one continuous blue sky with a transparent navigation overlay. Cart uses the existing Marie cutout, Checkout Donald Duck, and generic/search/error titles Thumper. Images use `object-fit: contain`, declared dimensions, decorative empty alt text, and responsive sizing. These existing local-preview assets retain their previously documented unverified commercial permissions; no new asset license is asserted. Account headers are transparent over their existing light sky.

The native WooCommerce mini-cart drawer has matching blue buttons, circular quantity controls, contained product images and less verbose item rows. Its native data, close control, totals, links and keyboard behavior remain intact. No custom cart event handlers were added.

LNC checkout was inspected at https://lncstore.ly/checkout/ with one temporary reference cart item (no order submitted). It offers COD, Local Bank Card, Adfali, Sadad, T-lync and LYpay, OTP sign-in, a Tripoli/Tajoura selector and its own policy consents. Those are merchant-specific integrations/policies, not transferable theme details. WonderWish's installed BACS, cheque and COD gateways remain disabled. Native required names, email, street and city and optional phone/apartment already correspond broadly; native state/postcode requirements are preserved rather than bypassing address validation. Merchant setup, delivery rules and approved legal pages remain prerequisites for payment launch. No checkout/account/legal settings were changed.

### Cart/checkout correction — 22 October 2026
Supersedes the repeated Marie/Donald/Thumper page-intro assignments above. Cart now uses **Winnie the Pooh**, Checkout **Remy**; neither appears in another theme illustration. Generic page introductions no longer repeat a character. Existing artwork in other sections is unchanged.

New local-preview sources (downloaded unchanged; contained in CSS, no hotlink):
- `assets/images/checkout/pooh-cart.png`: PNG Gallery, https://pnggallery.com/winnie-the-pooh, https://cdn.pnggallery.com/wp-content/uploads/winnie-the-pooh-01.png (1000×1000, ~200 KB).
- `assets/images/checkout/remy-checkout.png`: PNG Gallery, https://pnggallery.com/ratatouille, https://cdn.pnggallery.com/wp-content/uploads/ratatouille-02.png (1000×1000, ~328 KB).
Both source pages state **CC BY-NC 4.0** (https://creativecommons.org/licenses/by-nc/4.0/). Attribution: PNG Gallery, source links above. This permits no commercial launch; uploader authority over Disney/Pixar character rights is unverified. Clear or replace before commercial deployment. No commercial permission is claimed.

Drawer refinement: compact two-column item layout, no squeezed third price column, gradient title strip, matching static buttons, bounded responsive width and circular native quantity buttons. Checkout refinement: address row spacing, contained summary images, legible quantity badges and removal of padding on truly empty native fee/discount rows. Native validation, subtotal/total calculations, fees when present, payment availability and checkout submission remain WooCommerce-owned. No payment, shipping, policy, product or account settings changed.

### Requested checkout behavior — 22 October 2026
- Desktop summary now sticks within the height of the entire checkout section, stopping at its bottom; mobile remains in normal flow.
- A Libya-only `woocommerce_get_country_locale` filter marks postcode hidden and not required, covering native checkout UI and country-aware server validation. No CSS-only validation bypass.
- Native Cash on Delivery enabled, all other installed gateways remain disabled. Description/instructions explicitly ask customers to confirm delivery availability and any delivery charge before ordering. No shipping rates/zones, prices or fees were created. Manage via **WooCommerce → Settings → Payments → Cash on delivery**. Gateway allows the current checkout without requiring a selected shipping-method restriction; shipping remains separately unresolved.
- The installed native Order Note block has no always-expanded setting. `assets/js/checkout.js` progressively expands its real checkbox once, hides that toggle only after the native textarea appears, and adds an associated **Order notes (optional)** label. Native WooCommerce state and order-note saving remain responsible for the value; no additional checkout field or duplicate order data. Without JavaScript the native checkbox flow remains available.
- Verified saved COD `enabled=yes`, BACS/cheque `no`; Libya postcode `hidden=true, required=false`; visible optional notes accepts edits. Sticky position measured at 56px under admin toolbar during middle scroll, and summary bottom equals full section bottom at the end. No order submitted or payment collected.

### Homepage and secondary commerce audit — 22 October 2026
The `Little Treasures` homepage pattern's published-product branch emitted a literal `[products …]` shortcode from the block template. Replaced that fragment with `wc_get_products()`-backed cards using actual published catalogue items, native image/price output, product links and category links. No products were published or edited. Existing curved motion, per-card hover pause, keyboard focus behavior, manual pause/resume and the static mobile/reduced-motion grid are reused. The selection alternates available Disney/DreamWorks groups, up to eight gifts; private drafts are excluded.

Reviewed populated cart/coupon panel, checkout saved-address edit and expanded fields/coupon panel, native COD, optional notes, account Orders empty state, billing-address editor, guest recovery, and guest empty cart. Added missing styling for recovery/reset cards and buttons, header contrast on guest account pages, address-edit actions, empty-cart native recommendations and wishlist controls. Added scoped native pay-for-order/order-confirmation styles, including tables, summary cards, addresses and buttons; these later screens could not be tested with a real completed order because none exists. No order was created, no password reset email sent, no address/account data saved, and no payment/shipping settings changed.

### Stock-reservation error and native pay form — 24 October 2026
The Mickey bag charm has stock 15 in both product metadata and the WooCommerce lookup table, with no real reservation rows. The reported shortage was reproduced by invoking WooCommerce's actual reservation query against a connection-local temporary table: SQLite Integration 3.0.2 failed to translate `( NOW() + INTERVAL n MINUTE )` inside the INSERT/SELECT reservation query.

`inc/checkout-compat.php` applies a narrowly scoped WordPress `query` filter only when `DB_ENGINE=sqlite` and only to WooCommerce's reservation INSERT/upsert. It rewrites the expiry expression to the semantically equivalent `DATE_ADD( NOW(), INTERVAL n MINUTE )`, which the installed SQLite translator supports. It leaves quantity predicates, locks, upsert behavior and duration intact. No core/plugin files modified; no stock bypass. It does nothing on MySQL. Recheck/remove this workaround when the SQLite translator handles interval arithmetic correctly.

Verification used the real WooCommerce private reservation method with the installed theme filter and a redirected TEMP table: product 26 quantity 1 succeeds, repeat reservation succeeds, product 59 quantity 2 succeeds, quantity 16 of product 26 fails as expected (stock 15). TEMP table dropped. Real product quantities, reservations, order status and order data remained unchanged; no checkout submitted.

The second screenshot was `checkout/form-pay.php`: its native form is `#order_review`, not `.woocommerce-form-pay`. Correct selectors now style its card/table, COD panel/description and submit button. Visually checked using a temporary read-only rendering of the native template with existing draft #69 data; all controls disabled and hidden submission inputs removed. The temporary HTML was removed after screenshots. No payable order was created; full payment completion remains untested.


## 24 October 2026 — shared navigation, empty states and gift finder

- One Gutenberg `site-navigation` pattern is used by the homepage, shop and product/page headers. Native navigation, search and WooCommerce mini-cart are retained; cart/checkout show a cart link because WooCommerce deliberately hides its mini-cart there. Mobile modal contrast, alignment and stacking are scoped to the open menu.
- Frontend document titles use WonderWish plus the current page/endpoint; the database site name and business settings are unchanged.
- Empty cart uses Sadness; search uses Judy Hopps; 404 uses Cheshire Cat. Product-card hearts have fixed dimensions and centered outline/filled masks using TI Wishlist's actual saved-state class. Its real add/remove notification is styled.
- Homepage product photos are preserved, with consistent white photo panels, contained proportions and tinted information panels. No product photograph was digitally cut out or misrepresented.
- Gift finder queries actual published Store API products. Recipient/occasion filtering is applied only when both selected native product tags exist and have products. Otherwise the interface explicitly returns general suggestions from the selected Franchise, without claiming age/occasion suitability. Add verified `gift-for-kids`, `gift-for-friends`, `gift-for-family`, `gift-for-myself` and `gift-occasion-birthday`, `gift-occasion-celebration`, `gift-occasion-just-because` tags via Products → Tags/individual products for precise matching.

### New local-preview character sources (commercial clearance required)

These original downloaded transparent PNGs are stored in `assets/images/states/`. No claim of commercial permission is made. They must be licensed or replaced before commercial launch.

| File | Source and stated terms |
| --- | --- |
| sadness.png | [YoPriceVille: Sadness Inside Out](https://gallery.yopriceville.com/Free-Clipart-Pictures/Cartoons-PNG/Sadness_Inside_Out_PNG_Clip-Art_Image), 874×1118. Page describes personal/design projects; no verified commercial authorization. Disney/Pixar character rights remain with their owners. |
| cheshire-cat.png | [PNG Gallery: Cheshire Cat](https://pnggallery.com/cheshire-cat/), image cheshire-cat-02.png, 1000×1000. PNG Gallery states CC BY-NC 4.0. Credit: PNG Gallery. Noncommercial restriction; this does not clear Disney character rights. |
| judy-hopps.png | [PNG Gallery: Judy Hopps](https://pnggallery.com/judy-hopps/), image judy-hopps-03.png, 1000×1000. PNG Gallery states CC BY-NC 4.0. Credit: PNG Gallery. Noncommercial restriction; this does not clear Disney character rights. |

[CC BY-NC 4.0 terms](https://creativecommons.org/licenses/by-nc/4.0/). Files are unchanged; CSS scales them for display. See project `docs/store-pages/verification.md` and `final-audit-2026-10-24.json` for tested routes and limitations.


## Homepage polish and original logo — 24 October 2026
- Original local SVG wordmark: `assets/images/brand/wonderwish-logo.svg`. Inspired by the supplied WonderWish reference; the arc ends in an original ribboned gift, with a small sparkle. Native SVG geometry and system Georgia/serif text; no third-party logo artwork or font downloads. Shared header/footer use the same asset, white on blue and blue on light account screens.
- Hero buttons use pill radii. Desktop stream cards are 300px (previously 240px), spacing 330px minimum and stage 590px; blue category badges have their own clear space above contained photographs. Collection CTA uses WonderWish blue.
- Gift finder removes the numeric success message, focuses the result heading and scrolls to the actual results with an offset. Reduced-motion uses immediate navigation. Failure/empty messages remain available.
- Finale observes the illustration entering the viewport, lifts the SVG lid, reveals Joy from within the box, and fades in memory orbs. No-script/reduced-motion shows the open illustration immediately. Lid bounds are kept inside the section; existing artwork/source restrictions are unchanged.
- Browser verification: desktop and 390px mobile; both franchises return real products, no numeric success message, result navigation works, round hero controls confirmed, mobile static product grid retained, opened lid within section bounds, no horizontal overflow. No products/store settings changed.


## Supplied magical-star logo replacement
The supplied `WonderWish Magical Star Logo.png` was processed with built-in imagegen using: “Remove only the solid blue background; preserve WonderWish lettering, white/icy-blue color, curved trail and all stars; real transparent alpha; tightly frame with a small safety margin.” Selected output is `assets/images/brand/wonderwish-magical-logo.png`. Header/footer now use this asset at 185px/205px desktop, 157px mobile (140px narrow). A blue CSS tint provides contrast on the light account header. Previous gift SVG is retained as an unused source alternative. No other page content/settings changed.

## Homepage editing and icon polish
Home is the native `home` template (title: Blog Home), because Reading is set to latest posts and page_on_front is 0. Edit via Appearance → Editor → Design → Templates → Blog Home, rather than Pages. Product data remains in Products; custom HTML/SVG decorations and script behavior are theme-managed.
Lid moved left/up to clear Joy; mobile lid reduced to remain within section bounds. Product category badges are white with blue outlines. Po's top three source-edge pixels are clipped for the animation without hiding the character. Logo width is 210px header/225px footer, 172px mobile and 148px narrow.
Native Site Icon attachment 73 is set through WordPress `site_icon`; replace via Settings → General → Site Icon. Asset: `assets/images/brand/wonderwish-site-icon.png`. Built-in imagegen prompt: “Square favicon derived from supplied logo's white icy-blue four-point star and short curved sparkle trail, no text, large centered star, transparent background.” Desktop favicon link output verified. Opened mobile lid bounds: left27px/right135px within375px content; no horizontal overflow. Po animated source and inset edge treatment visually verified.

## Home is now a native editable Page (supersedes Blog Home instructions)
Home page ID 78 is published and assigned via Settings → Reading → A static page. Edit Pages → Home (`/wp-admin/post.php?post=78&action=edit`). Its sections are expanded core Group, Heading, Paragraph, Button and Image blocks, with existing decorative SVG/form markup in Custom HTML blocks. Shared header/footer remain template parts in Appearance → Editor → Patterns → Header/Footer. `front-page.html` contains the shared header, page content and footer; `home.html` is an inactive latest-posts fallback.
The product stream uses one native server-rendered `wonderwish/product-stream` block so current product prices/visibility/images remain live WooCommerce data. Its title and surrounding copy are editable core blocks; product details are managed in Products. No static product snapshots are saved. Editor JS uses WordPress's block registration and ServerSideRender APIs, no additional plugin.
Editor navigation styles and `home-editor.css` keep logos and section previews bounded. Logos also carry explicit inline display dimensions. Two core image serialization mismatches were normalized; Gutenberg opens without invalid-block/recovery warnings. Migration backup: project `docs/store-pages/home-migration-backup.json`. One-time scripts in `tools/` created the page and normalized markup. Future visual changes should edit Home's saved blocks rather than assuming changes to the original PHP patterns will overwrite them.
Verified Home page editor, native product preview, footer logo in Site Editor, one frontend header/main/footer, eight catalogue cards, gift finder three actual results, and no 390px mobile overflow. Editor screenshots in project docs/store-pages.

## Simplified navigation and light footer
Only shared header/footer patterns and their CSS changed; saved Home content/manual edits were not updated. Navigation now contains Shop All/Disney/DreamWorks; search, Categories and My Account tabs are removed. Account remains reachable from the footer. Heart uses TI's native products-counter shortcode output, with explicit accessible label and polite count announcement; native TI JS maintains its count. Native Woo mini-cart is preserved. Verified existing count 2 → 3 after add → 2 after removal, restoring original wishlist contents.
Reference: Disney Store's own support describes a top-right heart beside My Bag (https://support.disneystore.com/hc/en-us/articles/5610073843219-How-do-I-make-a-Wish-List). Build-A-Bear native cart/wishlist navigation was also reviewed (https://www.buildabear.com/cart).
Footer is now a compact pale-blue surface, original logo in deep blue, a single invitation, four primary links, short delivery note and only available contact/legal links. Verified Home/account mobile no overflow, one shared header/footer, accessible Wishlist label, four footer links. Screenshots: project docs/store-pages/header-icons-final.png and footer-refined-final.png.

## Header/footer visual QA refinement
Preserved the saved Home page/manual content; no page/database updates in this pass. Footer uses the hero's #112767/#144bac/#2379ca gradient and original white logo without the muddy blue tint filter. Four-link compact structure retained. Header links are 15px desktop/17px mobile menu; heart/cart hit targets are 44×44px, with optical compensation for the bag SVG's internal whitespace. Start again has a visible rounded blue border and 46px minimum height. Moving-card heading controls are removed from that position; a small pause/resume icon at the section's lower edge preserves control over continuous motion, with explicit accessible labels.
QA: project docs/store-pages/polish-qa.json records 14 routes at 1366px and390px (28 checks), one header/footer, no horizontal overflow, accessible Wishlist label and unfiltered footer logo. Empty checkout redirects to Cart natively. Verified native cart drawer open/close, gift query three real results then reset clears choices/results, desktop pause toggles state, and mobile menu white text17px/three links. No new order submitted or wishlist content changed. This pass tests these routes and interactions; it is not a guarantee for every browser or future content change. Screenshot: docs/store-pages/footer-brand-blue-qa.png.

## Shop controls and finale/footer separation
Footer now has a light surface (#fbfdff) following the blue finale; original untinted white logo sits on a compact brand-blue plaque. Home saved content remains untouched. Shop sorting dropdown is removed through the native woocommerce_before_shop_loop action only on catalogue routes; sorting/default store settings are unchanged. Search stays above a desktop row with world logos left and categories right; DOM order follows worlds then categories, with stacked responsive layout. Shop/category/world/search title Explore link has a rounded border.
Verified real form submission Elsa→4 products, unmatched query→empty result, Disney+Accessories→2 appropriate products, and Elsa search within those filters→native single-result redirect to Frozen Anna and Elsa Keychain. Desktop worlds-left/categories-right measured, no ordering form; mobile390 wraps/stacks with no overflow. Footer mobile no overflow and no tint filter. Screenshots: docs/store-pages/shop-filters-left-right.png and footer-light-separation.png.

## Account tab, flipped filters and 404 bounds
Shared navigation adds a native WooCommerce account link labeled at render time through render_block_data: Log in for guests, My Account for authenticated visitors. This avoids caching the wrong authentication label in a theme pattern. Verified both browser sessions and guest link opens the real login form; no users/settings changed.
Shop desktop categories are left/worlds right; mobile stacks categories before worlds. Footer is now centered midnight (#091a32), with original white logo unboxed, four links and small delivery/legal line; removed the large invitation heading. Shared parts only; saved Home/manual edits remain unchanged.
404 character now has a square contained stage and enough bottom padding. Verified desktop276×276/mobile200×200, full image inside banner, no overflow. Screenshots: docs/store-pages/404-full-art.png and footer-centered-midnight.png.

## Lighter centered footer and account/header alignment
Kept centered footer layout, changed midnight to existing medium brand blues #205f9d/#286eab/#2379b7. Account and guest-auth headers use dark #112767/#174f9e with white untinted logo/text. Header's inherited 19.2px nav margin caused misalignment; explicitly reset direct-child margins and align centers. Logo artwork receives a small optical adjustment. Smaller21px heart and34px bag SVG (its inner drawing is smaller) retain44px hit targets; counters15px. Static Cart link icon26px.
Verified ten checks across Home/account/orders/wishlist/cart at1366px and390px: zero overflow and brand/nav/tools center difference≤0.1px (see docs/store-pages/header-alignment-qa.json). Guest sign-in dark background/white text separately verified. No saved Home content, products, cart/wishlist contents or settings changed. Screenshot docs/store-pages/footer-medium-blue.png.

Account header color correction: account/auth headers now use the exact same three-layer blue gradient as `.ww-shop-sky`, replacing the separate dark two-stop gradient. Verified computed background equality on both guest login and logged-in account pages, with no guest-page overflow. Alignment, sizes and Home content unchanged. Screenshot: docs/store-pages/account-header-brand-blue.png.

## White footer and inverse logo
Restored the guest login header's original transparent background over its cinematic sky; signed-in account pages retain the shared shop gradient. Footer remains centered and now uses pure white on all pages, including login. Dedicated `assets/images/brand/wonderwish-magical-logo-blue.png` is an actual transparent inverse-color image, not a CSS tint. Built-in imagegen edit prompt: preserve exact letterforms/layout, deep #173f80/#205f9d letters and #2379ca arc/stars, sharp edges without fuzzy glow, transparent background, white-footer use. Output1954×805 with alpha; copied into theme and used only in footer. Header original white asset preserved. Verified transparent login background, unchanged signed-in shop gradient, white footer and blue asset without filter.

## WooCommerce template compatibility audit
Reviewed screenshot folder list against installed WooCommerce11.2.1 rather than copying unrelated overrides. Three genuine My Account overrides are current (login9.9.0/dashboard4.4.0/navigation9.3.0), with all upstream action hooks retained and login/registration nonces present. Moved theme-only `woocommerce/myaccount/wonderwish-cards.php` to `template-parts/account/cards.php`, using native get_template_part at all three call sites. No visual/business behavior change intended. Details and folder rationale in `woocommerce/README.md`; repeatable read-only check in project `tools/audit-woocommerce-templates.php`. All theme PHP parsed successfully. Browser QA: dashboard/endpoints/wishlist single five-card nav, existing order details, guest auth/recovery views, quantity1→2→1, populated native cart/checkout with COD, mobile account no overflow. User's saved Home edits untouched. No order or account form submitted.

## Asset cleanup and organization
Current maintenance instructions are in MAINTENANCE.md. Six unused/duplicate theme images removed (834,255 bytes), including consolidation of byte-identical Toothless artwork without changing pixels or saved Home content. Active favicon in Media Library preserved. Three Finder metadata files removed. Two completed migration scripts archived under project docs/maintenance/completed-migrations; tools now contains the reusable WooCommerce audit. Reusable featured-products pattern now uses the live WooCommerce block instead of obsolete demo assets.
Verification: 13 rendered routes/116 local content-asset URLs, zero missing files; no exact duplicate images remain in the35 retained files. Both animated hover sources load; live stream returns8 products; simulated empty query returns a truthful empty state. Theme PHP parsing and WooCommerce hook/version checks pass. Cleanup manifest and browser audit are in project docs/maintenance. No saved page/template records, media uploads or business data/settings changed.
