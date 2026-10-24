<?php
/** Dashboard-managed .LY FAQ entries and the dynamic list block. */

add_action( 'init', function () {
	register_block_type( get_theme_file_path( 'blocks/ly-faq-list' ) );
} );
