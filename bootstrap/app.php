<?php
/**
 * Theme bootstrap file.
 *
 * This file is used to create a new application instance and bind items to the
 * container. This is the heart of the application.
 *
 * @package Luxe
 */

/**
 * Create a new application.
 *
 * Creates the one true instance of the Hybrid Core application. You may access
 * this directly via the `\Hybrid\app()` function or `\Hybrid\App` static class
 * after the application has booted.
 */
$luxe = new \Hybrid\Core\Application();

/**
 * Register service providers with the application.
 *
 * Before booting the application, add any service providers that are necessary
 * for running the theme. Service providers are essentially the backbone of the
 * bootstrapping process.
 */
$luxe->provider( \Luxe\Providers\AppServiceProvider::class );
$luxe->provider( \Luxe\Providers\CustomizeServiceProvider::class );
$luxe->provider( \Luxe\Providers\WooCommerceServiceProvider::class );

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
