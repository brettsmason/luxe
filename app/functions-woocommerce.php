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

namespace Luxe;

use function Hybrid\Template\path;

// If WooCommerce isn't enabled then bail early.
if ( ! class_exists( 'woocommerce' ) ) {
	return;
}

/**
 * Adds theme support for the WooCommerce plugin.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'after_setup_theme', function() {

	add_theme_support( 'woocommerce', [
		'thumbnail_image_width' => 300,
		'single_image_width'    => 600,

        'product_grid'          => [
            'default_rows'    => 4,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 6,
		],
	] );

	// add_theme_support( 'wc-product-gallery-zoom' );
    // add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
} );

/**
 * Remove WooCommerce default styles.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

/**
 * Enqueue WooCommerce custom styles.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {

	// Main block styles.
	wp_enqueue_style(
		'luxe-woocommerce',
		asset( 'css/woocommerce.css' ),
		false,
		null
	);
}, 10 );

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

// Add a wrapper around the the product sorting dropdown and count.
// Allows for an easier time styling.
add_action( 'woocommerce_before_shop_loop', function() {
	echo '<div class="woocommerce-sorting">';
}, PHP_INT_MIN );

// Close the above wrapper.
add_action( 'woocommerce_before_shop_loop', function() {
	echo '</div>';
}, PHP_INT_MAX );

// Remove WooCommerce pagination as we are using our own.
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

// Add our pagination in place of WooCommerce.
add_action( 'woocommerce_after_shop_loop', function() {
	\Hybrid\View\display( 'partials', 'pagination-posts' );
}, PHP_INT_MAX );

// Remove add to cart button from archive view.
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

add_action( 'woocommerce_checkout_after_customer_details', function() {
	echo '<div class="woocommerce-checkout__order-details">';
} );

add_action( 'woocommerce_checkout_after_order_review', function() {
	echo '</div>';
} );
