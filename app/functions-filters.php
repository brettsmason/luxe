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
add_filter( 'excerpt_more', __NAMESPACE__ . '\excerpt_more' );

/**
 * Modify the `custom_logo` core function based on our class preferences.
 *
 * @param string $html The custom logo HTML markup.
 * @return string The modified custom logo HTML markup.
 */
function get_custom_logo( $html ) {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$html           = sprintf(
		'<a href="%1$s" class="%2$s" rel="home" itemprop="url">%3$s</a>',
		esc_url( home_url( '/' ) ),
		'app-header__logo-link',
		wp_get_attachment_image(
			$custom_logo_id, 'full', false, array(
				'class'    => 'app-header__logo',
				'itemprop' => 'logo',
				'alt'      => esc_attr( get_bloginfo( 'name' ) ),
			)
		)
	);
	return $custom_logo_id ? $html : null;
}
add_filter( 'get_custom_logo', __NAMESPACE__ . '\get_custom_logo' );

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
add_filter( 'body_class', __NAMESPACE__ . '\body_class' );

/**
 * Display the primary sidebar or not.
 * Simply add conditional checks and return true to display for that condition.
 *
 * @return bool
 */
function display_primary_sidebar() {
	if ( is_page_template( 'resources/views/templates/sidebar-right.php' ) ) {
		return true;
	}
}
add_filter( 'luxe/display_sidebar', __NAMESPACE__ . '\display_primary_sidebar' );

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
				$item_output = str_replace( $args->link_after, '</span>' . fetch_svg( esc_attr( $value ) ), $item_output );
			}
		}
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', __NAMESPACE__ . '\nav_menu_social_icons', 10, 4 );
