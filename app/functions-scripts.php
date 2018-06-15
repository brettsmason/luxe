<?php
/**
 * Styles and scripts related functions, hooks, and filters.
 *
 * @package Luxe
 */

namespace Luxe;

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
		null,
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
		asset( 'styles/editor.css' ),
		false,
		null
	);
}, 10 );
