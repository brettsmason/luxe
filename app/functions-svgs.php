<?php
/**
 * SVG icons related functions and filters
 *
 * @package Luxe
 */

namespace Luxe;

/**
 * Renders SVG output.
 *
 * @since  1.0.0
 * @access public
 * @param  string $file The SVG file.
 * @param  array  $args An array or arguements to apply to the SVG.
 * @return void
 */
function display_svg( $file, $args = [] ) {
	$svg = new Svg( $file, $args );
	$svg->display();
}

/**
 * Returns SVG output.
 *
 * @since  1.0.0
 * @access public
 * @param  string $file The SVG file.
 * @param  array  $args An array or arguements to apply to the SVG.
 * @return string
 */
function render_svg( $file, $args = [] ) {
	$svg = new Svg( $file, $args );
	return $svg->render();
}

/**
 * Returns an array of supported social links (URL and icon name).
 *
 * @return array $social_links_icons
 */
function social_links_icons() {
	// Supported social links icons.
	$social_links_icons = [
		'facebook.com'    => 'facebook',
		'instagram.com'   => 'instagram',
		'linkedin.com'    => 'linkedin',
		'medium.com'      => 'medium',
		'pinterest.com'   => 'pinterest',
		'twitter.com'     => 'twitter',
		'vimeo.com'       => 'vimeo',
		'youtube.com'     => 'youtube',
	];

	/**
	 * Filter social links icons.
	 *
	 * @param array $social_links_icons Array of social links icons.
	 */
	return apply_filters( 'luxe_social_links_icons', $social_links_icons ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
}
