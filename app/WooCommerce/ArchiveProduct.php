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

/**
 * Functionality specific to product archives.
 *
 * @since  1.0.0
 * @access public
 */
class ArchiveProduct implements Bootable {

	/**
	 * Adds actions on the appropriate action hooks.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		// Remove add to cart button from archive view.
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

		// Remove WooCommerce pagination as we are using our own.
		remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

		// Add our pagination in place of WooCommerce'.
		add_action( 'woocommerce_after_shop_loop', [ $this, 'pagination' ], PHP_INT_MAX );
	}

	/**
	 * Add custom pagination.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function pagination() {
		\Hybrid\View\display( 'partials', 'pagination-posts' );
	}
}
