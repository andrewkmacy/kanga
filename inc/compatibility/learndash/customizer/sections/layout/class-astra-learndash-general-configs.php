<?php
/**
 * LifterLMS General Options for our theme.
 *
 * @package     Kanga
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kanga_Learndash_General_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Kanga_Learndash_General_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register LearnDash General Layout settings.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Display Serial Number
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[learndash-lesson-serial-number]',
					'section'  => 'section-learndash',
					'type'     => 'control',
					'control'  => 'checkbox',
					'default'  => kanga_get_option( 'learndash-lesson-serial-number' ),
					'title'    => __( 'Display Serial Number', 'kanga' ),
					'priority' => 25,
				),

				/**
				 * Option: Differentiate Rows
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[learndash-differentiate-rows]',
					'default'  => kanga_get_option( 'learndash-differentiate-rows' ),
					'type'     => 'control',
					'control'  => 'checkbox',
					'section'  => 'section-learndash',
					'title'    => __( 'Differentiate Rows', 'kanga' ),
					'priority' => 30,
				),
			);

			return array_merge( $configurations, $_configs );

		}
	}
}

new Kanga_Learndash_General_Configs();
