<?php
/**
 * Theme bootstrap file.
 *
 * This file is used to create a new application instance and bind items to the
 * container. This is the heart of the application.
 *
 * @package Luxe
 */

namespace Luxe;

use \Hybrid\Core\Application;
use function \Hybrid\{app, booted};

/**
 * Create a new application.
 *
 * Creates the one true instance of the Hybrid Core application. You may access
 * this directly via the `\Hybrid\app()` function or `\Hybrid\App` static class
 * after the application has booted.
 */
$luxe = booted() ? app() : new Application();

/**
 * Register service providers with the application.
 *
 * Before booting the application, add any service providers that are necessary
 * for running the theme. Service providers are essentially the backbone of the
 * bootstrapping process.
 */

$providers = [
	\Luxe\Providers\AppServiceProvider::class,
	\Luxe\Providers\CustomizeServiceProvider::class,
	\Luxe\Providers\WooCommerceServiceProvider::class,
];

foreach ( $providers as $provider ) {
	$luxe->provider( $provider );
}

/**
 * Perform bootstrap actions.
 *
 * Creates an action hook for child themes (or even plugins) to hook into the
 * bootstrapping process and add their own bindings before the app is booted by
 * passing the application instance to the action callback.
 */
do_action( 'luxe/bootstrap', $luxe );

/**
 * Bootstrap the application.
 *
 * Calls the application `boot()` method, which launches the application. Pat
 * yourself on the back for a job well done.
 */
$luxe->boot();
