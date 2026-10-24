/* Native editor preview backed by actual WooCommerce products. */
(function (blocks, element, editor, ServerSideRender) {
 blocks.registerBlockType('wonderwish/product-stream', {
  apiVersion:3, title:'WonderWish product stream', icon:'products', category:'widgets',
  description:'Real catalogue products. Manage images, names and prices in Products.',
  supports:{html:false},
  edit:function(){return element.createElement('div',editor.useBlockProps({className:'ww-product-stream-editor'}),element.createElement('p',{},'Live WooCommerce products — edit their details under Products.'),element.createElement(ServerSideRender,{block:'wonderwish/product-stream'}));},
  save:function(){return null;}
 });
})(wp.blocks,wp.element,wp.blockEditor,wp.serverSideRender);
