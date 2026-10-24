(() => {
  const badgeLine = document.querySelector('.is-style-success-process > .wp-block-columns > .wp-block-column:first-child p:last-child');
  if (badgeLine && !badgeLine.querySelector('.success-process-badge')) {
    const labels = badgeLine.innerHTML.split(/\u3000+|<br\s*\/?\s*>/i).map((item) => item.trim()).filter(Boolean);
    if (labels.length > 1) {
      badgeLine.replaceChildren(...labels.map((label) => {
        const badge = document.createElement('span');
        badge.className = 'success-process-badge';
        badge.textContent = label;
        return badge;
      }));
    }
  }

  const rail = document.querySelector('.is-style-success-section > p:last-child');
  if (!rail || rail.classList.contains('success-name-rail-ready')) return;

  const text = rail.textContent.trim();
  if (!text) return;

  const track = document.createElement('span');
  track.className = 'success-name-rail-track';
  for (let index = 0; index < 2; index += 1) {
    const copy = document.createElement('span');
    copy.className = 'success-name-rail-copy';
    copy.textContent = `${text}　·　${text}　·　`;
    if (index === 1) copy.setAttribute('aria-hidden', 'true');
    track.append(copy);
  }
  rail.replaceChildren(track);
  rail.classList.add('success-name-rail-ready');

  if (!window.IntersectionObserver) return;
  const observer = new IntersectionObserver(([entry]) => {
    track.style.animationPlayState = entry.isIntersecting ? 'running' : 'paused';
  });
  observer.observe(rail);
})();
