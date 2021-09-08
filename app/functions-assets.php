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
add_action(
	'wp_enqueue_scripts',
	function() {

		// Load WordPress' comment-reply script where appropriate.
		if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Main scripts.
		wp_enqueue_script(
			'luxe-app',
			asset( 'js/app.js' ),
			null,
			null,
			true
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
	},
	10
);

/**
 * Helper function for outputting an asset URL in the theme.
 * If used when you enqueue a script or style, it'll append an ID to the filename.
 *
 * @since  1.0.0
 * @access public
 * @param  string $path The path to the asset.
 * @return string
 */
function asset( $path ) {

	// Get the manifest.
	$manifest = App::resolve( 'luxe/manifest' );

	if ( $manifest && isset( $manifest[ $path ] ) ) {
		$path = $manifest[ $path ];
	}

	return get_theme_file_uri( 'public/' . $path );
}
