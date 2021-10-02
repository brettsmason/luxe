<?php
/**
 * Theme setup.
 *
 * @package    Luxe
 * @author     Brett Mason <brettsmason@gmail.com>
 * @copyright  Copyright (c) 2018, Brett Mason
 * @link       https://github.com/brettsmason/luxe/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Luxe;

use Hybrid\Contracts\Bootable;

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
		add_action( 'after_setup_theme', [ $this, 'themeSupports' ], 5 );
		add_action( 'init', [ $this, 'registerMenus' ] );
		add_action( 'init', [ $this, 'addImageSizes' ] );
		add_action( 'widgets_init', [ $this, 'registerWidgetAreas' ] );
	}

	/**
	 * Set up theme support.
	 *
	 * @access public
	 * @return void
	 */
	public function themeSupports() {

		// Theme translations.
		load_theme_textdomain( 'luxe', get_parent_theme_file_path( '/resources/lang' ) );

		// Title tag support.
		add_theme_support( 'title-tag' );

		// Featured image support.
		add_theme_support( 'post-thumbnails' );

		// Selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Custom logo support.
		add_theme_support(
			'custom-logo',
			[
				'width'       => 300,
				'height'      => 200,
				'flex-height' => true,
				'flex-width'  => true,
				'header-text' => [
					'app-header__title',
					'app-header__description',
				],
			]
		);

		// Outputs HTML5 markup for core features.
		add_theme_support(
			'html5',
			[
				'script',
				'style',
				'comment-list',
				'comment-form',
				'search-form',
				'gallery',
				'caption',
			]
		);

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for align wide blocks.
		add_theme_support( 'align-wide' );

		// Let core handle responsive embed wrappers.
		add_theme_support( 'responsive-embeds' );
	}

	/**
	 * Register menus.
	 *
	 * @return void
	 */
	public function registerMenus() {

		register_nav_menus(
			[
				'primary'    => esc_html_x( 'Primary', 'nav menu location', 'luxe' ),
				'subsidiary' => esc_html_x( 'Subsidiary', 'nav menu location', 'luxe' ),
			]
		);
	}

	/**
	 * Add custom image sizes.
	 *
	 * @return void
	 */
	public function addImageSizes() {
		add_image_size( 'td-60', 60, 60, true );
	}

	/**
	 * Register widget areas.
	 *
	 * @return void
	 */
	public function registerWidgetAreas() {
		$args = [
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget__title">',
			'after_title'   => '</h2>',
		];

		register_sidebar(
			[
				'id'   => 'primary',
				'name' => esc_html_x( 'Primary', 'sidebar', 'luxe' ),
			] + $args
		);
	}
}
