<?php
/**
 * Admin functions - Functions that add some functionality to WordPress admin panel
 *
 * @package Kanga
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register menus
 */
if ( ! function_exists( 'kanga_register_menu_locations' ) ) {

	/**
	 * Register menus
	 *
	 * @since 1.0.0
	 */
	function kanga_register_menu_locations() {

		/**
		 * Menus
		 */
		register_nav_menus(
			array(
				'primary'     => __( 'Primary Menu', 'kanga' ),
				'footer_menu' => __( 'Footer Menu', 'kanga' ),
			)
		);
	}
}

add_action( 'init', 'kanga_register_menu_locations' );
