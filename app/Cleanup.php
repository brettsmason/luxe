<?php
/**
 * Clean up WordPress.
 *
 * @package Luxe
 */

namespace Luxe;

use Hybrid\Contracts\Bootable;
use WP_Error;

/**
 * Cleanup class.
 *
 * @access public
 */
class Cleanup implements Bootable {

	/**
	 * Bootstraps the class' actions/filters.
	 *
	 * @access public
	 * @return void
	 */
	public function boot() {
		add_action( 'wp_loaded', [ $this, 'cleanup' ], 1 );
		add_action( 'wp_dashboard_setup', [ $this, 'removeDashboardWidgets' ] );
	}

	/**
	 * Cleans up and removes unnecessary WordPress bloat.
	 *
	 * @return void
	 */
	public function cleanup() {
		remove_action( 'template_redirect', 'rest_output_link_header', 11 );
		remove_action( 'template_redirect', 'wp_shortlink_header', 11 );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'noindex', 1 );
		remove_action( 'wp_head', 'parent_post_rel_link' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_head', 'rel_canonical' );
		remove_action( 'wp_head', 'rest_output_link_wp_head' );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'start_post_rel_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
		remove_action( 'wp_head', 'wp_oembed_add_host_js' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'wp_resource_hints', 2 );
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );

		add_filter( 'json_enabled', '__return_false' );
		add_filter( 'json_jsonp_enabled', '__return_false' );
		add_filter( 'xmlrpc_enabled', '__return_false' );
	}

	/**
	 * Hide extranneous dashboard widgets
	 *
	 * @return void
	 */
	public function removeDashboardWidgets() {

		global $wp_meta_boxes;

		unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );
		unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'] );
		unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
		unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'] );
		unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts'] );
		unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments'] );
		unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
		unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] );
		unset( $wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget'] );
	}
}
