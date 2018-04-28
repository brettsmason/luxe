<?php
/**
 * Styles and scripts related functions, hooks, and filters.
 *
 * @package XYZ
 */

namespace XYZ;

/**
 * Enqueue scripts/styles.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {

	// Get version.
	$version = wp_get_theme( get_template() )->get( 'Version' );

	// Main scripts.
	wp_enqueue_script(
		'xyz-app',
		get_parent_theme_file_uri( 'public/scripts/app.js' ),
		null,
		$version,
		true
	);

	// Main styles.
	wp_enqueue_style(
		'xyz-screen',
		get_parent_theme_file_uri( 'public/styles/screen.css' ),
		null,
		$version
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

	// Get version.
	$version = wp_get_theme( get_template() )->get( 'Version' );

	// Main block styles.
	wp_enqueue_style(
		'xyz/editor.css',
		get_parent_theme_file_uri( 'scripts/styles/editor.css' ),
		null,
		$version
	);
}, 10 );
