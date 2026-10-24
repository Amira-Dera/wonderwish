/* Presentation only. WooCommerce owns validation, cart writes, notices and counts. */
(() => {
  // Labels follow TI's real add/remove state; no separate wishlist storage or requests.
  document.querySelectorAll('.tinvwl_add_to_wishlist_button').forEach((button) => {
    const syncLabel = () => {
      const remove = button.classList.contains('tinvwl-product-make-remove');
      const text = button.querySelector(remove ? '.tinvwl_remove_from_wishlist-text' : '.tinvwl_add_to_wishlist-text')?.textContent.trim();
      if (text) { button.setAttribute('aria-label', text); button.setAttribute('title', text); }
      button.setAttribute('aria-pressed', String(remove));
    };
    syncLabel();
    new MutationObserver(syncLabel).observe(button, {attributes:true,attributeFilter:['class']});
  });
  // +/- controls operate the native quantity input and its own min/max/step.
  const syncQuantity = (wrapper) => {
    const input = wrapper.querySelector('input.qty');
    if (!input) return;
    const value=Number(input.value), min=input.min === '' ? 0 : Number(input.min), max=input.max === '' ? Infinity : Number(input.max);
    wrapper.querySelectorAll('.ww-qty-step').forEach(button=>{
      button.disabled=input.disabled || input.readOnly || input.type==='hidden' || (Number(button.dataset.step)<0 ? value<=min : value>=max);
    });
  };
  document.querySelectorAll('form.cart .quantity').forEach(wrapper=>{
    syncQuantity(wrapper);
    const input=wrapper.querySelector('input.qty');
    if(input) new MutationObserver(()=>syncQuantity(wrapper)).observe(input,{attributes:true,attributeFilter:['min','max','readonly','disabled','type']});
  });
  document.addEventListener('click',event=>{
    const button=event.target.closest('.ww-qty-step');
    if (!button || button.disabled) return;
    const wrapper=button.closest('.quantity'), input=wrapper?.querySelector('input.qty');
    if (!input) return;
    try { input.stepUp(Number(button.dataset.step)); } catch { return; }
    input.dispatchEvent(new Event('input',{bubbles:true}));
    input.dispatchEvent(new Event('change',{bubbles:true}));
    syncQuantity(wrapper);
  });
  document.addEventListener('change',event=>{
    if (event.target.matches('form.cart input.qty')) syncQuantity(event.target.closest('.quantity'));
  });
  document.addEventListener('input',event=>{
    if (event.target.matches('form.cart input.qty')) syncQuantity(event.target.closest('.quantity'));
  });
  // Keep native cart behavior; remove only the redundant post-add link.
  if(window.jQuery) window.jQuery(document.body).on('added_to_cart.wonderwish',(event,fragments,hash,button)=>{
    if(button?.[0]) button.parent().find('.added_to_cart').remove();
  });
})();
