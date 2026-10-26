/* Theme decoration only: replace arrow glyphs that iOS may render as emoji.
 * Saved Gutenberg content, link destinations and accessible names stay intact. */
(() => {
 const directions = {'→':0,'➡':0,'↗':-45,'↑':-90,'⬆':-90,'↖':-135,'←':180,'⬅':180,'↙':135,'↓':90,'⬇':90,'↘':45};
 const replace = (root) => {
  const walker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT);
  const nodes = [];
  while (walker.nextNode()) {
   const node = walker.currentNode;
   if (/[↗↘↙↖→←↓↑➡⬅⬇⬆]/.test(node.nodeValue) && node.parentElement?.closest('a,button,.ww-customer-arrow') && !node.parentElement.closest('svg,script,style,textarea,input,[contenteditable="true"]')) nodes.push(node);
  }
  nodes.forEach(node => {
   const fragment = document.createDocumentFragment();
   node.nodeValue.split(/([↗↘↙↖→←↓↑➡⬅⬇⬆])/).forEach(part => {
    if (!(part in directions)) { fragment.append(document.createTextNode(part)); return; }
    const svg = document.createElementNS('http://www.w3.org/2000/svg','svg');
    svg.setAttribute('viewBox','0 0 24 24'); svg.setAttribute('aria-hidden','true'); svg.setAttribute('focusable','false'); svg.classList.add('ww-arrow-icon');
    const path = document.createElementNS(svg.namespaceURI,'path');
    path.setAttribute('d','M4 12h16m-7-7 7 7-7 7'); path.setAttribute('transform',`rotate(${directions[part]} 12 12)`); svg.append(path); fragment.append(svg);
   });
   node.replaceWith(fragment);
  });
 };
 const site = document.querySelector('.wp-site-blocks');
 if (!site) return;
 replace(site);
 new MutationObserver(entries => entries.forEach(entry => entry.addedNodes.forEach(node => {
  if (node.nodeType === Node.ELEMENT_NODE) replace(node);
 }))).observe(site,{childList:true,subtree:true});
})();
