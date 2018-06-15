<?php
/**
 * This file is used to bootstrap the theme.
 *
 * @package Luxe
 */

namespace Luxe;

use function Hybrid\app;
use function Hybrid\collect;

// Registers a single instance of our `Customize` class with the container.
app()->instance( 'luxe/customize', new Customize() );

// Register our theme config JSON file with the container.
app()->singleton( 'luxe/theme_config', function() {

	$file_path = get_theme_file_path( '/config/theme.json' );
	$file      = file_exists( $file_path ) ? json_decode( file_get_contents( $file_path ), true ) : [];

	return is_null( $file ) ? collect() : collect( $file );
} );
