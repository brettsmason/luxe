<?php
/**
 * Register page templates.
 *
 * This file holds the registration of page templates.
 *
 * @package   Luxe
 * @author    Brett Mason <brettsmason@gmail.com>
 * @copyright Copyright (c) 2018, Brett Mason
 * @link      https://github.com/brettsmason/luxe
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Luxe;

/**
 * Add templates to our post types.
 */
add_action( 'hybrid/templates/register', function( $templates ) {

	$templates->add(
		'templates/landing.php',
		[
			'label'      => __( 'Landing' ),
			'post_types' => [ 'page' ]
		]
	);
} );
