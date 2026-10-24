/* Expand WooCommerce's own optional notes control; WooCommerce retains its state/save logic. */
(() => {
 let scheduled = false;
 const expandNotes = () => {
  scheduled = false;
  const block = document.querySelector('.wc-block-checkout__add-note');
  if (!block) return;
  const toggle = block.querySelector('input[type="checkbox"]');
  if (toggle && !toggle.checked && !toggle.disabled && !block.dataset.wwExpanded) {
   block.dataset.wwExpanded = 'true';
   toggle.click();
  }
  const textarea = block.querySelector('textarea');
  if (!textarea) return;
  textarea.required = false;
  textarea.setAttribute('aria-required', 'false');
  if (!textarea.id) textarea.id = 'ww-order-notes';
  if (!block.querySelector('.ww-order-note-label')) {
   const label = document.createElement('label');
   label.className = 'ww-order-note-label';
   label.htmlFor = textarea.id;
   label.textContent = 'Order notes (optional)';
   block.insertBefore(label, block.firstChild);
  }
  block.classList.add('ww-notes-visible');
 };
 const observer = new MutationObserver(() => {
  if (scheduled) return;
  scheduled = true;
  requestAnimationFrame(expandNotes);
 });
 observer.observe(document.querySelector('.wp-block-woocommerce-checkout') || document.body, { childList: true, subtree: true });
 expandNotes();
})();
