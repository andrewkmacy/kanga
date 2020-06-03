<?php
/**
 * Heading Colors Loader for Kanga theme.
 *
 * @package     Kanga
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Kanga 2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Customizer Initialization
 *
 * @since 2.2.0
 */
class Kanga_Heading_Colors_Loader {

	/**
	 * Constructor
	 *
	 * @since 2.2.0
	 */
	public function __construct() {

		add_filter( 'kanga_theme_defaults', array( $this, 'theme_defaults' ) );
		add_action( 'customize_register', array( $this, 'customize_register' ), 2 );
		add_action( 'customize_preview_init', array( $this, 'preview_scripts' ), 110 );
		// Load Google fonts.
		add_action( 'kanga_get_fonts', array( $this, 'add_fonts' ), 1 );
	}

	/**
	 * Enqueue google fonts.
	 *
	 * @since 2.2.0
	 */
	public function add_fonts() {

		$font_family_h1 = kanga_get_option( 'font-family-h1' );
		$font_weight_h1 = kanga_get_option( 'font-weight-h1' );
		Kanga_Fonts::add_font( $font_family_h1, $font_weight_h1 );

		$font_family_h2 = kanga_get_option( 'font-family-h2' );
		$font_weight_h2 = kanga_get_option( 'font-weight-h2' );
		Kanga_Fonts::add_font( $font_family_h2, $font_weight_h2 );

		$font_family_h3 = kanga_get_option( 'font-family-h3' );
		$font_weight_h3 = kanga_get_option( 'font-weight-h3' );
		Kanga_Fonts::add_font( $font_family_h3, $font_weight_h3 );

		$theme_btn_font_family = kanga_get_option( 'font-family-button' );
		$theme_btn_font_weight = kanga_get_option( 'font-weight-button' );
		Kanga_Fonts::add_font( $theme_btn_font_family, $theme_btn_font_weight );
	}

	/**
	 * Set Options Default Values
	 *
	 * @param  array $defaults  Kanga options default value array.
	 * @return array
	 *
	 * @since 2.2.0
	 */
	public function theme_defaults( $defaults ) {

		/**
		* Heading Tags <h1> to <h6>
		*/
		$defaults['h1-color'] = '';
		$defaults['h2-color'] = '';
		$defaults['h3-color'] = '';
		$defaults['h4-color'] = '';
		$defaults['h5-color'] = '';
		$defaults['h6-color'] = '';

		// Header <H1>.
		$defaults['font-family-h1']    = 'inherit';
		$defaults['font-weight-h1']    = 'inherit';
		$defaults['text-transform-h1'] = '';
		$defaults['line-height-h1']    = '';

		// Header <H2>.
		$defaults['font-family-h2']    = 'inherit';
		$defaults['font-weight-h2']    = 'inherit';
		$defaults['text-transform-h2'] = '';
		$defaults['line-height-h2']    = '';

		// Header <H3>.
		$defaults['font-family-h3']    = 'inherit';
		$defaults['font-weight-h3']    = 'inherit';
		$defaults['text-transform-h3'] = '';
		$defaults['line-height-h3']    = '';

		/**
		 * Theme button Font Defaults
		 */
		$defaults['font-weight-button']    = 'inherit';
		$defaults['font-family-button']    = 'inherit';
		$defaults['font-size-button']      = array(
			'desktop'      => '',
			'tablet'       => '',
			'mobile'       => '',
			'desktop-unit' => 'px',
			'tablet-unit'  => 'px',
			'mobile-unit'  => 'px',
		);
		$defaults['text-transform-button'] = '';
		/**
		 * Check backward compatibility for button line height.
		 */
		$defaults['theme-btn-line-height']    = 1;
		$defaults['theme-btn-letter-spacing'] = '';

		return $defaults;
	}

	/**
	 * Load color configs for the Heading Colors.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @since 2.2.0
	 */
	public function customize_register( $wp_customize ) {

		/**
		 * Register Panel & Sections
		 */
		require_once ASTRA_THEME_HEADING_COLORS_DIR . 'customizer/class-kanga-heading-colors-configs.php';
	}

	/**
	 * Customizer Preview
	 *
	 * @since 2.2.0
	 */
	public function preview_scripts() {
		/**
		 * Load unminified if SCRIPT_DEBUG is true.
		 */
		/* Directory and Extension */
		$dir_name    = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';
		$file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';
		wp_enqueue_script( 'kanga-heading-colors-customizer-preview-js', ASTRA_THEME_HEADING_COLORS_URI . 'assets/js/' . $dir_name . '/customizer-preview' . $file_prefix . '.js', array( 'customize-preview', 'kanga-customizer-preview-js' ), ASTRA_THEME_VERSION, true );
	}
}

/**
*  Kicking this off by creating the object of the class.
*/
new Kanga_Heading_Colors_Loader();
