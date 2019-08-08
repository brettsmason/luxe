<?php
/**
 * Theme setup functions.
 *
 * This file holds basic theme setup functions executed on appropriate hooks with
 * some opinionated priorities based on theme dev, particularly working with child
 * theme devs/users, over the years. I've also decided to use anonymous functions
 * to keep these from being easily unhooked. WordPress has an appropriate API for
 * unregistering, removing, or modifying all of the things in this file.  Those APIs
 * should be used instead of attempting to use `remove_action()`.
 *
 * @package    Luxe
 * @subpackage Includes
 * @author     Brett Mason <brettsmason@gmail.com>
 * @copyright  Copyright (c) 2018, Brett Mason
 * @link       https://github.com/brettsmason/luxe/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Luxe;

/**
 * Set up theme support.  This is where calls to `add_theme_support()` happen.
 *
 * @link   https://developer.wordpress.org/reference/functions/add_theme_support/
 * @link   https://developer.wordpress.org/themes/basics/theme-functions/
 * @link   https://developer.wordpress.org/reference/functions/load_theme_textdomain/
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'after_setup_theme', function() {

	// Set content width.
	$GLOBALS['content_width'] = 1024;

	// Load theme translations.
	load_theme_textdomain( 'luxe', get_parent_theme_file_path( 'resources/lang' ) );

	// Automatically add feed links to `<head>`.
	add_theme_support( 'automatic-feed-links' );

	// Outputs HTML5 markup for core features.
	add_theme_support( 'html5', [
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'search-form',
	] );

	// Add title tag support.
	add_theme_support( 'title-tag' );

	// Adds featured image support.
	add_theme_support( 'post-thumbnails' );

	// Add selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for editor color palette.
	add_theme_support( 'editor-color-palette', [
		[
			'name'  => __( 'Primary', 'luxe' ),
			'slug'  => 'primary',
			'color' => '#544882',
		],
		[
			'name'  => __( 'Secondary', 'luxe' ),
			'slug'  => 'secondary',
			'color' => '#292f36',
		],
		[
			'name'  => __( 'White', 'luxe' ),
			'slug'  => 'white',
			'color' => '#fff',
		],
		[
			'name'  => __( 'Black', 'luxe' ),
			'slug'  => 'black',
			'color' => '#000',
		],
	] );

	// Editor stylesheet.
	add_theme_support( 'editor-styles' );
	add_editor_style( 'public/css/editor.css' );

	// Disable custom colors in block color palettes.
	add_theme_support( 'disable-custom-colors' );

	// Add support for align wide blocks.
	add_theme_support( 'align-wide' );

	// Add support for custom logo.
	add_theme_support( 'custom-logo', [
		'width'       => 300,
		'height'      => 200,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => [ 'app-header__title', 'app-header__description' ],
	] );
}, 5 );

/**
 * Adds support for the custom background feature. This is in its own function
 * hooked to `after_setup_theme` so that we can give it a later priority. This
 * is so that child themes can more easily overwrite this feature. Note that
 * overwriting the background should be done *before* rather than after.
 *
 * @link   https://developer.wordpress.org/reference/functions/add_theme_support/#custom-background
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'after_setup_theme', function() {
	add_theme_support( 'custom-background' );
}, 15 );

add_action( 'after_setup_theme', function() {
	add_theme_support( 'custom-header' );
}, 15 );

/**
 * Register menus.
 *
 * @link   https://developer.wordpress.org/reference/functions/register_nav_menus/
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'init', function() {

	register_nav_menus( [
		'primary'    => esc_html_x( 'Primary', 'nav menu location', 'luxe' ),
		'subsidiary' => esc_html_x( 'Subsidiary', 'nav menu location', 'luxe' ),
	] );

}, 5 );

/**
 * Register image sizes.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'init', function() {

	// Set the `post-thumbnail` size.
	set_post_thumbnail_size( 739, 493, true );
}, 5 );

/**
 * Register sidebars.
 *
 * @link   https://developer.wordpress.org/reference/functions/register_sidebar/
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'widgets_init', function() {
	$args = [
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget__title u-h5">',
		'after_title'   => '</h2>',
	];

	register_sidebar( [
		'id'   => 'primary',
		'name' => esc_html_x( 'Primary', 'sidebar', 'luxe' ),
	] + $args );

	register_sidebar( [
		'id'   => 'subsidiary',
		'name' => esc_html_x( 'Subsidiary', 'sidebar', 'luxe' ),
	] + $args );
}, 5 );
