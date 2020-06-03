<?php
/**
 * Typography - Breadcrumbs Options for theme.
 *
 * @package     Kanga
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Kanga 1.7.0
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
 * @since 1.7.0
 */
if ( ! class_exists( 'Kanga_Breadcrumbs_Typo_Configs' ) ) {

	/**
	 * Register Colors and Background - Breadcrumbs Options Customizer Configurations.
	 */
	class Kanga_Breadcrumbs_Typo_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Colors and Background - Breadcrumbs Options Customizer Configurations.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.7.0
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$defaults = Kanga_Theme_Options::defaults();

			$_configs = array(

				/**
				 * Option: Divider
				 * Option: breadcrumb Typography Section divider
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[section-breadcrumb-typography-divider]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => 'section-breadcrumb',
					'title'    => __( 'Typography', 'kanga' ),
					'required' => array( KANGA_THEME_SETTINGS . '[breadcrumb-position]', '!=', 'none' ),
					'priority' => 73,
					'settings' => array(),
				),

				/*
				 * Breadcrumb Typography
				 */
				array(
					'name'      => KANGA_THEME_SETTINGS . '[section-breadcrumb-typo]',
					'default'   => kanga_get_option( 'section-breadcrumb-typo' ),
					'type'      => 'control',
					'required'  => array( KANGA_THEME_SETTINGS . '[breadcrumb-position]', '!=', 'none' ),
					'control'   => 'ast-settings-group',
					'title'     => __( 'Content', 'kanga' ),
					'section'   => 'section-breadcrumb',
					'transport' => 'postMessage',
					'priority'  => 73,
				),

				/**
				 * Option: Font Family
				 */
				array(
					'name'      => 'breadcrumb-font-family',
					'default'   => kanga_get_option( 'breadcrumb-font-family' ),
					'type'      => 'sub-control',
					'parent'    => KANGA_THEME_SETTINGS . '[section-breadcrumb-typo]',
					'section'   => 'section-breadcrumb',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'kanga' ),
					'connect'   => 'breadcrumb-font-weight',
					'priority'  => 5,
				),

				/**
				 * Option: Font Size
				 */
				array(
					'name'        => 'breadcrumb-font-size',
					'control'     => 'ast-responsive',
					'type'        => 'sub-control',
					'parent'      => KANGA_THEME_SETTINGS . '[section-breadcrumb-typo]',
					'section'     => 'section-breadcrumb',
					'default'     => kanga_get_option( 'breadcrumb-font-size' ),
					'transport'   => 'postMessage',
					'title'       => __( 'Size', 'kanga' ),
					'priority'    => 10,
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),

				/**
				 * Option: Font Weight
				 */
				array(
					'name'              => 'breadcrumb-font-weight',
					'control'           => 'ast-font',
					'type'              => 'sub-control',
					'parent'            => KANGA_THEME_SETTINGS . '[section-breadcrumb-typo]',
					'section'           => 'section-breadcrumb',
					'font_type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Kanga_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => kanga_get_option( 'breadcrumb-font-weight' ),
					'title'             => __( 'Weight', 'kanga' ),
					'connect'           => 'breadcrumb-font-family',
					'priority'          => 15,
				),

				/**
				 * Option: Text Transform
				 */
				array(
					'name'      => 'breadcrumb-text-transform',
					'control'   => 'ast-select',
					'type'      => 'sub-control',
					'parent'    => KANGA_THEME_SETTINGS . '[section-breadcrumb-typo]',
					'section'   => 'section-breadcrumb',
					'default'   => kanga_get_option( 'breadcrumb-text-transform' ),
					'title'     => __( 'Text Transform', 'kanga' ),
					'transport' => 'postMessage',
					'priority'  => 20,
					'choices'   => array(
						''           => __( 'Inherit', 'kanga' ),
						'none'       => __( 'None', 'kanga' ),
						'capitalize' => __( 'Capitalize', 'kanga' ),
						'uppercase'  => __( 'Uppercase', 'kanga' ),
						'lowercase'  => __( 'Lowercase', 'kanga' ),
					),
				),

				/**
				 * Option: Line Height
				 */
				array(
					'name'              => 'breadcrumb-line-height',
					'control'           => 'ast-slider',
					'transport'         => 'postMessage',
					'type'              => 'sub-control',
					'default'           => '',
					'parent'            => KANGA_THEME_SETTINGS . '[section-breadcrumb-typo]',
					'section'           => 'section-breadcrumb',
					'sanitize_callback' => array( 'Kanga_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Line Height', 'kanga' ),
					'suffix'            => '',
					'priority'          => 25,
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Kanga_Breadcrumbs_Typo_Configs();
