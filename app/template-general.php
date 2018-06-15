<?php
/**
 * General template tags.
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
 * Returns the metadata separator.
 *
 * @since  1.0.0
 * @access public
 * @param  string $sep The seperator.
 * @return string
 */
function get_meta_sep( $sep = '' ) {

	return apply_filters(
		'luxe/meta_sep',
		sprintf(
			' <span class="sep">%s</span> ',
			$sep ? $sep : esc_html_x( '&middot;', 'meta separator', 'luxe' )
		)
	);
}

/**
 * Determine whether to show the sidebar
 *
 * @return bool
 */
function display_sidebar() {
	return apply_filters( 'luxe/display_sidebar', false );
}
