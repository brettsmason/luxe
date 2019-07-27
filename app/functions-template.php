<?php
/**
 * Template tags and functions.
 *
 * This file holds general template tags for the theme. Template tags are PHP
 * functions meant for use within theme templates.
 *
 * @package   Luxe
 * @author    Brett Mason <brettsmason@gmail.com>
 * @copyright Copyright (c) 2018, Brett Mason
 * @link      https://github.com/brettsmason/luxe
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Luxe;

/**
 * Determine whether to show the sidebar
 *
 * @since  1.0.0
 * @access public
 * @return bool
 */
function display_sidebar() {
	return apply_filters( 'luxe/display_sidebar', false );
}
