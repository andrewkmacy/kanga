<?php
/**
 * Styling Options for Kanga Theme.
 *
 * @package     Kanga
 * @author      Kanga
 * @copyright   Copyright (c) 2020, Kanga
 * @link        https://wpkanga.com/
 * @since       Kanga 1.0.15
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kanga_Header_Typo_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Kanga_Header_Typo_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Header Typography Customizer Configurations.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Site Title Font Size
				 */
				array(
					'name'        => 'font-size-site-title',
					'type'        => 'sub-control',
					'parent'      => KANGA_THEME_SETTINGS . '[site-title-typography]',
					'section'     => 'title_tagline',
					'control'     => 'ast-responsive',
					'default'     => kanga_get_option( 'font-size-site-title' ),
					'transport'   => 'postMessage',
					'priority'    => 9,
					'title'       => __( 'Size', 'kanga' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),

				/**
				 * Option: Site Tagline Font Size
				 */
				array(
					'name'        => 'font-size-site-tagline',
					'type'        => 'sub-control',
					'parent'      => KANGA_THEME_SETTINGS . '[site-tagline-typography]',
					'section'     => 'title_tagline',
					'control'     => 'ast-responsive',
					'default'     => kanga_get_option( 'font-size-site-tagline' ),
					'transport'   => 'postMessage',
					'priority'    => 15,
					'title'       => __( 'Size', 'kanga' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;
		}
	}
}

new Kanga_Header_Typo_Configs();


