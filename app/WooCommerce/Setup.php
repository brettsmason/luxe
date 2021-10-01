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
		add_action( 'after_setup_theme', [ $this, 'supports' ] );

		// Disable WooCommerce core styles.
		add_filter( 'woocommerce_enqueue_styles', [ $this, 'disableCoreStyles' ] );

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
	public function supports() {

		add_theme_support(
			'woocommerce',
			[
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
			]
		);

		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
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
