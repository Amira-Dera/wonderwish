# Non-blocking commerce feedback

Theme-owned toast presentation listens to real WooCommerce/TI responses; it does
not make cart or wishlist requests or maintain separate saved-product state.
Blue/white panels include a small sparkle, glow, dismiss button, polite live
region and six-second timeout (paused during hover/focus). Reduced motion is
respected. Native single-product cart confirmations are marked server-side and
shown as the same alert after page reload. Validation errors remain native.

TI result dialogs are closed using the plugin's close control after its handlers
bind, preserving native focus-trap cleanup; wishlist selection dialogs are not
targeted. Real response messages are kept as text, not injected HTML. Failure
responses never produce an added-success message.

Local checks: actual single-product form add and AJAX shop add both produced
cart alerts; AJAX alert was role=status with no modal overlay. Cart count updated.
No console errors on checked cart/shop flow. Test guest cart restored to empty.
JavaScript parse check and PHP/WooCommerce template audit passed.

Wishlist test returned a failure from the existing local plugin request flow;
the new error toast rendered correctly, but a successful wishlist add and its
dialog cleanup remain unverified end-to-end. No customer wishlist was changed
by that failed request. Confirm success on the deployed site before considering
the wishlist path fully verified. No live deployment executed here.
