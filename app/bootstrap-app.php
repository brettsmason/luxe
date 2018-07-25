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
 * Add bindings to the container.
 *
 * Before booting the application, add any bindings to the container that are
 * necessary to run the theme.
 *
 * Register customize class instance and boot it.
 */
$luxe->instance( 'luxe/customize', new \Luxe\Customize\Customize() )->boot();

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
