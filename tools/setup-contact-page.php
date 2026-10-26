<?php
/** Explicit CLI setup: creates Contact Us once, never overwrites manual content. */
if ( ! defined('WP_CLI') || ! WP_CLI ) throw new RuntimeException('Run using WP-CLI.');
$existing = get_page_by_path('contact-us') ?: get_page_by_path('contact');
if ($existing) { echo 'Existing contact page preserved: '.get_permalink($existing)."\n"; return; }
ob_start(); include get_stylesheet_directory().'/patterns/contact-us.php'; $content=ob_get_clean();
$id=wp_insert_post(array('post_type'=>'page','post_status'=>'publish','post_title'=>'Contact Us','post_name'=>'contact-us','post_content'=>$content),true);
if(is_wp_error($id)) throw new RuntimeException($id->get_error_message());
echo 'Contact Us created: '.get_permalink($id)."\n";
