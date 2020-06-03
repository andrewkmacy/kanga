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

if ( ! class_exists( 'Kanga_Body_Colors_Configs' ) ) {

	/**
	 * Register Body Color Customizer Configurations.
	 */
	class Kanga_Body_Colors_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Body Color Customizer Configurations.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {
			$_configs = array(

				/**
				 * Option: Text Color
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[text-color]',
					'default'  => '#3a3a3a',
					'type'     => 'control',
					'control'  => 'ast-color',
					'section'  => 'section-colors-body',
					'priority' => 5,
					'title'    => __( 'Text Color', 'kanga' ),
				),

				/**
				 * Option: Theme Color
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[theme-color]',
					'type'     => 'control',
					'control'  => 'ast-color',
					'section'  => 'section-colors-body',
					'default'  => '#0274be',
					'priority' => 5,
					'title'    => __( 'Theme Color', 'kanga' ),
				),

				/**
				 * Option: Link Color
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[link-color]',
					'section'  => 'section-colors-body',
					'type'     => 'control',
					'control'  => 'ast-color',
					'default'  => '#0274be',
					'priority' => 5,
					'title'    => __( 'Link Color', 'kanga' ),
				),

				/**
				 * Option: Link Hover Color
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[link-h-color]',
					'section'  => 'section-colors-body',
					'default'  => '#3a3a3a',
					'type'     => 'control',
					'control'  => 'ast-color',
					'priority' => 15,
					'title'    => __( 'Link Hover Color', 'kanga' ),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[divider-outside-bg-color]',
					'type'     => 'control',
					'control'  => 'ast-divider',
					'section'  => 'section-colors-body',
					'priority' => 20,
					'settings' => array(),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;
		}
	}
}

new Kanga_Body_Colors_Configs();


