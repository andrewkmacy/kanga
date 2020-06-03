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

if ( ! class_exists( 'Kanga_Footer_Colors_Configs' ) ) {

	/**
	 * Register Footer Color Configurations.
	 */
	class Kanga_Footer_Colors_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Footer Color Configurations.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {
			$_configs = array(

				/**
				 * Option: Color
				 */
				array(
					'name'     => 'footer-color',
					'type'     => 'sub-control',
					'tab'      => __( 'Normal', 'kanga' ),
					'priority' => 5,
					'parent'   => ASTRA_THEME_SETTINGS . '[footer-bar-content-group]',
					'section'  => 'section-footer-small',
					'control'  => 'ast-color',
					'title'    => __( 'Text Color', 'kanga' ),
					'default'  => '',
				),

				/**
				 * Option: Link Color
				 */
				array(
					'name'     => 'footer-link-color',
					'type'     => 'sub-control',
					'tab'      => __( 'Normal', 'kanga' ),
					'priority' => 6,
					'parent'   => ASTRA_THEME_SETTINGS . '[footer-bar-content-group]',
					'section'  => 'section-footer-small',
					'control'  => 'ast-color',
					'default'  => '',
					'title'    => __( 'Link Color', 'kanga' ),
				),

				/**
				 * Option: Link Hover Color
				 */
				array(
					'name'     => 'footer-link-h-color',
					'type'     => 'sub-control',
					'tab'      => __( 'Hover', 'kanga' ),
					'priority' => 5,
					'parent'   => ASTRA_THEME_SETTINGS . '[footer-bar-content-group]',
					'section'  => 'section-footer-small',
					'control'  => 'ast-color',
					'title'    => __( 'Link Color', 'kanga' ),
					'default'  => '',
				),

				/**
				 * Option: Footer Background
				 */
				array(
					'name'     => 'footer-bg-obj',
					'type'     => 'sub-control',
					'priority' => 7,
					'parent'   => ASTRA_THEME_SETTINGS . '[footer-bar-background-group]',
					'section'  => 'section-footer-small',
					'control'  => 'ast-background',
					'default'  => kanga_get_option( 'footer-bg-obj' ),
					'label'    => __( 'Background', 'kanga' ),
				),

			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;
		}
	}
}

new Kanga_Footer_Colors_Configs();


