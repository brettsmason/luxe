<?php
/**
 * A theme wrapper for creating base templates for keeping templates DRY.
 *
 * @package Luxe
 */

namespace Luxe;

use Hybrid\Contracts\Bootable;

/**
 * Theme wrapper.
 */
class Wrapper implements Bootable {

	/**
	 * Store the full path to the template file.
	 *
	 * @var string
	 */
	private static $template;

	/**
	 * Store the base name of the template file; e.g. 'page' for 'page.php' etc.
	 *
	 * @var string
	 */
	private static $base;

	/**
	 * Constructor
	 *
	 * @param string $template Template slug
	 */
	public function __construct( $template = 'base.php' ) {
		$this->slug = basename( $template, '.php' );
		$this->templates = [ $template ];
	
		if ( self::$base ) {
			$str = substr( $template, 0, -4 );
			array_unshift( $this->templates, sprintf( $str . '-%s.php', self::$base ) );
		}
	}

	/**
	 * Actions and filters.
	 */
	public function boot() {
		add_filter( 'template_include', [ $this, 'wrap' ], 99 );
	}

	/**
	 * String representation
	 *
	 * @return string
	 */
	public function __toString() {
		return locate_template( $this->templates );
	}

	/**
	 * Return the template path.
	 *
	 * @return string
	 */
	public static function template() {
		return self::$template;
	}

	/**
	 * Allow a different base-templatename.php to be used
	 *
	 * @param string $main Template name
	 *
	 * @return Wrapper
	 */
	public static function wrap( $main ) {
		self::$template = $main;
		self::$base = basename( self::$template, '.php' );

		if ( 'index' === self::$base ) {
			self::$base = false;
		}

		return new Wrapper();
	}
}
