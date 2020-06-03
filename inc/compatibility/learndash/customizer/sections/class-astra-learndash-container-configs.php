<?php
/**
 * Container Options for Kanga theme.
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

if ( ! class_exists( 'Kanga_Learndash_Container_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Kanga_Learndash_Container_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register LearnDash Container settings.
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
					'name'     => KANGA_THEME_SETTINGS . '[learndash-content-divider]',
					'type'     => 'control',
					'section'  => 'section-container-layout',
					'control'  => 'ast-divider',
					'priority' => 68,
					'settings' => array(),
				),

				/**
				 * Option: Shop Page
				 */
				array(
					'name'        => KANGA_THEME_SETTINGS . '[learndash-content-layout]',
					'type'        => 'control',
					'control'     => 'select',
					'section'     => 'section-container-layout',
					'default'     => kanga_get_option( 'learndash-content-layout' ),
					'priority'    => 68,
					'title'       => __( 'LearnDash Layout', 'kanga' ),
					'description' => __( 'Will be applied to All Single Courses, Topics, Lessons and Quizzes. Does not work on pages created with LearnDash shortcodes.', 'kanga' ),
					'choices'     => array(
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

new Kanga_Learndash_Container_Configs();
