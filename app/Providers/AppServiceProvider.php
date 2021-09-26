<?php
/**
 * App service provider.
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

/**
 * App service provider.
 *
 * @since  1.0.0
 * @access public
 */
class AppServiceProvider extends ServiceProvider {

	/**
	 * Callback executed when the `\Hybrid\Core\Application` class registers
	 * providers. Use this method to bind items to the container.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Bind the asset manifest for cache-busting.
		$this->app->singleton(
			'app/manifest',
			function() {
				$file = get_theme_file_path( 'public/mix-manifest.json' );
				return file_exists( $file ) ? json_decode( file_get_contents( $file ), true ) : null;
			}
		);

		$this->app->singleton( \Luxe\Setup::class );
	}

	/**
	 * Callback executed after all the service providers have been registered.
	 * This is particularly useful for single-instance container objects that
	 * only need to be loaded once per page and need to be resolved early.
	 *
	 * @access public
	 * @return void
	 */
	public function boot() {

		$this->app->resolve( \Luxe\Setup::class )->boot();
	}
}
