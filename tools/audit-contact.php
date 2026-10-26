<?php
/** Local offline tests; uses a fake mail callable, never sends email. */
if(!defined('WP_CLI') || !WP_CLI || !in_array(wp_parse_url(home_url(),PHP_URL_HOST),array('localhost','127.0.0.1','::1'),true)) throw new RuntimeException('Local CLI only.');
$original_ip=$_SERVER['REMOTE_ADDR']??null;
$_SERVER['REMOTE_ADDR']='contact-offline-audit';
$key='ww_contact_'.hash_hmac('sha256',$_SERVER['REMOTE_ADDR'],wp_salt('nonce'));
delete_transient($key);
$calls=array();
$send=static function(...$args)use(&$calls){$calls[]=$args;return true;};
$base=array('ww_name'=>'Preview Visitor','ww_email'=>'preview@example.invalid','ww_message'=>'Offline design test only.','ww_contact_nonce'=>wp_create_nonce('wonderwish_contact'),'ww_website'=>'');
$checks=array();
try {
 foreach(array('bad_nonce'=>array('ww_contact_nonce'=>'invalid'),'invalid_email'=>array('ww_email'=>'invalid'),'empty_message'=>array('ww_message'=>''),'honeypot'=>array('ww_website'=>'spam'),'array_input'=>array('ww_email'=>array('bad')),'long_message'=>array('ww_message'=>str_repeat('a',5001))) as $label=>$change){
  $r=wonderwish_contact_submission(array_merge($base,$change),$send); $checks[$label]=!$r['sent'];
 }
 $checks['invalid_never_sends']=!$calls;
 $r=wonderwish_contact_submission($base,$send);
 $checks['valid_sent']=$r['sent']&&count($calls)===1;
 $checks['recipient_and_reply_to']=$calls[0][0]==='info@wonderwish.ly'&&in_array('Reply-To: preview@example.invalid',$calls[0][3],true);
 $r=wonderwish_contact_submission($base,static function(){return false;});
 $checks['delivery_failure_visible']=!$r['sent']&&str_contains($r['notice'],'couldn’t send')&&$r['values']['message']===$base['ww_message'];
 set_transient($key,5,60);
 $r=wonderwish_contact_submission($base,$send);$checks['rate_limit']=!$r['sent']&&count($calls)===1;
 $p=get_page_by_path('contact-us');
 $checks['native_form_block']=has_block('wonderwish/contact-form',$p->post_content)&&!str_contains($p->post_content,'ww-contact-questions');
 echo wp_json_encode(array('actual_mail_sent'=>false,'checks'=>$checks),JSON_PRETTY_PRINT)."\n";
 if(in_array(false,$checks,true)) throw new RuntimeException('Contact checks failed.');
} finally {delete_transient($key);if(null===$original_ip)unset($_SERVER['REMOTE_ADDR']);else $_SERVER['REMOTE_ADDR']=$original_ip;}
