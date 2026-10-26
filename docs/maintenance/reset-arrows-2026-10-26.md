# Reset confirmation and phone arrows

Added a minimal native WooCommerce lost-password-confirmation override (upstream
version 3.9.0). The native notice, message filter and both upstream action hooks
remain. The entire confirmation now sits in a responsive white card with an
original envelope SVG and native My Account sign-in link. No reset submission,
email delivery, account credentials or database settings changed.

Added a shared frontend arrow normalizer: decorative Unicode arrows in theme
links/buttons become inline SVG strokes. It preserves text labels, URLs, SVG
accessibility hiding and the manually edited saved Home page. Handles future
inserted link elements as well. No icon font or external assets required.

Checks: native confirmation URL rendered without sending mail; desktop card
560px, 390px viewport card contained with no overflow. Mobile Home rendered 14
vector arrows with no remaining arrow glyphs in links/buttons. Mobile Shop
rendered vector Explore/pagination/footer arrows; anchor and pagination URLs
unchanged, no overflow. JavaScript parse passed. WooCommerce override audit:
all four versions match upstream, no missing action hooks, no PHP parse errors.
Actual physical iPhone testing and hosting deployment remain unverified.
