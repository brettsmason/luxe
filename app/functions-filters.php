<?php
/**
 * Filter functions.
 *
 * This file holds functions that are used for filtering.
 *
 * @package   Luxe
 */

namespace Luxe;

/**
 * Set the path to our SVGs.
 * Used for the `Hybrid\svg` and `Hybrid\get_svg` functions.
 *
 * @return string Path to our SVGs.
 */
function hybrid_svg_path() {
	return 'public/svg';
}
add_filter( 'hybrid/svg/path', __NAMESPACE__ . '\hybrid_svg_path', 10 );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf(
		'<p class="link-more"><a href="%1$s" class="more-link" aria-hidden="true" tabindex="-1">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'luxe' ), get_the_title( get_the_ID() ) )
	);

	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', __NAMESPACE__ . '\excerpt_more' );

/**
 * Modify the `custom_logo` core function based on our class preferences.
 *
 * @param string $html The custom logo HTML markup.
 * @return string The modified custom logo HTML markup.
 */
function get_custom_logo( $html ) {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$html = sprintf( '<a href="%1$s" class="%2$s" rel="home" itemprop="url">%3$s</a>',
		esc_url( home_url( '/' ) ),
		'app-header__logo-anchor',
		wp_get_attachment_image( $custom_logo_id, 'full', false, array(
			'class'    => 'app-header__logo',
			'itemprop' => 'logo',
			'alt' => esc_attr( get_bloginfo( 'name' ) ),
		) )
	);
	return $html;
}
add_filter( 'get_custom_logo', __NAMESPACE__ . '\get_custom_logo' );
