<?php
/**
 * WooCommerce class.
 *
 * @package   Luxe
 * @author    Brett Mason <brettsmason@gmail.com>
 * @copyright Copyright (c) 2018, Brett Mason
 * @link      https://github.com/brettsmason/luxe
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Luxe\WooCommerce;

use Hybrid\Contracts\Bootable;
use function Hybrid\Template\path;
use function Luxe\asset;

/**
 * Handles setting up everything we need for WooCommerce.
 *
 * @since  1.0.0
 * @access public
 */
class Setup implements Bootable {

	/**
	 * Adds actions on the appropriate action hooks.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		// Register theme support for WooCommerce features.
		add_action( 'after_setup_theme', [ $this, 'register' ] );

		// Set path to WooCommerce templates.
		add_filter( 'woocommerce_template_loader_files', [ $this, 'templateLoaderFiles' ], PHP_INT_MAX );

		// Moves the WooCommerce template path.
		add_filter( 'woocommerce_template_path', [ $this, 'templatePath' ] );

		// Disable WooCommerce core styles.
		// add_filter( 'woocommerce_enqueue_styles', [ $this, 'disableCoreStyles' ] );

		// Add custom WooCommerce styles.
		add_action( 'wp_enqueue_scripts', [ $this, 'styles' ], 10 );
	}

	/**
	 * Add theme support for WooCommerce features.
	 *
	 * @link https://docs.woocommerce.com/document/woocommerce-theme-developer-handbook/
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

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

		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}

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
	public function templateLoaderFiles( $files ) {

		return [
			path( 'index.php' ),
		];
	}

	/**
	 * Filters the path to the `woocommerce` template parts folder.  This filter
	 * moves that folder to `resources/views/woocommerce`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $path
	 * @return string
	 */
	public function templatePath( $path ) {

		return path( $path );
	}

	/**
	 * Disable core WooCommerce stylesheets.
	 */
	public function disableCoreStyles() {
		return [];
	}

	/**
	 * Enqueue WooCommerce custom styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function styles() {

		wp_enqueue_style(
			'luxe-woocommerce',
			asset( 'css/woocommerce.css' ),
			false,
			null
		);
	}
}
