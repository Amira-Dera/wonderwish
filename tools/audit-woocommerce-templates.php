<?php
/** Read-only WooCommerce override audit. Run: studio wp eval-file tools/audit-woocommerce-templates.php */
$theme = get_stylesheet_directory();
$root = WC()->plugin_path() . '/templates/';
$report = array( 'woocommerce_version'=>WC_VERSION, 'overrides'=>array(), 'php_parse_errors'=>array() );
$version = static function($source) { preg_match('/@version\s+([\d.]+)/',$source,$m); return $m[1] ?? null; };
$hooks = static function($source) { preg_match_all('/do_action\(\s*[\'\"]([^\'\"]+)/',$source,$m); return array_values(array_unique($m[1])); };
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($theme.'/woocommerce',FilesystemIterator::SKIP_DOTS));
foreach ($files as $file) {
 if ('php' !== $file->getExtension()) continue;
 $relative = substr($file->getPathname(),strlen($theme.'/woocommerce/'));
 $custom = file_get_contents($file->getPathname());
 $native = is_file($root.$relative) ? file_get_contents($root.$relative) : null;
 $report['overrides'][] = array('template'=>$relative,'upstream_exists'=>null!==$native,'theme_version'=>$version($custom),'installed_version'=>$native?$version($native):null,'outdated'=>$native&&version_compare($version($custom)?:'0',$version($native)?:'0','<'),'missing_action_hooks'=>$native?array_values(array_diff($hooks($native),$hooks($custom))):array(),'resolved_to_child'=>wc_locate_template($relative)===$file->getPathname());
}
foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($theme,FilesystemIterator::SKIP_DOTS)) as $file) {
 if ('php' !== $file->getExtension()) continue;
 try {token_get_all(file_get_contents($file->getPathname()),TOKEN_PARSE);} catch(ParseError $e) {$report['php_parse_errors'][]=array('file'=>$file->getPathname(),'error'=>$e->getMessage());}
}
$report['login_security'] = array();
$source=file_get_contents($theme.'/woocommerce/myaccount/form-login.php');
foreach(array('woocommerce-login-nonce','woocommerce-register-nonce','woocommerce_login_form_start','woocommerce_register_form_start','woocommerce_register_form_tag') as $token) $report['login_security'][$token]=str_contains($source,$token);
echo wp_json_encode($report,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES)."\n";
