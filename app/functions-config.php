<?php
/**
 * Functions for dealing with our config files.
 *
 * @package Luxe
 */

namespace Luxe;

use function Hybrid\app;

/**
 * Retrieve values from our theme.json config file.
 *
 * @param  string $key A key to retrieve froom the config.
 * @return array  Theme config array matching the given $key.
 */
function theme_config( $key ) {
	return app( 'luxe/theme_config' )->get( $key );
}
