<?php
/**
 * Colors and Background - Header Options for our theme.
 *
 * @package     Kanga Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Kanga 1.4.3
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'Kanga_Customizer_Config_Base' ) ) {
	return;
}

/**
 * Customizer Sanitizes
 *
 * @since 1.4.3
 */
if ( ! class_exists( 'Kanga_Customizer_Colors_Transparent_Header_Configs' ) ) {

	/**
	 * Register Colors and Background - Header Options Customizer Configurations.
	 */
	class Kanga_Customizer_Colors_Transparent_Header_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Colors and Background - Header Options Customizer Configurations.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$defaults = Kanga_Theme_Options::defaults();

			$_configs = array(

				/**
				 * Option: Header background overlay color
				 */
				array(
					'name'       => 'transparent-header-bg-color-responsive',
					'default'    => $defaults['transparent-header-bg-color-responsive'],
					'section'    => 'section-transparent-header',
					'type'       => 'sub-control',
					'priority'   => 1,
					'parent'     => KANGA_THEME_SETTINGS . '[transparent-header-background-colors]',
					'section'    => 'section-transparent-header',
					'transport'  => 'postMessage',
					'control'    => 'ast-responsive-color',
					'title'      => __( 'Background Overlay Color', 'kanga' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Site Title Color
				 */
				array(
					'name'       => 'transparent-header-color-site-title-responsive',
					'default'    => $defaults['transparent-header-color-site-title-responsive'],
					'type'       => 'sub-control',
					'priority'   => 1,
					'parent'     => KANGA_THEME_SETTINGS . '[transparent-header-colors]',
					'section'    => 'section-transparent-header',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'title'      => __( 'Site Title Color', 'kanga' ),
					'tab'        => __( 'Normal', 'kanga' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Site Title Hover Color
				 */
				array(
					'name'       => 'transparent-header-color-h-site-title-responsive',
					'default'    => $defaults['transparent-header-color-h-site-title-responsive'],
					'type'       => 'sub-control',
					'priority'   => 1,
					'parent'     => KANGA_THEME_SETTINGS . '[transparent-header-colors]',
					'section'    => 'section-transparent-header',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'title'      => __( 'Site Title Color', 'kanga' ),
					'tab'        => __( 'Hover', 'kanga' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Primary Menu Color
				 */
				array(
					'name'       => 'transparent-menu-color-responsive',
					'default'    => $defaults['transparent-menu-color-responsive'],
					'type'       => 'sub-control',
					'priority'   => 2,
					'parent'     => KANGA_THEME_SETTINGS . '[transparent-header-colors-menu]',
					'section'    => 'section-transparent-header',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'tab'        => __( 'Normal', 'kanga' ),
					'title'      => __( 'Link / Text Color', 'kanga' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Menu Background Color
				 */
				array(
					'name'       => 'transparent-menu-bg-color-responsive',
					'default'    => $defaults['transparent-menu-bg-color-responsive'],
					'type'       => 'sub-control',
					'priority'   => 2,
					'parent'     => KANGA_THEME_SETTINGS . '[transparent-header-colors-menu]',
					'section'    => 'section-transparent-header',
					'transport'  => 'postMessage',
					'control'    => 'ast-responsive-color',
					'tab'        => __( 'Normal', 'kanga' ),
					'title'      => __( 'Background Color', 'kanga' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Menu Hover Color
				 */
				array(
					'name'       => 'transparent-menu-h-color-responsive',
					'default'    => $defaults['transparent-menu-h-color-responsive'],
					'type'       => 'sub-control',
					'priority'   => 3,
					'parent'     => KANGA_THEME_SETTINGS . '[transparent-header-colors-menu]',
					'section'    => 'section-transparent-header',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'tab'        => __( 'Hover', 'kanga' ),
					'title'      => __( 'Link Active / Hover Color', 'kanga' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Sub menu text color.
				 */
				array(
					'name'       => 'transparent-submenu-color-responsive',
					'default'    => $defaults['transparent-submenu-color-responsive'],
					'type'       => 'sub-control',
					'priority'   => 3,
					'parent'     => KANGA_THEME_SETTINGS . '[transparent-header-colors-submenu]',
					'section'    => 'section-transparent-header',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'tab'        => __( 'Normal', 'kanga' ),
					'title'      => __( 'Link / Text Color', 'kanga' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Sub menu background color.
				 */
				array(
					'name'       => 'transparent-submenu-bg-color-responsive',
					'default'    => $defaults['transparent-submenu-bg-color-responsive'],
					'type'       => 'sub-control',
					'priority'   => 3,
					'parent'     => KANGA_THEME_SETTINGS . '[transparent-header-colors-submenu]',
					'section'    => 'section-transparent-header',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'tab'        => __( 'Normal', 'kanga' ),
					'title'      => __( 'Background Color', 'kanga' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Sub menu active hover color.
				 */
				array(
					'name'       => 'transparent-submenu-h-color-responsive',
					'default'    => $defaults['transparent-submenu-h-color-responsive'],
					'type'       => 'sub-control',
					'priority'   => 3,
					'parent'     => KANGA_THEME_SETTINGS . '[transparent-header-colors-submenu]',
					'section'    => 'section-transparent-header',
					'control'    => 'ast-responsive-color',
					'transport'  => 'postMessage',
					'tab'        => __( 'Hover', 'kanga' ),
					'title'      => __( 'Link Active / Hover Color', 'kanga' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				* Option: Content Section Text color.
				*/
				array(
					'name'       => 'transparent-content-section-text-color-responsive',
					'default'    => $defaults['transparent-content-section-text-color-responsive'],
					'type'       => 'sub-control',
					'priority'   => 4,
					'parent'     => KANGA_THEME_SETTINGS . '[transparent-header-colors-content]',
					'section'    => 'section-transparent-header',
					'transport'  => 'postMessage',
					'control'    => 'ast-responsive-color',
					'tab'        => __( 'Normal', 'kanga' ),
					'title'      => __( 'Text Color', 'kanga' ),
					'responsive' => true,
					'rgba'       => true,
				),
				/**
				 * Option: Content Section Link color.
				 */
				array(
					'name'       => 'transparent-content-section-link-color-responsive',
					'default'    => $defaults['transparent-content-section-link-color-responsive'],
					'type'       => 'sub-control',
					'priority'   => 4,
					'parent'     => KANGA_THEME_SETTINGS . '[transparent-header-colors-content]',
					'section'    => 'section-transparent-header',
					'transport'  => 'postMessage',
					'control'    => 'ast-responsive-color',
					'tab'        => __( 'Normal', 'kanga' ),
					'title'      => __( 'Link Color', 'kanga' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Content Section Link Hover color.
				 */
				array(
					'name'       => 'transparent-content-section-link-h-color-responsive',
					'default'    => $defaults['transparent-content-section-link-h-color-responsive'],
					'type'       => 'sub-control',
					'priority'   => 4,
					'parent'     => KANGA_THEME_SETTINGS . '[transparent-header-colors-content]',
					'section'    => 'section-transparent-header',
					'transport'  => 'postMessage',
					'control'    => 'ast-responsive-color',
					'tab'        => __( 'Hover', 'kanga' ),
					'title'      => __( 'Link Color', 'kanga' ),
					'responsive' => true,
					'rgba'       => true,
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Kanga_Customizer_Colors_Transparent_Header_Configs();
