<?php
/**
 * Breadcrumbs Loader for Kanga theme.
 *
 * @package     Kanga
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Kanga 1.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Kanga_Breadcrumbs_Loader' ) ) {

	/**
	 * Customizer Initialization
	 *
	 * @since 1.7.0
	 */
	class Kanga_Breadcrumbs_Loader {

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
		 *  Constructor
		 */
		public function __construct() {

			add_filter( 'kanga_theme_defaults', array( $this, 'theme_defaults' ) );
			add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 110 );
			add_action( 'customize_register', array( $this, 'customize_register' ), 2 );
			// Load Google fonts.
			add_action( 'kanga_get_fonts', array( $this, 'add_fonts' ), 1 );
		}

		/**
		 * Enqueue google fonts.
		 *
		 * @return void
		 */
		public function add_fonts() {
			$breadcrumb_font_family = kanga_get_option( 'breadcrumb-font-family' );
			$breadcrumb_font_weight = kanga_get_option( 'breadcrumb-font-weight' );
			Kanga_Fonts::add_font( $breadcrumb_font_family, $breadcrumb_font_weight );
		}

		/**
		 * Set Options Default Values
		 *
		 * @param  array $defaults  Kanga options default value array.
		 * @return array
		 */
		public function theme_defaults( $defaults ) {

			/**
			 * Breadcrumb Typography
			 */
			$defaults['breadcrumb-font-family']    = 'inherit';
			$defaults['breadcrumb-font-weight']    = 'inherit';
			$defaults['breadcrumb-text-transform'] = 'inherit';

			/**
			 * Breadcrumb Responsive Colors
			 */
			$defaults['breadcrumb-text-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['breadcrumb-active-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['breadcrumb-hover-color-responsive'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['breadcrumb-separator-color'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['breadcrumb-bg-color'] = array(
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			);

			$defaults['breadcrumb-spacing'] = array(
				'desktop'      => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'tablet'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'mobile'       => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'desktop-unit' => 'px',
				'tablet-unit'  => 'px',
				'mobile-unit'  => 'px',
			);

			/**
			 * Breadcrumb Font Defaults
			 */
			$defaults['breadcrumb-font-family']    = 'inherit';
			$defaults['breadcrumb-font-weight']    = 'inherit';
			$defaults['breadcrumb-text-transform'] = '';

			return $defaults;
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function customize_register( $wp_customize ) {

			/**
			 * Register Panel & Sections
			 */
			require_once KANGA_THEME_BREADCRUMBS_DIR . 'customizer/class-kanga-breadcrumbs-configs.php';
			require_once KANGA_THEME_BREADCRUMBS_DIR . 'customizer/class-kanga-breadcrumbs-color-configs.php';
			require_once KANGA_THEME_BREADCRUMBS_DIR . 'customizer/class-kanga-breadcrumbs-typo-configs.php';

		}

		/**
		 * Customizer Preview
		 */
		public function preview_scripts() {
			/**
			 * Load unminified if SCRIPT_DEBUG is true.
			 */
			/* Directory and Extension */
			$dir_name    = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';
			$file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';
			wp_enqueue_script( 'kanga-breadcrumbs-customizer-preview-js', KANGA_THEME_BREADCRUMBS_URI . 'assets/js/' . $dir_name . '/customizer-preview' . $file_prefix . '.js', array( 'customize-preview', 'kanga-customizer-preview-js' ), KANGA_THEME_VERSION, true );
		}
	}
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
Kanga_Breadcrumbs_Loader::get_instance();
