<?php
/**
 * Styles and scripts related functions, hooks, and filters.
 *
 * @package Luxe
 */

namespace Luxe;

use Hybrid\App;

/**
 * Enqueue scripts/styles.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {

	// Load WordPress' comment-reply script where appropriate.
	if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Main scripts.
	wp_enqueue_script(
		'luxe-app',
		asset( 'js/app.js' ),
		null,
		false,
		true
	);

	// Add SVG icons for use in JS.
	wp_localize_script(
		'luxe-app', 'menuIcons', [
			'dropdownMenuIcon'  => Svg\render( 'chevron-down', [ 'class' => 'menu__dropdown-icon' ] ),
			'submenuToggleIcon' => Svg\render( 'chevron-down', [ 'class' => 'menu__submenu-toggle-icon' ] ),
		]
	);

	// Main styles.
	wp_enqueue_style(
		'luxe-screen',
		asset( 'css/screen.css' ),
		false,
		null
	);

	// Dequeue Core block styles.
	wp_dequeue_style( 'wp-block-library' );
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
		'luxe-editor',
		asset( 'css/editor.css' ),
		false,
		null
	);

	// Overwrite Core block styles with empty styles.
	wp_deregister_style( 'wp-block-library' );
	wp_deregister_style( 'wp-block-library-theme' );

	// Overwrite Core theme styles with empty styles.
	wp_register_style( 'wp-block-library', '' );
	wp_register_style( 'wp-block-library-theme', '' );
}, 10 );

/**
 * Helper function for outputting an asset URL in the theme. This integrates
 * with Laravel Mix for handling cache busting. If used when you enqueue a script
 * or style, it'll append an ID to the filename.
 *
 * @link   https://laravel.com/docs/5.6/mix#versioning-and-cache-busting
 * @since  1.0.0
 * @access public
 * @param  string $path The path to the asset.
 * @return string
 */
function asset( $path ) {

	// Get the Laravel Mix manifest.
	$manifest = App::resolve( 'luxe/mix' );

	// Make sure to trim any slashes from the front of the path.
	$path = '/' . ltrim( $path, '/' );

	if ( $manifest && isset( $manifest[ $path ] ) ) {
		$path = $manifest[ $path ];
	}

	return get_theme_file_uri( 'public' . $path );
}
