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
add_filter( 'excerpt_more', __NAMESPACE__ . '\\excerpt_more' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function body_class( $classes ) {

	// Adds a class of has-sidebar when the sidebar is enabled and is active.
	if ( \is_active_sidebar( 'primary' ) && display_sidebar() ) {
		$classes[] = 'has-sidebar-primary';
	}

	return $classes;
}
add_filter( 'body_class', __NAMESPACE__ . '\\body_class' );
