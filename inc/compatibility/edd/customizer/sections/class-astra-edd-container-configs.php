<?php
/**
 * Easy Digital Downloads Container Options for Kanga theme.
 *
 * @package     Kanga
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Kanga 1.5.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kanga_Edd_Container_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Kanga_Edd_Container_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Kanga-Easy Digital Downloads Shop Container Settings.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.5.5
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Divider
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[edd-content-divider]',
					'type'     => 'control',
					'section'  => 'section-container-layout',
					'control'  => 'ast-divider',
					'priority' => 85,
					'settings' => array(),
				),

				/**
				 * Option: Shop Page
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[edd-content-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'default'  => kanga_get_option( 'edd-content-layout' ),
					'section'  => 'section-container-layout',
					'priority' => 85,
					'title'    => __( 'Easy Digital Downloads Layout', 'kanga' ),
					'choices'  => array(
						'default'                 => __( 'Default', 'kanga' ),
						'boxed-container'         => __( 'Boxed', 'kanga' ),
						'content-boxed-container' => __( 'Content Boxed', 'kanga' ),
						'plain-container'         => __( 'Full Width / Contained', 'kanga' ),
						'page-builder'            => __( 'Full Width / Stretched', 'kanga' ),
					),
				),
			);

			return array_merge( $configurations, $_configs );

		}
	}
}

new Kanga_Edd_Container_Configs();

