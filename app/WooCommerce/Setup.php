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
use Luxe\Tools\Mix;

/**
 * Handles setting up everything we need for WooCommerce.
 *
 * @since  1.0.0
 * @access public
 */
class Setup implements Bootable {

	/**
	 * Bootstraps the class' actions/filters.
	 *
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

		// Remove WooCommerce default wrappers.
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
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
	 *
	 * @param array $enqueue_styles
	 * @return array
	 */
	public function disableCoreStyles( $enqueue_styles ) {

		unset( $enqueue_styles['woocommerce-general'] );     // Remove the gloss.
		unset( $enqueue_styles['woocommerce-layout'] );      // Remove the layout.
		unset( $enqueue_styles['woocommerce-smallscreen'] ); // Remove the smallscreen optimisation.

		return $enqueue_styles;
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
			Mix::asset( 'css/woocommerce.css' ),
			false,
			null
		);
	}
}
