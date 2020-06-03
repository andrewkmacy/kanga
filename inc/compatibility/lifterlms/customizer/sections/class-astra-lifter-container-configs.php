<?php
/**
 * Container Options for Kanga theme.
 *
 * @package     Kanga
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       1.4.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kanga_Lifter_Container_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 *
	 * @since 1.4.3
	 */
	class Kanga_Lifter_Container_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register LifterLMS Container Settings.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[lifterlms-content-divider]',
					'section'  => 'section-container-layout',
					'type'     => 'control',
					'control'  => 'ast-divider',
					'priority' => 66,
					'settings' => array(),
				),

				/**
				 * Option: Shop Page
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[lifterlms-content-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-container-layout',
					'default'  => kanga_get_option( 'lifterlms-content-layout' ),
					'priority' => 66,
					'title'    => __( 'LifterLMS Layout', 'kanga' ),
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

new Kanga_Lifter_Container_Configs();


