<?php
/**
 * Fallback header Template.
 *
 * This file is provided as a fallback for plugins that
 * directly call the header template on plugin pages.
 *
 * @package Luxe
 */

 // Access the view template engine.
$engine = Hybrid\App::resolve( Hybrid\View\Contracts\Engine::class );

// Load the header template.
$engine->display( 'components', 'header' );
