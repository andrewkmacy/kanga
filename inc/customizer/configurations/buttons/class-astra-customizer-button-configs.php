<?php
/**
 * Kanga Theme Customizer Configuration Base.
 *
 * @package     Kanga
 * @author      Kanga
 * @copyright   Copyright (c) 2020, Kanga
 * @link        https://wpkanga.com/
 * @since       Kanga 1.4.3
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Sanitizes
 *
 * @since 1.4.3
 */
if ( ! class_exists( 'Kanga_Customizer_Button_Configs' ) ) {

	/**
	 * Register Button Customizer Configurations.
	 */
	class Kanga_Customizer_Button_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Button Customizer Configurations.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				array(
					'name'     => ASTRA_THEME_SETTINGS . '[button-color-styling-divider]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => 'section-buttons',
					'title'    => __( 'Colors and Border', 'kanga' ),
					'priority' => 17,
					'settings' => array(),
				),
				/**
				 * Group: Theme Button Colors Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[theme-button-color-group]',
					'default'   => kanga_get_option( 'theme-button-color-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Color', 'kanga' ),
					'section'   => 'section-buttons',
					'transport' => 'postMessage',
					'priority'  => 18,
				),

				/**
				 * Group: Theme Button Border Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[theme-button-border-group]',
					'default'   => kanga_get_option( 'theme-button-border-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Border', 'kanga' ),
					'section'   => 'section-buttons',
					'transport' => 'postMessage',
					'priority'  => 19,
				),

				/**
				 * Option: Button Color
				 */
				array(
					'name'    => 'button-color',
					'default' => '',
					'type'    => 'sub-control',
					'parent'  => ASTRA_THEME_SETTINGS . '[theme-button-color-group]',
					'section' => 'section-buttons',
					'tab'     => __( 'Normal', 'kanga' ),
					'control' => 'ast-color',
					'title'   => __( 'Text Color', 'kanga' ),
				),

				/**
				 * Option: Button Hover Color
				 */
				array(
					'name'    => 'button-h-color',
					'default' => '',
					'type'    => 'sub-control',
					'parent'  => ASTRA_THEME_SETTINGS . '[theme-button-color-group]',
					'section' => 'section-buttons',
					'tab'     => __( 'Hover', 'kanga' ),
					'control' => 'ast-color',
					'title'   => __( 'Text Color', 'kanga' ),
				),

				/**
				 * Option: Button Background Color
				 */
				array(
					'name'    => 'button-bg-color',
					'default' => '',
					'type'    => 'sub-control',
					'parent'  => ASTRA_THEME_SETTINGS . '[theme-button-color-group]',
					'section' => 'section-buttons',
					'tab'     => __( 'Normal', 'kanga' ),
					'control' => 'ast-color',
					'title'   => __( 'Background Color', 'kanga' ),
				),

				/**
				 * Option: Button Background Hover Color
				 */
				array(
					'name'    => 'button-bg-h-color',
					'default' => '',
					'type'    => 'sub-control',
					'parent'  => ASTRA_THEME_SETTINGS . '[theme-button-color-group]',
					'section' => 'section-buttons',
					'tab'     => __( 'Hover', 'kanga' ),
					'control' => 'ast-color',
					'title'   => __( 'Background Color', 'kanga' ),
				),

				/**
				 * Option: Global Button Border Size
				 */
				array(
					'type'           => 'sub-control',
					'parent'         => ASTRA_THEME_SETTINGS . '[theme-button-border-group]',
					'section'        => 'section-buttons',
					'control'        => 'ast-border',
					'name'           => 'theme-button-border-group-border-size',
					'transport'      => 'postMessage',
					'linked_choices' => true,
					'priority'       => 10,
					'default'        => kanga_get_option( 'theme-button-border-group-border-size' ),
					'title'          => __( 'Width', 'kanga' ),
					'choices'        => array(
						'top'    => __( 'Top', 'kanga' ),
						'right'  => __( 'Right', 'kanga' ),
						'bottom' => __( 'Bottom', 'kanga' ),
						'left'   => __( 'Left', 'kanga' ),
					),
				),

				/**
				 * Option: Global Button Border Color
				 */
				array(
					'name'      => 'theme-button-border-group-border-color',
					'default'   => kanga_get_option( 'theme-button-border-group-border-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[theme-button-border-group]',
					'section'   => 'section-buttons',
					'control'   => 'ast-color',
					'priority'  => 12,
					'title'     => __( 'Color', 'kanga' ),
				),

				/**
				 * Option: Global Button Border Hover Color
				 */
				array(
					'name'      => 'theme-button-border-group-border-h-color',
					'default'   => kanga_get_option( 'theme-button-border-group-border-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[theme-button-border-group]',
					'section'   => 'section-buttons',
					'control'   => 'ast-color',
					'priority'  => 14,
					'title'     => __( 'Hover Color', 'kanga' ),
				),

				/**
				 * Option: Global Button Radius
				 */
				array(
					'name'        => 'button-radius',
					'default'     => kanga_get_option( 'button-radius' ),
					'type'        => 'sub-control',
					'parent'      => ASTRA_THEME_SETTINGS . '[theme-button-border-group]',
					'section'     => 'section-buttons',
					'control'     => 'ast-slider',
					'title'       => __( 'Border Radius', 'kanga' ),
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 200,
					),
				),

				/**
				 * Option: Button Padding Section
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[button-padding-styling-divider]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => 'section-buttons',
					'title'    => __( 'Spacing', 'kanga' ),
					'priority' => 30,
					'settings' => array(),
				),

				/**
				 * Option: Theme Button Padding
				 */
				array(
					'name'           => ASTRA_THEME_SETTINGS . '[theme-button-padding]',
					'default'        => kanga_get_option( 'theme-button-padding' ),
					'type'           => 'control',
					'control'        => 'ast-responsive-spacing',
					'section'        => 'section-buttons',
					'title'          => __( 'Padding', 'kanga' ),
					'linked_choices' => true,
					'transport'      => 'postMessage',
					'unit_choices'   => array( 'px', 'em', '%' ),
					'choices'        => array(
						'top'    => __( 'Top', 'kanga' ),
						'right'  => __( 'Right', 'kanga' ),
						'bottom' => __( 'Bottom', 'kanga' ),
						'left'   => __( 'Left', 'kanga' ),
					),
					'priority'       => 35,
				),

				/**
				 * Option: Primary Header Button Colors Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[primary-header-button-color-divider]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => 'section-primary-menu',
					'title'    => __( 'Header Button', 'kanga' ),
					'settings' => array(),
					'priority' => 17,
					'required' => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
				),
				/**
				 * Group: Primary Header Button Colors Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[primary-header-button-color-group]',
					'default'   => kanga_get_option( 'primary-header-button-color-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Colors', 'kanga' ),
					'section'   => 'section-primary-menu',
					'transport' => 'postMessage',
					'priority'  => 18,
					'required'  => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
				),
				/**
				 * Group: Primary Header Button Border Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[primary-header-button-border-group]',
					'default'   => kanga_get_option( 'primary-header-button-border-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Border', 'kanga' ),
					'section'   => 'section-primary-menu',
					'transport' => 'postMessage',
					'priority'  => 19,
					'required'  => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
				),

				/**
				* Option: Button Text Color
				*/
				array(
					'name'      => 'header-main-rt-section-button-text-color',
					'transport' => 'postMessage',
					'default'   => kanga_get_option( 'header-main-rt-section-button-text-color' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[primary-header-button-color-group]',
					'section'   => 'section-primary-menu',
					'tab'       => __( 'Normal', 'kanga' ),
					'control'   => 'ast-color',
					'priority'  => 10,
					'title'     => __( 'Text Color', 'kanga' ),
				),

				/**
				* Option: Button Text Hover Color
				*/
				array(
					'name'      => 'header-main-rt-section-button-text-h-color',
					'default'   => kanga_get_option( 'header-main-rt-section-button-text-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[primary-header-button-color-group]',
					'section'   => 'section-primary-menu',
					'tab'       => __( 'Hover', 'kanga' ),
					'control'   => 'ast-color',
					'priority'  => 10,
					'title'     => __( 'Text Color', 'kanga' ),
				),

				/**
				* Option: Button Background Color
				*/
				array(
					'name'      => 'header-main-rt-section-button-back-color',
					'default'   => kanga_get_option( 'header-main-rt-section-button-back-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[primary-header-button-color-group]',
					'section'   => 'section-primary-menu',
					'tab'       => __( 'Normal', 'kanga' ),
					'control'   => 'ast-color',
					'priority'  => 10,
					'title'     => __( 'Background Color', 'kanga' ),
				),

				/**
				* Option: Button Button Hover Color
				*/
				array(
					'name'      => 'header-main-rt-section-button-back-h-color',
					'default'   => kanga_get_option( 'header-main-rt-section-button-back-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[primary-header-button-color-group]',
					'section'   => 'section-primary-menu',
					'tab'       => __( 'Hover', 'kanga' ),
					'control'   => 'ast-color',
					'priority'  => 10,
					'title'     => __( 'Background Color', 'kanga' ),
				),

				// Option: Custom Menu Button Border.
				array(
					'type'           => 'control',
					'control'        => 'ast-responsive-spacing',
					'name'           => ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-padding]',
					'section'        => 'section-primary-menu',
					'transport'      => 'postMessage',
					'linked_choices' => true,
					'priority'       => 20,
					'required'       => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
					'default'        => kanga_get_option( 'header-main-rt-section-button-padding' ),
					'title'          => __( 'Padding', 'kanga' ),
					'choices'        => array(
						'top'    => __( 'Top', 'kanga' ),
						'right'  => __( 'Right', 'kanga' ),
						'bottom' => __( 'Bottom', 'kanga' ),
						'left'   => __( 'Left', 'kanga' ),
					),
				),

				/**
				* Option: Button Border Size
				*/
				array(
					'type'           => 'sub-control',
					'parent'         => ASTRA_THEME_SETTINGS . '[primary-header-button-border-group]',
					'section'        => 'section-primary-menu',
					'control'        => 'ast-border',
					'name'           => 'header-main-rt-section-button-border-size',
					'transport'      => 'postMessage',
					'linked_choices' => true,
					'priority'       => 10,
					'default'        => kanga_get_option( 'header-main-rt-section-button-border-size' ),
					'title'          => __( 'Width', 'kanga' ),
					'choices'        => array(
						'top'    => __( 'Top', 'kanga' ),
						'right'  => __( 'Right', 'kanga' ),
						'bottom' => __( 'Bottom', 'kanga' ),
						'left'   => __( 'Left', 'kanga' ),
					),
				),

				/**
				* Option: Button Border Color
				*/
				array(
					'name'      => 'header-main-rt-section-button-border-color',
					'default'   => kanga_get_option( 'header-main-rt-section-button-border-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[primary-header-button-border-group]',
					'section'   => 'section-primary-menu',
					'control'   => 'ast-color',
					'priority'  => 12,
					'title'     => __( 'Color', 'kanga' ),
				),

				/**
				* Option: Button Border Hover Color
				*/
				array(
					'name'      => 'header-main-rt-section-button-border-h-color',
					'default'   => kanga_get_option( 'header-main-rt-section-button-border-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[primary-header-button-border-group]',
					'section'   => 'section-primary-menu',
					'control'   => 'ast-color',
					'priority'  => 14,
					'title'     => __( 'Hover Color', 'kanga' ),
				),

				/**
				* Option: Button Border Radius
				*/
				array(
					'name'        => 'header-main-rt-section-button-border-radius',
					'default'     => kanga_get_option( 'header-main-rt-section-button-border-radius' ),
					'type'        => 'sub-control',
					'parent'      => ASTRA_THEME_SETTINGS . '[primary-header-button-border-group]',
					'section'     => 'section-primary-menu',
					'control'     => 'ast-slider',
					'transport'   => 'postMessage',
					'priority'    => 16,
					'title'       => __( 'Border Radius', 'kanga' ),
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 100,
					),
				),

				/**
				 * Option: Transparent Header Button Colors Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[transparent-header-button-color-divider]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => 'section-transparent-header',
					'title'    => __( 'Header Button', 'kanga' ),
					'settings' => array(),
					'priority' => 40,
					'required' => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
				),
				/**
				 * Group: Transparent Header Button Colors Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[transparent-header-button-color-group]',
					'default'   => kanga_get_option( 'transparent-header-button-color-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Colors', 'kanga' ),
					'section'   => 'section-transparent-header',
					'transport' => 'postMessage',
					'priority'  => 40,
					'required'  => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
				),
				/**
				 * Group: Transparent Header Button Border Group
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[transparent-header-button-border-group]',
					'default'   => kanga_get_option( 'transparent-header-button-border-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Border', 'kanga' ),
					'section'   => 'section-transparent-header',
					'transport' => 'postMessage',
					'priority'  => 40,
					'required'  => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
				),

				/**
				* Option: Button Text Color
				*/
				array(
					'name'      => 'header-main-rt-trans-section-button-text-color',
					'transport' => 'postMessage',
					'default'   => kanga_get_option( 'header-main-rt-trans-section-button-text-color' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[transparent-header-button-color-group]',
					'section'   => 'section-transparent-header',
					'tab'       => __( 'Normal', 'kanga' ),
					'control'   => 'ast-color',
					'priority'  => 10,
					'title'     => __( 'Text Color', 'kanga' ),
				),

				/**
				* Option: Button Text Hover Color
				*/
				array(
					'name'      => 'header-main-rt-trans-section-button-text-h-color',
					'default'   => kanga_get_option( 'header-main-rt-trans-section-button-text-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[transparent-header-button-color-group]',
					'section'   => 'section-transparent-header',
					'tab'       => __( 'Hover', 'kanga' ),
					'control'   => 'ast-color',
					'priority'  => 10,
					'title'     => __( 'Text Color', 'kanga' ),
				),

				/**
				* Option: Button Background Color
				*/
				array(
					'name'      => 'header-main-rt-trans-section-button-back-color',
					'default'   => kanga_get_option( 'header-main-rt-trans-section-button-back-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[transparent-header-button-color-group]',
					'section'   => 'section-transparent-header',
					'tab'       => __( 'Normal', 'kanga' ),
					'control'   => 'ast-color',
					'priority'  => 10,
					'title'     => __( 'Background Color', 'kanga' ),
				),

				/**
				* Option: Button Button Hover Color
				*/
				array(
					'name'      => 'header-main-rt-trans-section-button-back-h-color',
					'default'   => kanga_get_option( 'header-main-rt-trans-section-button-back-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[transparent-header-button-color-group]',
					'section'   => 'section-transparent-header',
					'tab'       => __( 'Hover', 'kanga' ),
					'control'   => 'ast-color',
					'priority'  => 10,
					'title'     => __( 'Background Color', 'kanga' ),
				),

				// Option: Custom Menu Button Border.
				array(
					'type'           => 'control',
					'control'        => 'ast-responsive-spacing',
					'name'           => ASTRA_THEME_SETTINGS . '[header-main-rt-trans-section-button-padding]',
					'section'        => 'section-transparent-header',
					'transport'      => 'postMessage',
					'linked_choices' => true,
					'priority'       => 40,
					'required'       => array( ASTRA_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
					'default'        => kanga_get_option( 'header-main-rt-trans-section-button-padding' ),
					'title'          => __( 'Padding', 'kanga' ),
					'choices'        => array(
						'top'    => __( 'Top', 'kanga' ),
						'right'  => __( 'Right', 'kanga' ),
						'bottom' => __( 'Bottom', 'kanga' ),
						'left'   => __( 'Left', 'kanga' ),
					),
				),

				/**
				* Option: Button Border Size
				*/
				array(
					'type'           => 'sub-control',
					'parent'         => ASTRA_THEME_SETTINGS . '[transparent-header-button-border-group]',
					'section'        => 'section-transparent-header',
					'control'        => 'ast-border',
					'name'           => 'header-main-rt-trans-section-button-border-size',
					'transport'      => 'postMessage',
					'linked_choices' => true,
					'priority'       => 10,
					'default'        => kanga_get_option( 'header-main-rt-trans-section-button-border-size' ),
					'title'          => __( 'Width', 'kanga' ),
					'choices'        => array(
						'top'    => __( 'Top', 'kanga' ),
						'right'  => __( 'Right', 'kanga' ),
						'bottom' => __( 'Bottom', 'kanga' ),
						'left'   => __( 'Left', 'kanga' ),
					),
				),

				/**
				* Option: Button Border Color
				*/
				array(
					'name'      => 'header-main-rt-trans-section-button-border-color',
					'default'   => kanga_get_option( 'header-main-rt-trans-section-button-border-color' ),
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[transparent-header-button-border-group]',
					'section'   => 'section-transparent-header',
					'transport' => 'postMessage',
					'control'   => 'ast-color',
					'priority'  => 12,
					'title'     => __( 'Color', 'kanga' ),
				),

				/**
				* Option: Button Border Hover Color
				*/
				array(
					'name'      => 'header-main-rt-trans-section-button-border-h-color',
					'default'   => kanga_get_option( 'header-main-rt-trans-section-button-border-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => ASTRA_THEME_SETTINGS . '[transparent-header-button-border-group]',
					'control'   => 'ast-color',
					'priority'  => 14,
					'title'     => __( 'Hover Color', 'kanga' ),
				),

				/**
				* Option: Button Border Radius
				*/
				array(
					'name'        => 'header-main-rt-trans-section-button-border-radius',
					'default'     => kanga_get_option( 'header-main-rt-trans-section-button-border-radius' ),
					'type'        => 'sub-control',
					'parent'      => ASTRA_THEME_SETTINGS . '[transparent-header-button-border-group]',
					'section'     => 'section-transparent-header',
					'control'     => 'ast-slider',
					'transport'   => 'postMessage',
					'priority'    => 16,
					'title'       => __( 'Border Radius', 'kanga' ),
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 100,
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
new Kanga_Customizer_Button_Configs();
