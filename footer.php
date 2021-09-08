<?php
/**
 * Fallback Footer Template.
 *
 * This file is provided as a fallback for plugins that
 * directly call the footer template on plugin pages.
 *
 * @package Luxe
 */

// Access the view template engine.
$engine = Hybrid\App::resolve( Hybrid\View\Contracts\Engine::class );

// Load the index template.
$engine->display( 'components/footer' );
