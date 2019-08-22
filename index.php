<?=
/**
 * Index template.
 *
 * This template should never be loaded on a site unless a plugin is doing
 * something that it shouldn't be doing or something weird is going on. We're
 * leaving the below code as an absolue fallback in case this file is loaded.
 * All it does is correctly load up our `resources/views/layouts/index.php` template.
 *
 * @package Luxe
 */

// Access the view template engine.
$engine = Hybrid\App::resolve( 'view/engine' );

// Load the index template.
$engine->display( 'index' );
