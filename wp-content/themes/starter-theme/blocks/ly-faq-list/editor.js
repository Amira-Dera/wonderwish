(function (blocks, element, serverSideRender) {
  var createElement = element.createElement;
  blocks.registerBlockType('starter-theme/ly-faq-list', {
    edit: function () {
      return createElement('div', { className: 'ly-faq-editor-preview' },
        createElement(serverSideRender, { block: 'starter-theme/ly-faq-list' })
      );
    },
    save: function () { return null; }
  });
})(window.wp.blocks, window.wp.element, window.wp.serverSideRender);
