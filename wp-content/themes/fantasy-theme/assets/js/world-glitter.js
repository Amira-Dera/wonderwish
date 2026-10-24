/* Blue, green and white pointer glitter, scoped to Shop by World. */
(() => {
  const reduced = matchMedia('(prefers-reduced-motion: reduce)');
  const fine = matchMedia('(hover: hover) and (pointer: fine)');
  document.querySelectorAll('.ww-worlds, .ww-treasures, .ww-gifts, .ww-benefits, .ww-finale, .ww-auth-stage, body.ww-account-page, body.ww-shop-page, body.ww-product-page, body.ww-page-shell:not(.ww-account-page):not(.ww-auth-page)').forEach((section) => {
    const fullPage = section.matches('body.ww-account-page, body.ww-shop-page, body.ww-product-page, body.ww-page-shell:not(.ww-account-page):not(.ww-auth-page)');
    let canvas = section.querySelector('.ww-world-canvas');
    if (fullPage) {
      canvas = document.createElement('canvas'); canvas.className = 'ww-page-glitter';
      canvas.setAttribute('aria-hidden', 'true'); section.append(canvas);
    }
    const ctx = canvas?.getContext('2d');
    if (!ctx) return;
    const colors = (section.classList.contains('ww-treasures') || section.classList.contains('ww-gifts')) ? ['#338fc9', '#59b58d', '#b084d0', '#e3b85e', '#ffffff'] : ['#338fc9', '#59b58d', '#ffffff', '#8ed9c2'];
    const particles = Array.from({ length: 56 }, () => ({ life: 0 }));
    let frame = 0, previous = 0, index = 0, lastEmit = 0, width = 0, height = 0;
    let lastX = null, lastY = null;
    const resize = () => {
      const rect = section.getBoundingClientRect();
      width = fullPage ? innerWidth : rect.width; height = fullPage ? innerHeight : rect.height;
      const dpr = Math.min(devicePixelRatio || 1, 1.5);
      canvas.width = Math.round(width * dpr); canvas.height = Math.round(height * dpr);
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    };
    const render = (now) => {
      frame = 0;
      if (reduced.matches || !fine.matches || document.hidden) return;
      const dt = previous ? Math.min(now - previous, 40) : 16;
      previous = now;
      ctx.clearRect(0, 0, width, height);
      let alive = false;
      particles.forEach((p) => {
        if (p.life <= 0) return;
        p.life -= dt;
        if (p.life <= 0) return;
        alive = true; p.y += dt * .018;
        const fade = p.life / p.duration, r = p.radius * (.35 + fade * .65);
        ctx.globalAlpha = fade * .85; ctx.fillStyle = p.color;
        ctx.beginPath(); ctx.moveTo(p.x, p.y - r * 3);
        ctx.lineTo(p.x + r * .45, p.y - r * .45);
        ctx.lineTo(p.x + r * 3, p.y); ctx.lineTo(p.x + r * .45, p.y + r * .45);
        ctx.lineTo(p.x, p.y + r * 3); ctx.lineTo(p.x - r * .45, p.y + r * .45);
        ctx.lineTo(p.x - r * 3, p.y); ctx.lineTo(p.x - r * .45, p.y - r * .45);
        ctx.closePath(); ctx.fill();
      });
      ctx.globalAlpha = 1;
      section.dataset.glitterState = alive ? 'active' : 'idle';
      if (alive) frame = requestAnimationFrame(render);
      else previous = 0;
    };
    const move = (event) => {
      if (reduced.matches || !fine.matches || event.pointerType === 'touch' || document.hidden) return;
      const now = performance.now();
      if (now - lastEmit < 24) return;
      const rect = fullPage ? {left: 0, top: 0} : section.getBoundingClientRect(), x = event.clientX - rect.left, y = event.clientY - rect.top;
      if (lastX !== null && Math.hypot(x - lastX, y - lastY) < 2) return;
      for (let i = 0; i < 3; i++) {
        const duration = 450 + Math.random() * 350;
        Object.assign(particles[index++ % particles.length], { x: x + (Math.random() - .5) * 16, y: y + (Math.random() - .5) * 16, life: duration, duration, radius: .8 + Math.random() * 1.5, color: colors[Math.floor(Math.random() * colors.length)] });
      }
      lastX = x; lastY = y; lastEmit = now;
      if (!frame) { previous = 0; frame = requestAnimationFrame(render); }
    };
    const leave = () => { lastX = null; lastY = null; };
    const stop = () => {
      cancelAnimationFrame(frame); frame = 0; previous = 0; leave();
      particles.forEach((p) => { p.life = 0; });
      ctx.clearRect(0, 0, width, height); section.dataset.glitterState = 'idle';
    };
    const visibility = () => { if (document.hidden) stop(); };
    const observer = new ResizeObserver(resize); observer.observe(section); resize();
    if (fullPage) addEventListener('resize', resize, { passive: true });
    section.addEventListener('pointermove', move, { passive: true });
    section.addEventListener('pointerleave', leave);
    reduced.addEventListener('change', stop); fine.addEventListener('change', stop);
    document.addEventListener('visibilitychange', visibility);
    addEventListener('pagehide', (event) => {
      stop();
      if (event.persisted) return;
      observer.disconnect(); if (fullPage) { removeEventListener('resize', resize); canvas.remove(); } section.removeEventListener('pointermove', move);
      section.removeEventListener('pointerleave', leave);
      reduced.removeEventListener('change', stop); fine.removeEventListener('change', stop);
      document.removeEventListener('visibilitychange', visibility);
    }, { once: true });
  });
})();
