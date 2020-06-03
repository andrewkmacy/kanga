<?php
/**
 * Divi Builder File.
 *
 * @package Kanga
 */

// If plugin - 'Divi Builder' not exist then return.
if ( ! class_exists( 'ET_Builder_Plugin' ) ) {
	return;
}

/**
 * Kanga Divi Builder
 */
if ( ! class_exists( 'Kanga_Divi_Builder' ) ) :

	/**
	 * Kanga Divi Builder
	 *
	 * @since 1.4.0
	 */
	class Kanga_Divi_Builder {

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
		 * @since 1.4.0
		 */
		public function add_styles( $assets ) {
			$assets['css']['kanga-divi-builder'] = 'compatibility/divi-builder';
			return $assets;
		}

	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
Kanga_Divi_Builder::get_instance();
