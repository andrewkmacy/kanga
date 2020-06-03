<?php
/**
 * Site Origin Compatibility File.
 *
 * @package Kanga
 */

// If plugin - 'Site Origin' not exist then return.
if ( ! class_exists( 'SiteOrigin_Panels_Settings' ) ) {
	return;
}

/**
 * Kanga Site Origin Compatibility
 */
if ( ! class_exists( 'Kanga_Site_Origin' ) ) :

	/**
	 * Kanga Site Origin Compatibility
	 *
	 * @since 1.0.0
	 */
	class Kanga_Site_Origin {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_filter( 'kanga_theme_assets', array( $this, 'add_styles' ) );
		}

		/**
		 * Add assets in theme
		 *
		 * @param array $assets list of theme assets (JS & CSS).
		 * @return array List of updated assets.
		 * @since 1.0.0
		 */
		public function add_styles( $assets ) {
			$assets['css']['kanga-site-origin'] = 'compatibility/site-origin';
			return $assets;
		}

	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
Kanga_Site_Origin::get_instance();
