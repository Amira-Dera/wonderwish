<?php
/** Compatibility for WooCommerce stock reservations on Studio's SQLite driver. */
defined( 'ABSPATH' ) || exit;
add_filter( 'query', function ( $sql ) {
 if ( ! defined( 'DB_ENGINE' ) || 'sqlite' !== DB_ENGINE ) return $sql;
 global $wpdb;
 // Only WooCommerce's atomic reservation INSERT. Preserve quantity predicates,
 // locks, expiry duration and upsert behavior; never bypass stock validation.
 if ( empty( $wpdb->wc_reserved_stock ) || 0 !== strpos( ltrim( $sql ), 'INSERT INTO ' . $wpdb->wc_reserved_stock . ' ' ) || false === strpos( $sql, 'ON DUPLICATE KEY UPDATE' ) ) return $sql;
 // SQLite Integration 3.0.2 translates DATE_ADD, but not NOW() + INTERVAL here.
 return preg_replace( '/\(\s*NOW\(\)\s*\+\s*INTERVAL\s+(\d+)\s+MINUTE\s*\)/i', 'DATE_ADD( NOW(), INTERVAL $1 MINUTE )', $sql );
} );
