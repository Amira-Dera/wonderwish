/* Viewport-triggered present opening; fully open without motion or scripts. */
(() => {
 const section = document.querySelector('.ww-finale');
 const motion = matchMedia('(prefers-reduced-motion: reduce)');
 if (!section || !('IntersectionObserver' in window) || motion.matches) return;
 const observer = new IntersectionObserver((entries) => {
  if (entries.some(entry => entry.isIntersecting)) { section.classList.add('is-visible'); observer.disconnect(); }
 }, {threshold:.4});
 section.classList.add('will-reveal'); observer.observe(section.querySelector('.ww-finale-art'));
 motion.addEventListener('change', () => {if (motion.matches) {section.classList.add('is-visible');observer.disconnect();}});
})();
