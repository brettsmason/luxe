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
add_filter( 'hybrid/svg/path', function() {
	return '/public/svg/';
}, 10 );

/**
 * Filters the WP nav menu link attributes.
 *
 * @param array    $atts {
 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
 *
 *     @type string $title  Title attribute.
 *     @type string $target Target attribute.
 *     @type string $rel    The rel attribute.
 *     @type string $href   The href attribute.
 * }
 * @param WP_Post  $item  The current menu item.
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @param int      $depth Depth of menu item. Used for padding.
 * @return string  $attr
 */
add_filter( 'nav_menu_link_attributes', function( $atts, $item, $args, $depth ) {
	$atts['class'] = 'menu__anchor menu__anchor--' . $args->theme_location;

	if ( in_array( 'current-menu-item', $item->classes, true ) ) {
		$atts['class'] .= ' is-active';
	}

	if ( in_array( 'button', $item->classes, true ) ) {
		$atts['class'] .= ' menu__anchor--button';
	}

	return $atts;
}, 10, 4 );

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
