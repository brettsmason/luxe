<?php
/**
 * Functions for dealing with JSON config files.
 *
 * @package Luxe
 */

namespace Luxe;

/**
 * Retrieve config information from a JSON file.
 *
 * @param  string $key The key of a value to retrieve.
 * @param  string $file The name of the file to retrieve.
 * @return array
 */
function get_config( $key, $file = 'theme.json' ) {

    $file_path = get_theme_file_path( "/config/{$file}" );
	$file = file_exists( $file_path ) ? json_decode( file_get_contents( $file_path ), true ) : [];

    // If the config contains the requested key, return the value.
    if ( is_array( $file ) && array_key_exists( $key, $file ) ) {
        return $file[ $key ];
	}
}
