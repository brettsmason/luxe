<?php
/**
 * Styles and scripts related functions, hooks, and filters.
 *
 * @package Luxe
 */

namespace Luxe;

use function Hybrid\app;

/**
 * Enqueue scripts/styles.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {

	// Main scripts.
	wp_enqueue_script(
		'luxe-app',
		asset( 'scripts/app.js' ),
		null,
		false,
		true
	);

	// Add SVG icons for use in JS.
	wp_localize_script( 'luxe-app', 'menuIcons', array(
		'dropdownMenuIcon'  => get_svg( 'chevron-down', [ 'class' => 'menu__dropdown-icon' ] ),
		'submenuToggleIcon' => get_svg( 'chevron-down', [ 'class' => 'menu__submenu-toggle-icon' ] ),
	) );

	// Main styles.
	wp_enqueue_style(
		'luxe-screen',
		asset( 'styles/screen.css' ),
		false,
		null
	);

	// Dequeue Core block styles.
	wp_dequeue_style( 'wp-core-blocks' );
}, 10 );

/**
 * Enqueue editor scripts/styles.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'enqueue_block_editor_assets', function() {

	// Main block styles.
	wp_enqueue_style(
		'luxe/editor.css',
		asset( 'styles/editor.css' ),
		false,
		null
	);
}, 10 );

/**
 * Helper function for outputting an asset URL in the theme. This integrates
 * with Laravel Mix for handling cache busting. If used when you enqueue a script
 * or style, it'll append an ID to the filename.
 *
 * @link   https://laravel.com/docs/5.6/mix#versioning-and-cache-busting
 * @since  1.0.0
 * @access public
 * @param  string  $path
 * @return string
 */
function asset( $path ) {
	// Get the Laravel Mix manifest.
	$manifest = mix();
	// Make sure to trim any slashes from the front of the path.
	$path = '/' . ltrim( $path, '/' );
	if ( $manifest && isset( $manifest[ $path ] ) ) {
		$path = $manifest[ $path ];
	}
	return get_theme_file_uri( 'public' . $path );
}
/**
 * Returns the Laravel Mix manifest.
 *
 * Note that `file_get_contents()` is not allowed on WordPress.org. If building
 * a theme for the WP directory, you'll need to remove this function and the
 * reference to it in the `asset()` function.
 *
 * @link   https://github.com/WordPress/theme-check/issues/55
 * @link   https://wordpress.stackexchange.com/questions/166161/why-cant-the-wp-filesystem-api-read-googlefonts-json/166175
 *
 * @since  1.0.0
 * @access public
 * @return array|false
 */
function mix() {
	$manifest = app( 'luxe/mix' );
	// If there is no manifest saved yet, let's see if we can find one.
	if ( ! $manifest ) {
		$file = get_theme_file_path( 'public/mix-manifest.json' );
		if ( file_exists( $file ) ) {
			$manifest = json_decode( file_get_contents( $file ), true );
			if ( $manifest ) {
				app()->add( 'public/mix', $manifest );
			}
		}
	}
	return $manifest;
}
