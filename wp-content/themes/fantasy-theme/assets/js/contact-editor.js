(function (blocks, element, ServerSideRender) {
 blocks.registerBlockType('wonderwish/contact-form', {
  apiVersion: 3, title: 'WonderWish Contact Form', icon: 'email-alt', category: 'widgets',
  description: 'Name, email and message form. Enquiries are sent to info@wonderwish.ly.',
  supports: {html: false},
  edit: function () { return element.createElement('div', {style: {pointerEvents: 'none'}}, element.createElement(ServerSideRender, {block: 'wonderwish/contact-form'})); },
  save: function () { return null; }
 });
})(window.wp.blocks, window.wp.element, window.wp.serverSideRender);
