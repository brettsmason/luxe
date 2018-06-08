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
 * @param  string  $file
 * @param  array   $attr
 * @return void
 */
function svg( $file, $args = [] ) {
	$svg = new Svg( $file, $args );
	$svg->render();
}

/**
 * Returns SVG output.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $file
 * @param  array   $attr
 * @return string
 */
function get_svg( $file, $args = [] ) {
	$svg = new Svg( $file, $args );
	return $svg->fetch();
}

/**
 * Display SVG icons in social links menu.
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function nav_menu_social_icons( $item_output, $item, $depth, $args ) {
	// Get supported social icons.
	$social_icons = social_links_icons();

	// Change SVG icon inside social links menu if there is supported URL.
	if ( 'social' === $args->theme_location ) {
		foreach ( $social_icons as $attr => $value ) {
			if ( false !== strpos( $item_output, $attr ) ) {
				$item_output = str_replace( $args->link_after, '</span>' . get_svg( esc_attr( $value ) ), $item_output );
			}
		}
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', __NAMESPACE__ . '\nav_menu_social_icons', 10, 4 );

/**
 * Add dropdown icon if menu item has children.
 *
 * @param  string  $title The menu item's title.
 * @param  WP_Post $item  The current menu item.
 * @param  array   $args  An array of wp_nav_menu() arguments.
 * @param  int     $depth Depth of menu item. Used for padding.
 * @return string  $title The menu item's title with dropdown icon.
 */
function dropdown_icon_to_menu_link( $title, $item, $args, $depth ) {
	if ( 'primary' === $args->theme_location ) {
		foreach ( $item->classes as $value ) {
			if ( 'menu-item-has-children' === $value || 'page_item_has_children' === $value ) {
				$title = $title . get_svg( 'chevron-down' );
			}
		}
	}

	return $title;
}
// add_filter( 'nav_menu_item_title', __NAMESPACE__ . '\dropdown_icon_to_menu_link', 10, 4 );

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
