<?php
/**
 * WooCommerce service provider.
 *
 * Service providers are essentially the bootstrapping code for your theme.
 * They allow you to add bindings to the container on registration and boot them
 * once everything has been registered.
 *
 * @package   Luxe
 * @author    Brett Mason <brettsmason@gmail.com>
 * @copyright Copyright (c) 2018, Brett Mason
 * @link      https://github.com/brettsmason/luxe
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Luxe\Providers;

use Hybrid\Core\ServiceProvider;
use Luxe\WooCommerce\Setup;
use Luxe\WooCommerce\ArchiveProduct;

/**
 * App service provider.
 *
 * @since  1.0.0
 * @access public
 */
class WooCommerceServiceProvider extends ServiceProvider {

	/**
	 * Callback executed when the `\Hybrid\Core\Application` class registers
	 * providers. Use this method to bind items to the container.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Bind a single instance of our WooCommerce classes.
		$this->app->singleton( Setup\Setup::class );
		$this->app->singleton( ArchiveProduct\ArchiveProduct::class );
	}

	/**
	 * Callback executed after all the service providers have been registered.
	 * This is particularly useful for single-instance container objects that
	 * only need to be loaded once per page and need to be resolved early.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		// Boot the WooCommerce class instances.
		$this->app->resolve( Setup\Setup::class )->boot();
		$this->app->resolve( ArchiveProduct\ArchiveProduct::class )->boot();
	}
}
