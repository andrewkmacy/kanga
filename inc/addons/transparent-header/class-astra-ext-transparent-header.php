<?php
/**
 * Sticky Header Extension
 *
 * @package Kanga Addon
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'KANGA_THEME_TRANSPARENT_HEADER_DIR', KANGA_THEME_DIR . 'inc/addons/transparent-header/' );
define( 'KANGA_THEME_TRANSPARENT_HEADER_URI', KANGA_THEME_URI . 'inc/addons/transparent-header/' );

if ( ! class_exists( 'Kanga_Ext_Transparent_Header' ) ) {

	/**
	 * Sticky Header Initial Setup
	 *
	 * @since 1.0.0
	 */
	class Kanga_Ext_Transparent_Header {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor function that initializes required actions and hooks
		 */
		public function __construct() {

			require_once KANGA_THEME_TRANSPARENT_HEADER_DIR . 'classes/class-kanga-ext-transparent-header-loader.php';
			require_once KANGA_THEME_TRANSPARENT_HEADER_DIR . 'classes/class-kanga-ext-transparent-header-markup.php';

			// Include front end files.
			if ( ! is_admin() ) {
				require_once KANGA_THEME_TRANSPARENT_HEADER_DIR . 'classes/dynamic-css/dynamic.css.php';
				require_once KANGA_THEME_TRANSPARENT_HEADER_DIR . 'classes/dynamic-css/header-sections-dynamic.css.php';
			}
		}
	}

	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	Kanga_Ext_Transparent_Header::get_instance();

}
