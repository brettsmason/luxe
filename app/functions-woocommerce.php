<?php
/**
 * WooCommerce integration.
 *
 * This file integrates the theme with WooCommerce.
 *
 * @package    Luxe
 * @subpackage Includes
 * @author     Brett Mason <brettsmason@gmail.com>
 * @copyright  Copyright (c) 2018, Brett Mason
 * @link       https://github.com/brettsmason/luxe/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Mythic;

use function Hybrid\Template\path;

/**
 * Adds theme support for the WooCommerce plugin.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'after_setup_theme', function() {

	add_theme_support( 'woocommerce', [
		'thumbnail_image_width' => 150,
		'single_image_width'    => 300,

        'product_grid'          => [
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 5,
		],
	] );
} );

/**
 * This overrides the top-level WooCommerce templates that would normally go in
 * the theme root. By default, we're looking for a `resources/views/woocommerce.php`
 * template, which falls back to `resources/views/index.php`.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $files
 * @return array
 */
add_filter( 'woocommerce_template_loader_files', function( $files ) {

	return [
		path( 'woocommerce.php' ),
		path( 'index.php' )
	];

}, PHP_INT_MAX );

/**
 * Filters the path to the `woocommerce` template parts folder.  This filter
 * moves that folder to `resources/views/woocommerce`.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $path
 * @return string
 */
add_filter( 'woocommerce_template_path', function( $path ) {

	return path( $path );
} );
