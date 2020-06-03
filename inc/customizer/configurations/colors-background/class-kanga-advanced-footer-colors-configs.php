<?php
/**
 * Styling Options for Kanga Theme.
 *
 * @package     Kanga
 * @author      Kanga
 * @copyright   Copyright (c) 2020, Kanga
 * @link        https://wpkanga.com/
 * @since       1.4.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kanga_Adv_Footer_Colors_Configs' ) ) {

	/**
	 * Register Advanced Footer Color Customizer Configurations.
	 */
	class Kanga_Advanced_Footer_Colors_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Advanced Footer Color Customizer Configurations.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {
			$_configs = array(

				/**
				 * Option: Footer Widget Color & Background Section heading
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[footer-widget-color-background-heading-divider]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => 'section-footer-adv',
					'title'    => __( 'Colors & Background', 'kanga' ),
					'priority' => 46,
					'settings' => array(),
					'required' => array( KANGA_THEME_SETTINGS . '[footer-adv]', '!=', 'disabled' ),
				),

				/**
				 * Option: Footer Bar Content Group
				 */
				array(
					'name'      => KANGA_THEME_SETTINGS . '[footer-widget-background-group]',
					'default'   => kanga_get_option( 'footer-widget-background-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Background', 'kanga' ),
					'section'   => 'section-footer-adv',
					'transport' => 'postMessage',
					'priority'  => 46,
					'required'  => array( KANGA_THEME_SETTINGS . '[footer-adv]', '!=', 'disabled' ),
				),

				/**
				 * Option: Footer Bar Content Group
				 */
				array(
					'name'      => KANGA_THEME_SETTINGS . '[footer-widget-content-group]',
					'default'   => kanga_get_option( 'footer-widget-content-group' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Content', 'kanga' ),
					'section'   => 'section-footer-adv',
					'transport' => 'postMessage',
					'priority'  => 46,
					'required'  => array( KANGA_THEME_SETTINGS . '[footer-adv]', '!=', 'disabled' ),
				),

				/**
				 * Option: Widget Title Color
				 */
				array(
					'name'    => 'footer-adv-wgt-title-color',
					'type'    => 'sub-control',
					'parent'  => KANGA_THEME_SETTINGS . '[footer-widget-content-group]',
					'section' => 'section-footer-adv',
					'tab'     => __( 'Normal', 'kanga' ),
					'control' => 'ast-color',
					'title'   => __( 'Title Color', 'kanga' ),
					'default' => '',
				),

				/**
				 * Option: Text Color
				 */
				array(
					'name'    => 'footer-adv-text-color',
					'type'    => 'sub-control',
					'parent'  => KANGA_THEME_SETTINGS . '[footer-widget-content-group]',
					'section' => 'section-footer-adv',
					'tab'     => __( 'Normal', 'kanga' ),
					'control' => 'ast-color',
					'title'   => __( 'Text Color', 'kanga' ),
					'default' => '',
				),

				/**
				 * Option: Link Color
				 */
				array(
					'name'    => 'footer-adv-link-color',
					'type'    => 'sub-control',
					'parent'  => KANGA_THEME_SETTINGS . '[footer-widget-content-group]',
					'section' => 'section-footer-adv',
					'tab'     => __( 'Normal', 'kanga' ),
					'control' => 'ast-color',
					'title'   => __( 'Link Color', 'kanga' ),
					'default' => '',
				),

				/**
				 * Option: Link Hover Color
				 */
				array(
					'name'    => 'footer-adv-link-h-color',
					'type'    => 'sub-control',
					'parent'  => KANGA_THEME_SETTINGS . '[footer-widget-content-group]',
					'section' => 'section-footer-adv',
					'tab'     => __( 'Hover', 'kanga' ),
					'control' => 'ast-color',
					'title'   => __( 'Link Color', 'kanga' ),
					'default' => '',
				),

				/**
				 * Option: Footer widget Background
				 */
				array(
					'name'    => 'footer-adv-bg-obj',
					'type'    => 'sub-control',
					'parent'  => KANGA_THEME_SETTINGS . '[footer-widget-background-group]',
					'section' => 'section-footer-adv',
					'control' => 'ast-background',
					'default' => kanga_get_option( 'footer-adv-bg-obj' ),
					'label'   => __( 'Background', 'kanga' ),
				),

			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;
		}
	}
}

new Kanga_Advanced_Footer_Colors_Configs();


