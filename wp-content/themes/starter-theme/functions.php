<?php
/** Theme assets and named core-block styles. */

require_once get_theme_file_path( 'inc/why-faq.php' );
require_once get_theme_file_path( 'inc/site-menus.php' );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'starter-theme', get_theme_file_uri( 'assets/css/success-stories.css' ), array(), filemtime( get_theme_file_path( 'assets/css/success-stories.css' ) ) );
	wp_enqueue_script( 'starter-theme-site-header', get_theme_file_uri( 'assets/js/site-header.js' ), array(), filemtime( get_theme_file_path( 'assets/js/site-header.js' ) ), array( 'strategy' => 'defer', 'in_footer' => true ) );
	if ( is_page_template( 'page-success-stories' ) ) {
		wp_enqueue_script( 'starter-theme-success-stories-motion', get_theme_file_uri( 'assets/js/success-stories.js' ), array(), filemtime( get_theme_file_path( 'assets/js/success-stories.js' ) ), array( 'strategy' => 'defer', 'in_footer' => true ) );
	}
	if ( is_page_template( 'page-why-choose-ly' ) ) {
		wp_enqueue_style( 'starter-theme-why-choose', get_theme_file_uri( 'assets/css/why-choose-ly.css' ), array( 'starter-theme' ), filemtime( get_theme_file_path( 'assets/css/why-choose-ly.css' ) ) );
		wp_enqueue_script( 'starter-theme-why-choose-motion', get_theme_file_uri( 'assets/js/why-choose-ly.js' ), array(), filemtime( get_theme_file_path( 'assets/js/why-choose-ly.js' ) ), array( 'strategy' => 'defer', 'in_footer' => true ) );
	}
} );

add_action( 'enqueue_block_editor_assets', function () {
	wp_enqueue_style( 'starter-theme-editor', get_theme_file_uri( 'assets/css/success-stories.css' ), array(), filemtime( get_theme_file_path( 'assets/css/success-stories.css' ) ) );
	wp_enqueue_style( 'starter-theme-why-choose-editor', get_theme_file_uri( 'assets/css/why-choose-ly.css' ), array( 'starter-theme-editor' ), filemtime( get_theme_file_path( 'assets/css/why-choose-ly.css' ) ) );
} );

add_action( 'init', function () {
	$styles = array(
		'core/group' => array(
			'success-page' => 'Success page', 'success-header' => 'Success header',
			'success-hero' => 'Success hero', 'success-section' => 'Success section',
			'success-card' => 'Success story card', 'success-process' => 'Success process',
			'success-cta' => 'Success call to action', 'success-footer' => 'Success footer',
			'why-page' => 'Why Choose page', 'why-hero' => 'Why Choose hero',
			'why-brands' => 'Why brands choose .LY', 'why-word-card' => 'Word ending card',
			'why-metric-card' => 'Short by nature card', 'why-marketing-card' => 'Marketing card',
			'why-world-card' => 'World recognition card',
			'why-features' => 'Domain management features',
			'why-feature-card' => 'Domain management feature card',
			'why-feature-cta' => 'Domain management call to action',
			'why-faq' => 'Why Choose FAQs',
			'why-hack-cta' => 'Domain hack call to action',
		),
		'core/paragraph' => array( 'why-pill' => 'Domain example badge' ),
		'core/buttons' => array( 'success-actions' => 'Success actions' ),
		'core/button' => array( 'success-outline' => 'Success outline' ),
		'core/heading' => array(
			'success-brand-green' => 'Green brand',
			'success-brand-cyan' => 'Cyan brand',
			'success-brand-orange' => 'Orange brand',
		),
	);
	foreach ( $styles as $block => $block_styles ) {
		foreach ( $block_styles as $name => $label ) {
			register_block_style( $block, array( 'name' => $name, 'label' => $label ) );
		}
	}
} );
