<?php
/**
 * Styles and scripts related functions, hooks, and filters.
 *
 * @package Luxe
 */

namespace Luxe;

/**
 * Gets the path to a versioned Mix file from the manifest.
 *
 * @author https://github.com/mindkomm/theme-lib-mix
 *
 * @since 1.0.0
 *
 * @param string $path The relative path to the file.
 * @param string $manifest_directory Optional. Custom path to manifest directory. Default 'build'.
 *
 * @return string The file URL.
 */
function mix( $path, $manifest_directory = 'public' ) {
	static $manifest;
	static $manifest_path;
	if ( ! $manifest_path ) {
		$manifest_path = get_theme_file_path( $manifest_directory . '/mix-manifest.json' );
	}
	// Bailout if manifest couldn’t be found
	if ( ! file_exists( $manifest_path ) ) {
		return get_theme_file_uri( $path );
	}
	if ( ! $manifest ) {
		// @codingStandardsIgnoreLine
		$manifest = json_decode( file_get_contents( $manifest_path ), true );
	}
	// Remove manifest directory from path
	$path = str_replace( $manifest_directory, '', $path );
	// Make sure there’s a leading slash
	$path = '/' . ltrim( $path, '/' );
	// Bailout with default theme path if file could not be found in manifest
	if ( ! array_key_exists( $path, $manifest ) ) {
		return get_theme_file_uri( $path );
	}
	// Get file URL from manifest file
	$path = $manifest[ $path ];
	// Make sure there’s no leading slash
	$path = ltrim( $path, '/' );
	return get_theme_file_uri( trailingslashit( $manifest_directory ) . $path );
}

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
		mix( 'public/scripts/app.js' ),
		null,
		null,
		true
	);

	// Add SVG icons for use in JS.
	wp_localize_script( 'luxe-app', 'menuIcons', array(
		'dropdownMenuIcon' => get_svg( 'chevron-down' ),
		'submenuToggleIcon' => get_svg( 'chevron-down' )
	) );

	// Main styles.
	wp_enqueue_style(
		'luxe-screen',
		mix( 'public/styles/screen.css' ),
		false,
		null
	);

	// Dequeue Core block styles.
	wp_dequeue_style( 'wp-blocks' );
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
		get_parent_theme_file_uri( 'scripts/styles/editor.css' ),
		false,
		null
	);
}, 10 );
