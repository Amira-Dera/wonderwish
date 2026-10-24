/* Native Store API catalogue query. No demo products, user writes or tracking. */
(() => {
  const allowed = { recipient: ['kids', 'friends', 'family', 'yourself'], world: ['disney', 'dreamworks'], occasion: ['birthday', 'celebration', 'just-because'] };
  const labels = { kids: 'kids', friends: 'friends', family: 'family', yourself: 'you', disney: 'Disney', dreamworks: 'DreamWorks', birthday: 'a birthday', celebration: 'a celebration', 'just-because': 'a just-because surprise' };
  const safeURL = (value, sameOrigin = false) => {
    try { const url = new URL(value, location.href); return ['http:', 'https:'].includes(url.protocol) && (!sameOrigin || url.origin === location.origin) ? url.href : null; } catch { return null; }
  };
  const text = (value) => new DOMParser().parseFromString(String(value), 'text/html').body.textContent || '';
  document.querySelectorAll('.ww-gift-finder').forEach((finder) => {
    const form = finder.querySelector('form'), submit = form.querySelector('[type="submit"]');
    const status = finder.querySelector('.ww-gift-status'), results = finder.querySelector('.ww-gift-results');
    const title = results.querySelector('h3'), copy = results.querySelector('.ww-gift-result-copy');
    const matches = results.querySelector('.ww-gift-matches'), browse = results.querySelector('.ww-gift-browse');
    // Reveal once when the illustration enters view, independently of search/reset.
    const motion = matchMedia('(prefers-reduced-motion: reduce)');
    if ('IntersectionObserver' in window && !motion.matches) {
      const observer = new IntersectionObserver((entries) => {
        if (entries.some((entry) => entry.isIntersecting)) {
          finder.classList.add('is-box-open'); observer.disconnect();
        }
      }, { threshold: 0.45 });
      finder.classList.add('has-box-intro');
      observer.observe(finder.querySelector('.ww-gift-art'));
      motion.addEventListener('change', () => {
        if (motion.matches) { finder.classList.add('is-box-open'); observer.disconnect(); }
      });
    }
    let controller, timeout, sequence = 0;
    const clear = () => {
      ++sequence; controller?.abort(); clearTimeout(timeout); submit.disabled = false;
      status.textContent = ''; results.hidden = true; matches.replaceChildren(); finder.classList.remove('is-revealed');
      results.removeAttribute('aria-busy');
    };
    const reveal = () => {
      results.hidden = false; finder.classList.add('is-revealed');
      title.focus({ preventScroll: true });
      results.scrollIntoView({ behavior: motion.matches ? 'instant' : 'smooth', block: 'start' });
    };
    const renderProduct = (product) => {
      const url = safeURL(product.permalink, true);
      if (!url) return;
      const card = document.createElement('article'); card.className = 'ww-gift-match';
      const imageURL = product.images?.[0]?.src && safeURL(product.images[0].src);
      if (imageURL) {
        const image = document.createElement('img'); image.src = imageURL;
        image.alt = text(product.images[0].alt || product.name); image.loading = 'lazy'; image.width = 220; image.height = 170; card.append(image);
      }
      const heading = document.createElement('h4'), link = document.createElement('a');
      link.href = url; link.textContent = text(product.name); heading.append(link); card.append(heading);
      const prices = product.prices;
      if (prices?.price !== '' && prices?.price != null && Number.isFinite(Number(prices.price))) {
        const price = document.createElement('p');
        try { const englishLYD = prices.currency_code === 'LYD' && document.documentElement.lang.startsWith('en'); price.textContent = new Intl.NumberFormat(document.documentElement.lang || 'en', { style: englishLYD ? 'decimal' : 'currency', currency: prices.currency_code, minimumFractionDigits: prices.currency_minor_unit, maximumFractionDigits: prices.currency_minor_unit }).format(Number(prices.price) / 10 ** prices.currency_minor_unit) + (englishLYD ? ' LYD' : ''); }
        catch { price.textContent = 'View gift details for price'; }
        card.append(price);
      }
      if (product.is_in_stock === false) { const stock = document.createElement('p'); stock.textContent = 'Currently out of stock'; card.append(stock); }
      matches.append(card);
    };
    form.addEventListener('reset', clear);
    form.addEventListener('change', clear);
    form.addEventListener('submit', async (event) => {
      event.preventDefault(); if (!form.reportValidity()) return;
      clear(); const request = sequence;
      const data = new FormData(form), choice = Object.fromEntries(data.entries());
      if (Object.entries(allowed).some(([key, values]) => !values.includes(choice[key]))) return;
      const endpoint = safeURL(finder.dataset.endpoint, true), shopURL = safeURL(finder.dataset.shop, true);
      if (!endpoint || !shopURL) { status.textContent = 'The gift finder is unavailable right now. Please explore the shop.'; return; }
      const url = new URL(endpoint);
      url.searchParams.set('per_page', '3'); url.searchParams.set('catalog_visibility', 'catalog');
      const tags = JSON.parse(finder.dataset.tags || '{}');
      const selectedTags = [tags[`gift-for-${choice.recipient}`], tags[`gift-occasion-${choice.occasion}`]];
      const exact = selectedTags.every(id => Number.isInteger(id) && id > 0);
      if (exact) { url.searchParams.set('tag', selectedTags.join(',')); url.searchParams.set('tag_operator', 'and'); }
      url.searchParams.set('attributes[0][attribute]', 'pa_franchise');
      url.searchParams.set('attributes[0][slug][0]', choice.world);
      url.searchParams.set('attributes[0][operator]', 'in');
      const worldURL = new URL(shopURL); worldURL.searchParams.set('filter_franchise', choice.world);
      browse.href = worldURL.href; browse.firstChild.textContent = `Explore ${labels[choice.world]} gifts `;
      submit.disabled = true; status.textContent = 'Looking for a little magic…'; results.setAttribute('aria-busy', 'true');
      controller = new AbortController(); timeout = setTimeout(() => controller.abort(), 12000);
      try {
        const response = await fetch(url.href, { signal: controller.signal, credentials: 'same-origin', headers: { Accept: 'application/json' } });
        if (!response.ok) throw new Error('Catalogue unavailable');
        const products = await response.json();
        if (!Array.isArray(products)) throw new Error('Invalid catalogue response');
        if (request !== sequence) return;
        products.forEach(renderProduct);
        if (matches.children.length) {
          title.textContent = exact ? 'A little something they’ll love' : `${labels[choice.world]} ideas to explore`;
          copy.textContent = exact ? `${labels[choice.world]} gifts for ${labels[choice.recipient]}, picked for ${labels[choice.occasion]}.` : `Explore these ${labels[choice.world]} ideas. These are general world suggestions. Check individual gift details to decide whether they suit your recipient and occasion.`;
          status.textContent = '';
        } else {
          title.textContent = 'Your perfect gift is still waiting';
          copy.textContent = `We don’t have any ${labels[choice.world]} gifts matching ${labels[choice.recipient]} and ${labels[choice.occasion]} yet. Try another combination, or explore this world for more inspiration.`;
          status.textContent = 'No matching gifts yet.';
        }
        reveal();
      } catch {
        if (request !== sequence) return;
        title.textContent = 'A little pause in the magic';
        copy.textContent = 'We couldn’t load the gift selection right now. Please try again, or explore the shop.';
        status.textContent = 'The gift selection could not be loaded.'; reveal();
      } finally {
        if (request === sequence) { clearTimeout(timeout); submit.disabled = false; results.removeAttribute('aria-busy'); }
      }
    });
    addEventListener('pagehide', clear);
  });
})();
