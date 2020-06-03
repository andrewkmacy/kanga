<?php
/**
 * BNE Flyout Compatibility File.
 *
 * @package Kanga
 */

// If plugin - 'BNE Flyout' not exist then return.
if ( ! defined( 'BNE_FLYOUT_VERSION' ) ) {
	return;
}

/**
 * Kanga BNE Flyout Compatibility
 */
if ( ! class_exists( 'Kanga_BNE_Flyout' ) ) :

	/**
	 * Kanga BNE Flyout Compatibility
	 *
	 * @since 1.0.0
	 */
	class Kanga_BNE_Flyout {

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
			$assets['css']['kanga-bne-flyout'] = 'compatibility/bne-flyout';
			return $assets;
		}

	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
Kanga_BNE_Flyout::get_instance();
