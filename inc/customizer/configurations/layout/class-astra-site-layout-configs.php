<?php
/**
 * Site Layout Option for Kanga Theme.
 *
 * @package     Kanga
 * @author      Kanga
 * @copyright   Copyright (c) 2020, Kanga
 * @link        https://wpkanga.com/
 * @since       Kanga 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kanga_Site_Layout_Configs' ) ) {

	/**
	 * Register Site Layout Customizer Configurations.
	 */
	class Kanga_Site_Layout_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Site Layout Customizer Configurations.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				array(
					'name'        => KANGA_THEME_SETTINGS . '[site-content-width]',
					'type'        => 'control',
					'control'     => 'ast-slider',
					'default'     => 1200,
					'section'     => 'section-container-layout',
					'priority'    => 10,
					'title'       => __( 'Width', 'kanga' ),
					'required'    => array( KANGA_THEME_SETTINGS . '[site-layout]', '==', 'ast-full-width-layout' ),
					'suffix'      => '',
					'input_attrs' => array(
						'min'  => 768,
						'step' => 1,
						'max'  => 1920,
					),
				),
			);

			return array_merge( $configurations, $_configs );
		}

	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new Kanga_Site_Layout_Configs();
