/* Progressive panel switching only. WooCommerce owns credentials and password toggle. */
(() => {
 const root = document.querySelector('.ww-auth-card');
 const login = root?.querySelector('#ww-sign-in'), register = root?.querySelector('#ww-create-account');
 if (!login || !register) return;
 const display = (view, focus = false) => {
  const signup = view === 'register'; login.hidden = signup; register.hidden = !signup;
  if (focus) {const heading = (signup ? register : login).querySelector('h2');heading.tabIndex = -1;heading.focus({preventScroll:true});}
 };
 display(location.hash === '#ww-create-account' ? 'register' : 'login');
 root.querySelectorAll('[data-auth-view]').forEach(link => link.addEventListener('click',event => {
  event.preventDefault(); const view=link.dataset.authView;
  history.replaceState(null,'',view==='register'?'#ww-create-account':'#ww-sign-in'); display(view,true);
 }));
})();
