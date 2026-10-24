(() => {
  const header = document.querySelector('.is-style-success-header');
  const content = header?.querySelector('.wp-block-navigation__responsive-container-content');
  if (!content || content.querySelector('.success-mobile-actions')) return;

  const help = header.querySelector('.success-help a');
  const signIn = header.querySelector('.success-header-actions .wp-block-button__link');
  if (!help || !signIn) return;

  const actions = document.createElement('div');
  actions.className = 'success-mobile-actions';
  for (const [source, label] of [[signIn, 'Sign in'], [help, 'Help Center']]) {
    const link = document.createElement('a');
    link.href = source.href;
    link.textContent = label;
    actions.append(link);
  }
  content.append(actions);

  let submenuIndex = 0;
  for (const item of content.querySelectorAll('.wp-block-navigation-submenu')) {
    const submenu = item.querySelector(':scope > .wp-block-navigation__submenu-container');
    const link = item.querySelector(':scope > .wp-block-navigation-item__content');
    if (!submenu || !link) continue;
    submenu.id ||= `success-mobile-submenu-${++submenuIndex}`;
    const toggle = document.createElement('button');
    toggle.type = 'button';
    toggle.className = 'success-submenu-toggle';
    toggle.setAttribute('aria-label', `${link.textContent.trim()} submenu`);
    toggle.setAttribute('aria-controls', submenu.id);
    toggle.setAttribute('aria-expanded', 'false');
    toggle.addEventListener('click', () => {
      const expanded = toggle.getAttribute('aria-expanded') !== 'true';
      toggle.setAttribute('aria-expanded', String(expanded));
      item.classList.toggle('is-submenu-expanded', expanded);
    });
    item.insertBefore(toggle, submenu);
    if (link.getAttribute('href') === '#') {
      link.addEventListener('click', (event) => {
        if (window.matchMedia('(max-width: 900px)').matches) {
          event.preventDefault();
          toggle.click();
        }
      });
    }
  }
})();
