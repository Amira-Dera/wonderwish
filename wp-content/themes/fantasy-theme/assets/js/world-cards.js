/* Play supplied character animations only on deliberate, motion-safe interaction. */
(() => {
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)');
  const pointer = window.matchMedia('(hover: hover) and (pointer: fine)');
  const cleanups = [];
  document.querySelectorAll('.ww-world-card').forEach((card) => {
    const image = card.querySelector('.ww-world-character img');
    if (!image) return;
    const still = image.getAttribute('src');
    const animated = still.replace('-wave-still.webp', '-wave.webp');
    if (still === animated) return;
    let timer;
    const stop = () => {
      clearTimeout(timer);
      image.setAttribute('src', still);
      card.dataset.waveState = 'still';
    };
    const play = () => {
      if (reduced.matches || document.hidden) return;
      clearTimeout(timer);
      image.setAttribute('src', animated);
      card.dataset.waveState = 'playing';
      // A short greeting, not a perpetual animation while focus stays on the link.
      timer = setTimeout(stop, 4000);
    };
    const enter = (event) => {
      if (pointer.matches && event.pointerType !== 'touch') play();
    };
    const focus = () => {
      if (card.querySelector(':focus-visible')) play();
    };
    const blur = (event) => {
      if (!card.contains(event.relatedTarget)) stop();
    };
    const visibility = () => { if (document.hidden) stop(); };
    card.dataset.waveState = 'still';
    card.addEventListener('pointerenter', enter);
    card.addEventListener('pointerleave', stop);
    card.addEventListener('focusin', focus);
    card.addEventListener('focusout', blur);
    reduced.addEventListener('change', stop);
    pointer.addEventListener('change', stop);
    document.addEventListener('visibilitychange', visibility);
    cleanups.push(() => {
      stop();
      card.removeEventListener('pointerenter', enter);
      card.removeEventListener('pointerleave', stop);
      card.removeEventListener('focusin', focus);
      card.removeEventListener('focusout', blur);
      reduced.removeEventListener('change', stop);
      pointer.removeEventListener('change', stop);
      document.removeEventListener('visibilitychange', visibility);
    });
  });
  window.addEventListener('pagehide', () => cleanups.forEach((cleanup) => cleanup()), { once: true });
})();
