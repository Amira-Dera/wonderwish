/* Full-width curved right-to-left card stream. Static native grid without JS or reduced motion. */
(() => {
  const reduced = matchMedia('(prefers-reduced-motion: reduce)');
  const desktop = matchMedia('(min-width: 900px) and (hover: hover) and (pointer: fine)');
  document.querySelectorAll('.ww-treasures').forEach((section) => {
    const stage = section.querySelector('.ww-treasure-grid');
    const cards = stage ? Array.from(stage.querySelectorAll('.ww-treasure-card')) : [];
    const controls = section.querySelector('.ww-orbit-controls');
    const button = controls?.querySelector('button');
    if (cards.length < 3 || !button) return;
    button.setAttribute('aria-label', 'Pause product motion');
    let offset = 0, frame = 0, last = 0, manual = false, hover = false, focus = false, visible = false;
    const enabled = () => desktop.matches && !reduced.matches;
    const spacingForViewport = () => Math.max(330, (stage.clientWidth + 700) / cards.length);
    const draw = () => {
      const spacing = spacingForViewport(), period = cards.length * spacing;
      const half = stage.clientWidth / 2;
      cards.forEach((card, i) => {
        // Wrap outside the viewport; cards never travel back across the row.
        const x = ((i * spacing - offset + period / 2) % period + period) % period - period / 2;
        const curve = Math.max(-1.5, Math.min(1.5, x / half));
        const y = -65 * curve * curve;
        card.style.transform = `translate(-50%, -50%) translate(${x}px, ${y}px) rotateY(${-curve * 12}deg) rotateZ(${-curve * 5}deg)`;
        card.style.zIndex = '1';
        card.style.opacity = '1';
      });
    };
    const stop = () => { cancelAnimationFrame(frame); frame = 0; last = 0; };
    const allowed = () => enabled() && visible && !manual && !hover && !focus && !document.hidden;
    const tick = (now) => {
      frame = 0;
      if (!allowed()) return;
      const dt = last ? Math.min(now - last, 40) : 16;
      last = now; offset = (offset + dt * .055) % (cards.length * spacingForViewport());
      draw(); frame = requestAnimationFrame(tick);
    };
    const update = () => {
      stop();
      section.dataset.orbitState = enabled() ? (allowed() ? 'moving' : 'paused') : 'static';
      if (allowed()) frame = requestAnimationFrame(tick);
    };
    const configure = () => {
      stage.classList.toggle('is-stream', enabled()); controls.hidden = !enabled();
      if (enabled()) draw();
      else cards.forEach((card) => { card.style.removeProperty('transform'); card.style.removeProperty('z-index'); card.style.removeProperty('opacity'); });
      update();
    };
    const enter = () => { hover = true; update(); };
    const leave = () => { hover = false; update(); };
    const focusIn = (event) => {
      focus = true;
      const index = cards.indexOf(event.target.closest('.ww-treasure-card'));
      if (enabled() && index >= 0) { offset = index * spacingForViewport(); draw(); }
      update();
    };
    const focusOut = (event) => { if (!stage.contains(event.relatedTarget)) { focus = false; update(); } };
    const toggle = () => {
      manual = !manual; button.setAttribute('aria-pressed', String(manual));
      button.textContent = manual ? 'Resume motion' : 'Pause motion'; button.setAttribute('aria-label', manual ? 'Resume product motion' : 'Pause product motion'); update();
    };
    const observer = new IntersectionObserver((entries) => { visible = entries[0].isIntersecting; update(); });
    const resize = new ResizeObserver(() => { if (enabled()) draw(); });
    observer.observe(stage); resize.observe(stage);
    cards.forEach((card) => { card.addEventListener('pointerenter', enter); card.addEventListener('pointerleave', leave); });
    stage.addEventListener('focusin', focusIn); stage.addEventListener('focusout', focusOut);
    button.addEventListener('click', toggle);
    reduced.addEventListener('change', configure); desktop.addEventListener('change', configure);
    document.addEventListener('visibilitychange', update); configure();
    addEventListener('pagehide', (event) => {
      stop(); if (event.persisted) return;
      observer.disconnect(); resize.disconnect();
      cards.forEach((card) => { card.removeEventListener('pointerenter', enter); card.removeEventListener('pointerleave', leave); });
      stage.removeEventListener('focusin', focusIn); stage.removeEventListener('focusout', focusOut);
      button.removeEventListener('click', toggle);
      reduced.removeEventListener('change', configure); desktop.removeEventListener('change', configure);
      document.removeEventListener('visibilitychange', update);
    });
  });
})();
