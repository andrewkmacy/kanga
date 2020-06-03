<?php
/**
 * Heading Colors Options for Kanga theme.
 *
 * @package     Kanga
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Kanga 2.1.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kanga_Heading_Colors_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Kanga_Heading_Colors_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Kanga Heading Colors Settings.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 2.1.4
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				// Option: Base Heading Color.
				array(
					'default'   => '',
					'type'      => 'control',
					'control'   => 'ast-color',
					'transport' => 'postMessage',
					'priority'  => 18,
					'name'      => KANGA_THEME_SETTINGS . '[heading-base-color]',
					'title'     => __( 'Heading Color ( H1 - H6 )', 'kanga' ),
					'section'   => 'section-colors-body',
				),

				/**
				 * Heading Typography starts here - h1 - h3
				 */

				/**
				 * Option: Heading <H1> Font Family
				 */
				array(
					'name'      => KANGA_THEME_SETTINGS . '[font-family-h1]',
					'type'      => 'control',
					'control'   => 'ast-font',
					'font-type' => 'ast-font-family',
					'default'   => kanga_get_option( 'font-family-h1' ),
					'title'     => __( 'Family', 'kanga' ),
					'section'   => 'section-content-typo',
					'priority'  => 5,
					'connect'   => KANGA_THEME_SETTINGS . '[font-weight-h1]',
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H1> Font Weight
				 */
				array(
					'name'              => KANGA_THEME_SETTINGS . '[font-weight-h1]',
					'type'              => 'control',
					'control'           => 'ast-font',
					'font-type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'kanga' ),
					'sanitize_callback' => array( 'Kanga_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => kanga_get_option( 'font-weight-h1' ),
					'section'           => 'section-content-typo',
					'priority'          => 7,
					'connect'           => KANGA_THEME_SETTINGS . '[font-family-h1]',
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Heading <H1> Text Transform
				 */
				array(
					'name'      => KANGA_THEME_SETTINGS . '[text-transform-h1]',
					'section'   => 'section-content-typo',
					'default'   => kanga_get_option( 'text-transform-h1' ),
					'title'     => __( 'Text Transform', 'kanga' ),
					'type'      => 'control',
					'control'   => 'select',
					'priority'  => 8,
					'choices'   => array(
						''           => __( 'Inherit', 'kanga' ),
						'none'       => __( 'None', 'kanga' ),
						'capitalize' => __( 'Capitalize', 'kanga' ),
						'uppercase'  => __( 'Uppercase', 'kanga' ),
						'lowercase'  => __( 'Lowercase', 'kanga' ),
					),
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H1> Line Height
				 */
				array(
					'name'              => KANGA_THEME_SETTINGS . '[line-height-h1]',
					'section'           => 'section-content-typo',
					'default'           => '',
					'sanitize_callback' => array( 'Kanga_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'type'              => 'control',
					'control'           => 'ast-slider',
					'title'             => __( 'Line Height', 'kanga' ),
					'transport'         => 'postMessage',
					'priority'          => 8,
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Heading <H2> Font Family
				 */
				array(
					'name'      => KANGA_THEME_SETTINGS . '[font-family-h2]',
					'type'      => 'control',
					'control'   => 'ast-font',
					'font-type' => 'ast-font-family',
					'title'     => __( 'Family', 'kanga' ),
					'default'   => kanga_get_option( 'font-family-h2' ),
					'section'   => 'section-content-typo',
					'priority'  => 10,
					'connect'   => KANGA_THEME_SETTINGS . '[font-weight-h2]',
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H2> Font Weight
				 */
				array(
					'name'              => KANGA_THEME_SETTINGS . '[font-weight-h2]',
					'type'              => 'control',
					'control'           => 'ast-font',
					'font-type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'kanga' ),
					'section'           => 'section-content-typo',
					'default'           => kanga_get_option( 'font-weight-h2' ),
					'sanitize_callback' => array( 'Kanga_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'priority'          => 12,
					'connect'           => KANGA_THEME_SETTINGS . '[font-family-h2]',
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Heading <H2> Text Transform
				 */
				array(
					'name'      => KANGA_THEME_SETTINGS . '[text-transform-h2]',
					'section'   => 'section-content-typo',
					'default'   => kanga_get_option( 'text-transform-h2' ),
					'title'     => __( 'Text Transform', 'kanga' ),
					'type'      => 'control',
					'control'   => 'select',
					'transport' => 'postMessage',
					'priority'  => 13,
					'choices'   => array(
						''           => __( 'Inherit', 'kanga' ),
						'none'       => __( 'None', 'kanga' ),
						'capitalize' => __( 'Capitalize', 'kanga' ),
						'uppercase'  => __( 'Uppercase', 'kanga' ),
						'lowercase'  => __( 'Lowercase', 'kanga' ),
					),
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H2> Line Height
				 */

				array(
					'name'              => KANGA_THEME_SETTINGS . '[line-height-h2]',
					'section'           => 'section-content-typo',
					'type'              => 'control',
					'control'           => 'ast-slider',
					'default'           => '',
					'sanitize_callback' => array( 'Kanga_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'transport'         => 'postMessage',
					'title'             => __( 'Line Height', 'kanga' ),
					'priority'          => 14,
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Heading <H3> Font Family
				 */
				array(
					'name'      => KANGA_THEME_SETTINGS . '[font-family-h3]',
					'type'      => 'control',
					'control'   => 'ast-font',
					'font-type' => 'ast-font-family',
					'default'   => kanga_get_option( 'font-family-h3' ),
					'title'     => __( 'Family', 'kanga' ),
					'section'   => 'section-content-typo',
					'priority'  => 15,
					'connect'   => KANGA_THEME_SETTINGS . '[font-weight-h3]',
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H3> Font Weight
				 */
				array(
					'name'              => KANGA_THEME_SETTINGS . '[font-weight-h3]',
					'type'              => 'control',
					'control'           => 'ast-font',
					'font-type'         => 'ast-font-weight',
					'sanitize_callback' => array( 'Kanga_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => kanga_get_option( 'font-weight-h3' ),
					'title'             => __( 'Weight', 'kanga' ),
					'section'           => 'section-content-typo',
					'priority'          => 17,
					'connect'           => KANGA_THEME_SETTINGS . '[font-family-h3]',
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Heading <H3> Text Transform
				 */
				array(
					'name'      => KANGA_THEME_SETTINGS . '[text-transform-h3]',
					'type'      => 'control',
					'section'   => 'section-content-typo',
					'title'     => __( 'Text Transform', 'kanga' ),
					'default'   => kanga_get_option( 'text-transform-h3' ),
					'transport' => 'postMessage',
					'control'   => 'select',
					'priority'  => 18,
					'choices'   => array(
						''           => __( 'Inherit', 'kanga' ),
						'none'       => __( 'None', 'kanga' ),
						'capitalize' => __( 'Capitalize', 'kanga' ),
						'uppercase'  => __( 'Uppercase', 'kanga' ),
						'lowercase'  => __( 'Lowercase', 'kanga' ),
					),
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H3> Line Height
				 */
				array(
					'name'              => KANGA_THEME_SETTINGS . '[line-height-h3]',
					'type'              => 'control',
					'control'           => 'ast-slider',
					'section'           => 'section-content-typo',
					'title'             => __( 'Line Height', 'kanga' ),
					'transport'         => 'postMessage',
					'default'           => '',
					'sanitize_callback' => array( 'Kanga_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'priority'          => 19,
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Button Typography Section
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[button-typography-styling-divider]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => 'section-buttons',
					'title'    => __( 'Typography', 'kanga' ),
					'priority' => 25,
					'settings' => array(),
				),

				/**
				 * Option: Button Typography Heading
				 */
				array(
					'name'      => KANGA_THEME_SETTINGS . '[button-text-typography]',
					'default'   => kanga_get_option( 'button-text-typography' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Button Text', 'kanga' ),
					'section'   => 'section-buttons',
					'transport' => 'postMessage',
					'priority'  => 25,
				),

				/**
				 * Option: Button Font Family
				 */
				array(
					'name'      => 'font-family-button',
					'type'      => 'sub-control',
					'parent'    => KANGA_THEME_SETTINGS . '[button-text-typography]',
					'section'   => 'section-buttons',
					'control'   => 'ast-font',
					'font_type' => 'ast-font-family',
					'title'     => __( 'Family', 'kanga' ),
					'default'   => kanga_get_option( 'font-family-button' ),
					'connect'   => KANGA_THEME_SETTINGS . '[font-weight-button]',
					'priority'  => 1,
				),

				/**
				 * Option: Button Font Size
				 */
				array(
					'name'        => 'font-size-button',
					'transport'   => 'postMessage',
					'title'       => __( 'Size', 'kanga' ),
					'type'        => 'sub-control',
					'parent'      => KANGA_THEME_SETTINGS . '[button-text-typography]',
					'section'     => 'section-buttons',
					'control'     => 'ast-responsive',
					'default'     => kanga_get_option( 'font-size-button' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),

				/**
				 * Option: Button Font Weight
				 */
				array(
					'name'              => 'font-weight-button',
					'type'              => 'sub-control',
					'parent'            => KANGA_THEME_SETTINGS . '[button-text-typography]',
					'section'           => 'section-buttons',
					'control'           => 'ast-font',
					'font_type'         => 'ast-font-weight',
					'title'             => __( 'Weight', 'kanga' ),
					'sanitize_callback' => array( 'Kanga_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => kanga_get_option( 'font-weight-button' ),
					'connect'           => 'font-family-button',
					'priority'          => 2,
				),

				/**
				 * Option: Button Text Transform
				 */
				array(
					'name'      => 'text-transform-button',
					'transport' => 'postMessage',
					'default'   => kanga_get_option( 'text-transform-button' ),
					'title'     => __( 'Text Transform', 'kanga' ),
					'type'      => 'sub-control',
					'parent'    => KANGA_THEME_SETTINGS . '[button-text-typography]',
					'section'   => 'section-buttons',
					'control'   => 'ast-select',
					'priority'  => 3,
					'choices'   => array(
						''           => __( 'Inherit', 'kanga' ),
						'none'       => __( 'None', 'kanga' ),
						'capitalize' => __( 'Capitalize', 'kanga' ),
						'uppercase'  => __( 'Uppercase', 'kanga' ),
						'lowercase'  => __( 'Lowercase', 'kanga' ),
					),
				),

				/**
				 * Option: Theme Button Line Height
				 */
				array(
					'name'              => 'theme-btn-line-height',
					'control'           => 'ast-slider',
					'transport'         => 'postMessage',
					'type'              => 'sub-control',
					'default'           => kanga_get_option( 'theme-btn-line-height' ),
					'parent'            => KANGA_THEME_SETTINGS . '[button-text-typography]',
					'section'           => 'section-buttons',
					'sanitize_callback' => array( 'Kanga_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Line Height', 'kanga' ),
					'suffix'            => '',
					'priority'          => 4,
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Theme Button Line Height
				 */
				array(
					'name'              => 'theme-btn-letter-spacing',
					'control'           => 'ast-slider',
					'transport'         => 'postMessage',
					'type'              => 'sub-control',
					'default'           => '',
					'parent'            => KANGA_THEME_SETTINGS . '[button-text-typography]',
					'section'           => 'section-buttons',
					'sanitize_callback' => array( 'Kanga_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Letter Spacing', 'kanga' ),
					'suffix'            => '',
					'priority'          => 5,
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 100,
					),
				),

			);

			return array_merge( $configurations, $_configs );

		}
	}
}

new Kanga_Heading_Colors_Configs();
