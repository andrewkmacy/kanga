<?php
/**
 * Bottom Footer Options for Kanga Theme.
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

if ( ! class_exists( 'Kanga_Site_Identity_Configs' ) ) {

	/**
	 * Register Kanga Customizerr Site identity Customizer Configurations.
	 */
	class Kanga_Site_Identity_Configs extends Kanga_Customizer_Config_Base {

		/**
		 * Register Kanga Customizerr Site identity Customizer Configurations.
		 *
		 * @param Array                $configurations Kanga Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Kanga Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/** Header Background Image
				 * 
				 */
				array(
					'name'           => KANGA_THEME_SETTINGS . '[theme-header-bg]',
					'default'        => kanga_get_option( 'theme-header-bg' ),
					'type'           => 'control',
					'control'        => 'image',
					'section'        => 'title_tagline',
					'priority'       => 1,
					'title'          => __( 'Header Background', 'kanga' ),
					'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
				),

				/**
				 * Notice for Colors - Transparent header enabled on page.
				 */
				array(
					'name'            => KANGA_THEME_SETTINGS . '[header-transparent-header-logo-notice]',
					'type'            => 'control',
					'control'         => 'ast-description',
					'section'         => 'title_tagline',
					'priority'        => 1,
					'required'        => array(
						'conditions' => array(
							array( KANGA_THEME_SETTINGS . '[different-transparent-logo]', '==', true ),
						),
					),
					'active_callback' => array( $this, 'is_transparent_header_enabled' ),
					'help'            => $this->get_help_text_notice( 'transparent-header' ),
				),

				/**
				* Option: Transparent Header Section - Link.
				*/
				array(
					'name'            => KANGA_THEME_SETTINGS . '[header-transparent-header-logo-notice-link]',
					'default'         => kanga_get_option( 'header-transparent-header-logo-notice-link' ),
					'type'            => 'control',
					'control'         => 'ast-customizer-link',
					'section'         => 'title_tagline',
					'priority'        => 1,
					'link_type'       => 'control',
					'linked'          => KANGA_THEME_SETTINGS . '[transparent-header-logo]',
					'required'        => array(
						'conditions' => array(
							array( KANGA_THEME_SETTINGS . '[different-transparent-logo]', '==', true ),
						),
					),
					'link_text'       => '<u>' . __( 'Customize Transparent Header.', 'kanga' ) . '</u>',
					'active_callback' => array( $this, 'is_transparent_header_enabled' ),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[divider-section-site-identity-logo]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => 'title_tagline',
					'title'    => __( 'Site Logo', 'kanga' ),
					'priority' => 2,
					'settings' => array(),
				),

				/**
				 * Option: Different retina logo
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[different-retina-logo]',
					'type'     => 'control',
					'control'  => 'checkbox',
					'section'  => 'title_tagline',
					'title'    => __( 'Different Logo For Retina Devices?', 'kanga' ),
					'default'  => false,
					'priority' => 5,
				),
				
				/**
				 * Option: Retina logo selector
				 */
				array(
					'name'           => KANGA_THEME_SETTINGS . '[ast-header-retina-logo]',
					'default'        => kanga_get_option( 'ast-header-retina-logo' ),
					'type'           => 'control',
					'control'        => 'image',
					'section'        => 'title_tagline',
					'required'       => array( KANGA_THEME_SETTINGS . '[different-retina-logo]', '!=', 0 ),
					'priority'       => 5,
					'title'          => __( 'Retina Logo', 'kanga' ),
					'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
				),

				/**
				 * Option: Inherit Desktop logo
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[different-mobile-logo]',
					'type'     => 'control',
					'control'  => 'checkbox',
					'default'  => false,
					'section'  => 'title_tagline',
					'title'    => __( 'Different Logo For Mobile Devices?', 'kanga' ),
					'priority' => 5,
				),

				/**
				 * Option: Mobile header logo
				 */
				array(
					'name'           => KANGA_THEME_SETTINGS . '[mobile-header-logo]',
					'default'        => kanga_get_option( 'mobile-header-logo' ),
					'type'           => 'control',
					'control'        => 'image',
					'required'       => array( KANGA_THEME_SETTINGS . '[different-mobile-logo]', '==', '1' ),
					'section'        => 'title_tagline',
					'priority'       => 5,
					'title'          => __( 'Mobile Logo (optional)', 'kanga' ),
					'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
				),

				/**
				 * Option: Logo Width
				 */
				array(
					'name'        => KANGA_THEME_SETTINGS . '[ast-header-responsive-logo-width]',
					'type'        => 'control',
					'control'     => 'ast-responsive-slider',
					'section'     => 'title_tagline',
					'transport'   => 'postMessage',
					'default'     => array(
						'desktop' => '',
						'tablet'  => '',
						'mobile'  => '',
					),
					'priority'    => 5,
					'title'       => __( 'Logo Width', 'kanga' ),
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 600,
					),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[ast-site-logo-divider]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'title'    => __( 'Site Icon', 'kanga' ),
					'section'  => 'title_tagline',
					'priority' => 5,
					'settings' => array(),
				),

				/**
				 * Option: Display Title
				 */
				array(
					'name'      => KANGA_THEME_SETTINGS . '[display-site-title]',
					'type'      => 'control',
					'control'   => 'checkbox',
					'default'   => kanga_get_option( 'display-site-title' ),
					'section'   => 'title_tagline',
					'title'     => __( 'Display Site Title', 'kanga' ),
					'priority'  => 7,
					'transport' => 'postMessage',
					'partial'   => array(
						'selector'            => '.main-header-bar .site-branding .ast-site-title-wrap',
						'container_inclusive' => false,
						'render_callback'     => array( 'Kanga_Customizer_Partials', 'render_header_site_title_tagline' ),
					),
				),

				/**
				 * Option: Display Tagline
				 */
				array(
					'name'      => KANGA_THEME_SETTINGS . '[display-site-tagline]',
					'type'      => 'control',
					'control'   => 'checkbox',
					'transport' => 'postMessage',
					'default'   => kanga_get_option( 'display-site-tagline' ),
					'section'   => 'title_tagline',
					'title'     => __( 'Display Site Tagline', 'kanga' ),
					'partial'   => array(
						'selector'            => '.main-header-bar .site-branding .ast-site-title-wrap',
						'container_inclusive' => false,
						'render_callback'     => array( 'Kanga_Customizer_Partials', 'render_header_site_title_tagline' ),
					),
				),

				array(
					'name'     => KANGA_THEME_SETTINGS . '[logo-title-inline]',
					'default'  => kanga_get_option( 'logo-title-inline' ),
					'type'     => 'control',
					'required' => array(
						'conditions' => array(
							array( KANGA_THEME_SETTINGS . '[display-site-title]', '==', true ),
							array( KANGA_THEME_SETTINGS . '[display-site-tagline]', '==', true ),
						),
						'operator'   => 'OR',
					),
					'control'  => 'checkbox',
					'section'  => 'title_tagline',
					'title'    => __( 'Inline Logo & Site Title', 'kanga' ),
					'priority' => 7,
				),

				/**
				 * Option: Divider
				*/
				array(
					'name'     => KANGA_THEME_SETTINGS . '[ast-site-icon-divider]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'title'    => __( 'Site Title', 'kanga' ),
					'section'  => 'title_tagline',
					'priority' => 6,
					'settings' => array(),
				),
				array(
					'name'      => KANGA_THEME_SETTINGS . '[site-title-typography]',
					'default'   => kanga_get_option( 'site-title-typography' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Typography', 'kanga' ),
					'section'   => 'title_tagline',
					'transport' => 'postMessage',
					'priority'  => 9,
					'required'  => array(
						KANGA_THEME_SETTINGS . '[display-site-title]',
						'==',
						true,
					),
				),
				/**
				 * Option: Divider
				 */
				array(
					'name'     => KANGA_THEME_SETTINGS . '[ast-site-title-divider]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => 'title_tagline',
					'title'    => __( 'Site Tagline', 'kanga' ),
					'priority' => 9,
					'settings' => array(),
				),
				array(
					'name'      => KANGA_THEME_SETTINGS . '[site-tagline-typography]',
					'default'   => kanga_get_option( 'site-tagline-typography' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Typography', 'kanga' ),
					'section'   => 'title_tagline',
					'transport' => 'postMessage',
					'priority'  => 16,
					'required'  => array(
						KANGA_THEME_SETTINGS . '[display-site-tagline]',
						'==',
						true,
					),
				),
			);

			$configurations = array_merge( $configurations, $_configs );
			return $configurations;

		}

		/**
		 * Check if transparent header is enabled on the page being previewed.
		 *
		 * @since  2.4.5
		 * @return boolean True - If Transparent Header is enabled, False if not.
		 */
		public function is_transparent_header_enabled() {
			$status = Kanga_Ext_Transparent_Header_Markup::get_instance()->is_transparent_header();
			return ( true === $status ? true : false );
		}

		/**
		 * Help notice message to be displayed when the page that is being previewed has Logo set from Transparent Header.
		 *
		 * @since  2.4.5
		 * @param String $context Type of notice message to be returned.
		 * @return String HTML Markup for the help notice.
		 */
		private function get_help_text_notice( $context ) {

			$notice = '';
			if ( 'transparent-header' === $context ) {
				$notice = '<div class="ast-customizer-notice wp-ui-highlight"><p>The Logo on this page is set from the Transparent Header Section. Please click the link below to customize Transparent Header Logo.</p></div>';
			}
			return $notice;
		}
		
	}
}


new Kanga_Site_Identity_Configs();





