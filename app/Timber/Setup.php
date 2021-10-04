<?php
/**
 * Timber setup.
 *
 * @package    Luxe
 * @author     Brett Mason <brettsmason@gmail.com>
 * @copyright  Copyright (c) 2018, Brett Mason
 * @link       https://github.com/brettsmason/luxe/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Luxe\Timber;

use Hybrid\Contracts\Bootable;
use \Timber\Timber;

/**
 * Setup class.
 *
 * @access public
 */
class Setup implements Bootable {

	/**
	 * Bootstraps the class' actions/filters.
	 *
	 * @access public
	 * @return void
	 */
	public function boot() {
		add_action( 'after_setup_theme', [ $this, 'init' ], 5 );
		add_filter( 'timber/context', [ $this, 'addMenusToContext' ] );
	}

	/**
	 * Timber init.
	 */
	public function init() {

		// Initialise Timber.
		$timber = new Timber();

		// Set twig template directory.
		$timber::$dirname = [ 'resources/views' ];
	}

	/**
	 * Registers and adds menus to context
	 *
	 * @param array $context Timber context.
	 *
	 * @return array
	 */
	public function addMenusToContext( $context ) {
		$context['menu'] = Timber::get_menu( 'primary' );

		return $context;
	}
}
