<?php
/**
 * Register customizer panels & sections.
 *
 * @package     Kanga
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       Kanga 1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Kanga_Liferlms_Section_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Kanga_Liferlms_Section_Configs extends Kanga_Customizer_Config_Base {

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

				array(
					'name'     => 'section-lifterlms',
					'type'     => 'section',
					'priority' => 65,
					'title'    => __( 'LifterLMS', 'kanga' ),
				),
			);

			return array_merge( $configurations, $_configs );

		}
	}
}

new Kanga_Liferlms_Section_Configs();
