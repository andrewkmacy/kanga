<?php
/**
 * WooCommerce Options for Kanga Theme.
 *
 * @package     Kanga
 * @author      Kanga
 * @copyright   Copyright (c) 2020, Kanga
 * @link        https://wpkanga.com/
 * @since       Kanga 1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kanga_Woo_Shop_Layout_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Kanga_Woo_Shop_Layout_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Kanga-WooCommerce Shop Layout Customizer Configurations.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Shop Columns
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[shop-grids]',
					'type'        => 'control',
					'control'     => 'ast-responsive-slider',
					'section'     => 'woocommerce_product_catalog',
					'default'     => array(
						'desktop' => 4,
						'tablet'  => 3,
						'mobile'  => 2,
					),
					'priority'    => 11,
					'title'       => __( 'Shop Columns', 'kanga' ),
					'input_attrs' => array(
						'step' => 1,
						'min'  => 1,
						'max'  => 6,
					),
				),

				/**
				 * Option: Products Per Page
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[shop-no-of-products]',
					'type'        => 'control',
					'section'     => 'woocommerce_product_catalog',
					'title'       => __( 'Products Per Page', 'kanga' ),
					'default'     => kanga_get_option( 'shop-no-of-products' ),
					'control'     => 'number',
					'priority'    => 15,
					'input_attrs' => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 100,
					),
				),

				/**
				 * Option: Single Post Meta
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-product-structure]',
					'type'     => 'control',
					'control'  => 'ast-sortable',
					'section'  => 'woocommerce_product_catalog',
					'default'  => kanga_get_option( 'shop-product-structure' ),
					'priority' => 15,
					'title'    => __( 'Shop Product Structure', 'kanga' ),
					'choices'  => array(
						'title'      => __( 'Title', 'kanga' ),
						'price'      => __( 'Price', 'kanga' ),
						'ratings'    => __( 'Ratings', 'kanga' ),
						'short_desc' => __( 'Short Description', 'kanga' ),
						'add_cart'   => __( 'Add To Cart', 'kanga' ),
						'category'   => __( 'Category', 'kanga' ),
					),
				),

				/**
				 * Option: Shop Archive Content Width
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[shop-archive-width]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'woocommerce_product_catalog',
					'default'  => kanga_get_option( 'shop-archive-width' ),
					'priority' => 10,
					'title'    => __( 'Shop Archive Content Width', 'kanga' ),
					'choices'  => array(
						'default' => __( 'Default', 'kanga' ),
						'custom'  => __( 'Custom', 'kanga' ),
					),
				),

				/**
				 * Option: Enter Width
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[shop-archive-max-width]',
					'type'        => 'control',
					'control'     => 'ast-slider',
					'section'     => 'woocommerce_product_catalog',
					'default'     => 1200,
					'priority'    => 10,
					'required'    => array( ASTRA_THEME_SETTINGS . '[shop-archive-width]', '===', 'custom' ),
					'title'       => __( 'Custom Width', 'kanga' ),
					'transport'   => 'postMessage',
					'suffix'      => '',
					'input_attrs' => array(
						'min'  => 768,
						'step' => 1,
						'max'  => 1920,
					),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;

		}
	}
}

new Kanga_Woo_Shop_Layout_Configs();

