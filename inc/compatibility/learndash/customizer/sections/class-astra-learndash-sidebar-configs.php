<?php
/**
 * Content Spacing Options for our theme.
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

if ( ! class_exists( 'Kanga_Learndash_Sidebar_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Kanga_Learndash_Sidebar_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register LearnDash Sidebar settings.
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
					'name'     => ASTRA_THEME_SETTINGS . '[learndash-sidebar-layout-divider]',
					'type'     => 'control',
					'section'  => 'section-sidebars',
					'control'  => 'ast-divider',
					'priority' => 5,
					'settings' => array(),
				),

				/**
				 * Option: LearnDash
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[learndash-sidebar-layout]',
					'type'        => 'control',
					'control'     => 'select',
					'section'     => 'section-sidebars',
					'default'     => kanga_get_option( 'learndash-sidebar-layout' ),
					'priority'    => 5,
					'title'       => __( 'LearnDash', 'kanga' ),
					'description' => __( 'This layout will apply on all single course, lesson, topic and quiz.', 'kanga' ),
					'choices'     => array(
						'default'       => __( 'Default', 'kanga' ),
						'no-sidebar'    => __( 'No Sidebar', 'kanga' ),
						'left-sidebar'  => __( 'Left Sidebar', 'kanga' ),
						'right-sidebar' => __( 'Right Sidebar', 'kanga' ),
					),
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new Kanga_Learndash_Sidebar_Configs();
