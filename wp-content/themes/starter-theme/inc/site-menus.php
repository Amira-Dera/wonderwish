<?php
/** Classic menu management for the shared block-theme header. */

add_action( 'after_setup_theme', function () {
	register_nav_menus( array( 'primary' => __( 'Header menu (desktop and mobile)', 'starter-theme' ) ) );
} );

/**
 * Populate the new menu location once, without changing an existing menu.
 * Subsequent edits and assignments are owned entirely by Appearance > Menus.
 */
add_action( 'init', function () {
	if ( get_option( 'starter_theme_primary_menu_initialized' ) ) {
		return;
	}

	$locations = get_nav_menu_locations();
	if ( ! empty( $locations['primary'] ) ) {
		update_option( 'starter_theme_primary_menu_initialized', 1 );
		return;
	}

	$menu = wp_get_nav_menu_object( 'Main Menu' );
	if ( ! $menu ) {
		$menu_id = wp_create_nav_menu( 'Main Menu' );
		if ( is_wp_error( $menu_id ) ) {
			return;
		}

		$items = array(
			'.LY Domains' => 'menu-icon-globe',
			'Domains'     => 'menu-icon-globe',
			'Hosting'     => 'menu-icon-hosting',
			'Emails'      => 'menu-icon-email',
			'Support'     => 'menu-icon-support',
		);
		foreach ( $items as $label => $icon_class ) {
			$parent_id = wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title'   => $label,
				'menu-item-url'     => '#',
				'menu-item-classes' => $icon_class,
				'menu-item-status'  => 'publish',
			) );
			if ( '.LY Domains' === $label && ! is_wp_error( $parent_id ) && get_post( 7 ) ) {
				wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-title'     => '.LY Success Stories',
					'menu-item-classes'   => 'menu-mega-icon-success-stories',
					'menu-item-object'    => 'page',
					'menu-item-object-id' => 7,
					'menu-item-type'      => 'post_type',
					'menu-item-parent-id' => $parent_id,
					'menu-item-status'    => 'publish',
				) );
			}
		}
	} else {
		$menu_id = $menu->term_id;
	}

	$locations['primary'] = (int) $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );
	update_option( 'starter_theme_primary_menu_initialized', 1 );
} );

/** Use the assigned classic menu as the core Navigation block's live content. */
add_filter( 'render_block_data', function ( $parsed_block ) {
	if ( 'core/navigation' !== ( $parsed_block['blockName'] ?? '' ) ||
		false === strpos( $parsed_block['attrs']['className'] ?? '', 'success-header-nav' ) ) {
		return $parsed_block;
	}

	$locations = get_nav_menu_locations();
	$menu      = isset( $locations['primary'] ) ? wp_get_nav_menu_object( $locations['primary'] ) : false;
	if ( ! $menu || is_wp_error( $menu ) ) {
		return $parsed_block;
	}

	$markup = WP_Classic_To_Block_Menu_Converter::convert( $menu );
	if ( is_wp_error( $markup ) ) {
		return $parsed_block;
	}

	$parsed_block['innerBlocks']  = parse_blocks( $markup );
	$parsed_block['innerHTML']    = '';
	$parsed_block['innerContent'] = array_fill( 0, count( $parsed_block['innerBlocks'] ), null );
	return $parsed_block;
} );

/** An assigned but empty menu should leave the header navigation empty. */
add_filter( 'pre_render_block', function ( $pre_render, $parsed_block ) {
	if ( 'core/navigation' !== ( $parsed_block['blockName'] ?? '' ) ||
		false === strpos( $parsed_block['attrs']['className'] ?? '', 'success-header-nav' ) ) {
		return $pre_render;
	}
	$locations = get_nav_menu_locations();
	if ( empty( $locations['primary'] ) || ! wp_get_nav_menu_items( $locations['primary'] ) ) {
		return '';
	}
	return $pre_render;
}, 10, 2 );
