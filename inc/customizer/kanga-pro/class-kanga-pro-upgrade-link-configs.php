<?php
/**
 * Register customizer Aspra Pro Section.
 *
 * @package   Kanga
 * @author    Kanga
 * @copyright Copyright (c) 2020, Kanga
 * @link      https://wpkanga.com/
 * @since     Kanga 1.0.10
 */

if ( ! class_exists( 'Kanga_Pro_Upgrade_Link_Configs' ) ) {

	/**
	 * Register Button Customizer Configurations.
	 */
	class Kanga_Pro_Upgrade_Link_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Button Customizer Configurations.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(
				array(
					'name'             => 'kanga-pro',
					'type'             => 'section',
					'title'            => esc_html__( 'More Options Available in Kanga Pro!', 'kanga' ),
					'pro_url'          => htmlspecialchars_decode( kanga_get_pro_url( 'https://wpkanga.com/pricing/', 'customizer', 'upgrade-link', 'upgrade-to-pro' ) ),
					'priority'         => 1,
					'section_callback' => 'Kanga_Pro_Customizer',
				),
			);

			return array_merge( $configurations, $_configs );

		}
	}
}

new Kanga_Pro_Upgrade_Link_Configs();

