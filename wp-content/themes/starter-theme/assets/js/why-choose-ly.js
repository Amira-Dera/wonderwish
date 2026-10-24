(() => {
  'use strict';

  const wordCard = document.querySelector('.is-style-why-word-card');
  const worldCard = document.querySelector('.is-style-why-world-card');
  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

  if (!wordCard && !worldCard) return;

  let resumeTyping = () => {};

  if (wordCard && !reducedMotion.matches) {
    const heading = wordCard.querySelector('h3');
    const words = [...wordCard.querySelectorAll('.why-badges .is-style-why-pill')]
      .map((pill) => pill.textContent.trim().replace(/\.ly$/i, ''))
      .filter(Boolean);

    if (heading && words.length) {
      const prefix = document.createElement('span');
      const suffix = document.createElement('span');
      const caret = document.createElement('i');
      suffix.className = 'why-typing-suffix';
      suffix.textContent = '.ly';
      caret.className = 'why-typing-caret';
      caret.setAttribute('aria-hidden', 'true');
      prefix.setAttribute('aria-hidden', 'true');
      suffix.setAttribute('aria-hidden', 'true');
      heading.setAttribute('aria-label', 'Words ending in .ly');
      heading.replaceChildren(prefix, suffix, caret);

      let index = 0;
      let length = 0;
      let deleting = false;
      let timer;

      const canPlay = () => wordCard.classList.contains('is-in-view') &&
        !wordCard.matches(':hover, :focus-within') && !document.hidden && !reducedMotion.matches;

      const queue = (delay = 0) => {
        window.clearTimeout(timer);
        if (canPlay()) timer = window.setTimeout(tick, delay);
      };

      const tick = () => {
        if (!canPlay()) return;
        const word = words[index];
        length += deleting ? -1 : 1;
        prefix.textContent = word.slice(0, length);
        if (!deleting && length === word.length) {
          deleting = true;
          queue(1500);
        } else if (deleting && length === 0) {
          deleting = false;
          index = (index + 1) % words.length;
          queue(240);
        } else {
          queue(deleting ? 65 : 110);
        }
      };

      resumeTyping = () => queue(110);
      wordCard.addEventListener('mouseenter', () => window.clearTimeout(timer));
      wordCard.addEventListener('mouseleave', resumeTyping);
      wordCard.addEventListener('focusin', () => window.clearTimeout(timer));
      wordCard.addEventListener('focusout', resumeTyping);
      document.addEventListener('visibilitychange', resumeTyping);
    }
  }

  const targets = [wordCard, worldCard].filter(Boolean);
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        entry.target.classList.toggle('is-in-view', entry.isIntersecting);
        if (entry.target === wordCard && entry.isIntersecting) resumeTyping();
      });
    }, { rootMargin: '80px 0px', threshold: 0.1 });
    targets.forEach((target) => observer.observe(target));
  } else {
    targets.forEach((target) => target.classList.add('is-in-view'));
    resumeTyping();
  }
})();
