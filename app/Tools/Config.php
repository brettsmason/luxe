<?php
/**
 * Config Class.
 *
 * A simple class for grabbing and returning a configuration file from `/config`.
 *
 * @package Luxe
 */

namespace Luxe\Tools;

/**
 * Config class.
 *
 * @access public
 */
class Config {

	/**
	 * Includes and returns a given PHP config file. The file must return
	 * an array.
	 *
	 * @access public
	 * @param string $name The name of the file.
	 * @return array
	 */
	public static function get( $name ) {

		$file = static::path( "{$name}.php" );

		return (array) file_exists( $file ) ? include( $file ) : [];
	}

	/**
	 * Returns the config path or file path if set.
	 *
	 * @access public
	 * @param string $file the file name.
	 * @return string
	 */
	public static function path( $file = '' ) {

		$file = trim( $file, '/' );

		return get_theme_file_path( $file ? "../config/{$file}" : '../config' );
	}
}
