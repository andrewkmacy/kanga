<?php
/**
 * Sidebar Manager functions
 *
 * @package     Kanga
 * @author      Kanga
 * @copyright   Copyright (c) 2020, Kanga
 * @link        https://wpkanga.com/
 * @since       Kanga 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Site Sidebar
 */
if ( ! function_exists( 'kanga_page_layout' ) ) {

	/**
	 * Site Sidebar
	 *
	 * Default 'right sidebar' for overall site.
	 */
	function kanga_page_layout() {

		if ( is_singular() ) {

			// If post meta value is empty,
			// Then get the POST_TYPE sidebar.
			$layout = kanga_get_option_meta( 'site-sidebar-layout', '', true );

			if ( empty( $layout ) ) {

				$post_type = get_post_type();

				if ( 'post' === $post_type || 'page' === $post_type || 'product' === $post_type ) {
					$layout = kanga_get_option( 'single-' . get_post_type() . '-sidebar-layout' );
				}

				if ( 'default' == $layout || empty( $layout ) ) {

					// Get the global sidebar value.
					// NOTE: Here not used `true` in the below function call.
					$layout = kanga_get_option( 'site-sidebar-layout' );
				}
			}
		} else {

			if ( is_search() ) {

				// Check only post type archive option value.
				$layout = kanga_get_option( 'archive-post-sidebar-layout' );

				if ( 'default' == $layout || empty( $layout ) ) {

					// Get the global sidebar value.
					// NOTE: Here not used `true` in the below function call.
					$layout = kanga_get_option( 'site-sidebar-layout' );
				}
			} else {

				$post_type = get_post_type();
				$layout    = '';

				if ( 'post' === $post_type ) {
					$layout = kanga_get_option( 'archive-' . get_post_type() . '-sidebar-layout' );
				}

				if ( 'default' == $layout || empty( $layout ) ) {

					// Get the global sidebar value.
					// NOTE: Here not used `true` in the below function call.
					$layout = kanga_get_option( 'site-sidebar-layout' );
				}
			}
		}

		return apply_filters( 'kanga_page_layout', $layout );
	}
}
