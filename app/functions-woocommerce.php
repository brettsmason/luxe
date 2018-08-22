<?php
/**
 * WooCommerce specific functions.
 *
 * @package Luxe
 */

namespace Luxe;

/**
 * Put WooCommerce templates under resources/views/woocommerce.
 *
 * @param string The path to directory.
 * @return string
 */
add_filter( 'woocommerce_template_path', function( $path ) {
	return \Hybrid\Template\path( $path );
} );
