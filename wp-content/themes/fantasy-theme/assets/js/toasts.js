/* Feedback only: native WooCommerce and TI responses remain the source of truth. */
(() => {
  const region = document.createElement('div');
  region.className = 'ww-toast-region'; region.setAttribute('role', 'status');
  region.setAttribute('aria-live', 'polite'); region.setAttribute('aria-atomic', 'true');
  document.body.append(region);
  let timer, lastText = '', lastTime = 0;
  const dismiss = () => { clearTimeout(timer); region.replaceChildren(); };
  const show = (message, error = false) => {
    if (!message) return;
    const now = Date.now();
    if (message === lastText && now - lastTime < 500) return;
    lastText = message; lastTime = now; dismiss();
    const card = document.createElement('div'); card.className = 'ww-toast' + (error ? ' is-error' : '');
    const icon = document.createElement('span'); icon.className = 'ww-toast-icon'; icon.textContent = error ? '!' : '✓'; icon.setAttribute('aria-hidden', 'true');
    const text = document.createElement('span'); text.className = 'ww-toast-text'; text.textContent = message;
    const close = document.createElement('button'); close.type = 'button'; close.textContent = '×'; close.setAttribute('aria-label', 'Dismiss notification'); close.addEventListener('click', dismiss);
    card.append(icon, text, close); region.append(card);
    const schedule = () => { clearTimeout(timer); timer = setTimeout(dismiss, 6000); };
    card.addEventListener('pointerenter', () => clearTimeout(timer)); card.addEventListener('pointerleave', schedule);
    card.addEventListener('focusin', () => clearTimeout(timer)); card.addEventListener('focusout', schedule); schedule();
  };
  const plain = (html) => {
    const doc = new DOMParser().parseFromString(String(html || ''), 'text/html');
    return (doc.querySelector('.tinv-txt') || doc.body).textContent.replace(/\s+/g, ' ').trim();
  };
  // Native form submissions reload the page; consume only marked cart successes.
  document.querySelectorAll('.ww-cart-confirmation').forEach(message => {
    show(message.textContent.trim());
    const notice = message.closest('.woocommerce-message,.wc-block-components-notice-banner');
    if (notice) notice.hidden = true;
  });
  const $ = window.jQuery;
  if ($) {
    $(document.body).on('added_to_cart.wwToast', () => show('Added to your cart.'));
    $(document.body).on('tinvwl_wishlist_ajax_response.wwToast', (event, element, response) => {
      if (!response || response.action === 'get_data') return;
      const successful = response.status === true || response.removed === true;
      const message = plain(response.msg) || (successful ? (response.action?.startsWith('add_to_cart') ? 'Added to your cart.' : response.removed ? 'Removed from your wishlist.' : 'Added to your wishlist.') : 'We couldn’t complete that action. Please try again.');
      show(message, !successful);
    });
    // TI owns modal cleanup and focus-trap release. Close through its own control
    // after it binds handlers; do not just hide an active dialog/focus trap.
    const cleanup = new MutationObserver(() => {
      document.querySelectorAll('body > .tinv-wishlist .tinvwl_added_to_wishlist:not([data-ww-toast-closed])').forEach(modal => {
        const close = modal.querySelector('.tinvwl_button_close,.tinv-close-modal');
        if (close) { modal.dataset.wwToastClosed = 'true'; $(close).trigger('click'); }
      });
    });
    cleanup.observe(document.body, { childList: true, subtree: true });
    document.body.classList.add('ww-toast-ready');
  }
  document.addEventListener('wc-blocks_added_to_cart', () => show('Added to your cart.'));
})();
