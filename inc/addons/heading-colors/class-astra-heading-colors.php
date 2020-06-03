<?php
/**
 * Heading Colors for Kanga theme.
 *
 * @package     Kanga
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Kanga 2.1.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'KANGA_THEME_HEADING_COLORS_DIR', KANGA_THEME_DIR . 'inc/addons/heading-colors/' );
define( 'KANGA_THEME_HEADING_COLORS_URI', KANGA_THEME_URI . 'inc/addons/heading-colors/' );

if ( ! class_exists( 'Kanga_Heading_Colors' ) ) {

	/**
	 * Heading Initial Setup
	 *
	 * @since 2.1.4
	 */
	class Kanga_Heading_Colors {

		/**
		 * Constructor function that initializes required actions and hooks
		 */
		public function __construct() {

			require_once KANGA_THEME_HEADING_COLORS_DIR . 'class-kanga-heading-colors-loader.php';

			// Include front end files.
			if ( ! is_admin() ) {
				require_once KANGA_THEME_HEADING_COLORS_DIR . 'dynamic-css/dynamic.css.php';
			}
		}
	}

	/**
	 *  Kicking this off by creating an object.
	 */
	new Kanga_Heading_Colors();

}
