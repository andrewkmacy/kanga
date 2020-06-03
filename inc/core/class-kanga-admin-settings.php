<?php
/**
 * Admin settings helper
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Kanga
 * @author      Kanga
 * @copyright   Copyright (c) 2020, Kanga
 * @link        https://wpkanga.com/
 * @since       Kanga 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kanga_Admin_Settings' ) ) {

	/**
	 * Kanga Admin Settings
	 */
	class Kanga_Admin_Settings {

		/**
		 * Menu page title
		 *
		 * @since 1.0
		 * @var array $menu_page_title
		 */
		public static $menu_page_title = 'Kanga Theme';

		/**
		 * Page title
		 *
		 * @since 1.0
		 * @var array $page_title
		 */
		public static $page_title = 'Kanga';

		/**
		 * Plugin slug
		 *
		 * @since 1.0
		 * @var array $plugin_slug
		 */
		public static $plugin_slug = 'kanga';

		/**
		 * Default Menu position
		 *
		 * @since 1.0
		 * @var array $default_menu_position
		 */
		public static $default_menu_position = 'themes.php';

		/**
		 * Parent Page Slug
		 *
		 * @since 1.0
		 * @var array $parent_page_slug
		 */
		public static $parent_page_slug = 'general';

		/**
		 * Current Slug
		 *
		 * @since 1.0
		 * @var array $current_slug
		 */
		public static $current_slug = 'general';

		/**
		 * Starter Templates Slug
		 *
		 * @since 2.3.2
		 * @var array $starter_templates_slug
		 */
		public static $starter_templates_slug = 'kanga-sites';

		/**
		 * Constructor
		 */
		public function __construct() {

			if ( ! is_admin() ) {
				return;
			}

			self::get_starter_templates_slug();

			add_action( 'after_setup_theme', __CLASS__ . '::init_admin_settings', 99 );
		}

		/**
		 * Admin settings init
		 */
		public static function init_admin_settings() {
			self::$menu_page_title = apply_filters( 'kanga_menu_page_title', __( 'Kanga Options', 'kanga' ) );
			self::$page_title      = apply_filters( 'kanga_page_title', __( 'Kanga', 'kanga' ) );
			self::$plugin_slug     = self::get_theme_page_slug();

			add_action( 'admin_enqueue_scripts', __CLASS__ . '::register_scripts' );

			if ( isset( $_REQUEST['page'] ) && strpos( $_REQUEST['page'], self::$plugin_slug ) !== false ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended

				add_action( 'admin_enqueue_scripts', __CLASS__ . '::styles_scripts' );

				// Let extensions hook into saving.
				do_action( 'kanga_admin_settings_scripts' );

				if ( defined( 'KANGA_EXT_VER' ) && version_compare( KANGA_EXT_VER, '2.5.0', '<' ) ) {
					self::save_settings();
				}
			}

			add_action( 'customize_controls_enqueue_scripts', __CLASS__ . '::customizer_scripts' );

			add_action( 'admin_menu', __CLASS__ . '::add_admin_menu', 99 );

			add_action( 'kanga_menu_general_action', __CLASS__ . '::general_page' );

			add_action( 'kanga_header_right_section', __CLASS__ . '::top_header_right_section' );

			add_action( 'kanga_welcome_page_right_sidebar_content', __CLASS__ . '::kanga_welcome_page_starter_sites_section', 10 );
			add_action( 'kanga_welcome_page_right_sidebar_content', __CLASS__ . '::kanga_welcome_page_knowledge_base_scetion', 11 );
			add_action( 'kanga_welcome_page_right_sidebar_content', __CLASS__ . '::kanga_welcome_page_community_scetion', 12 );
			add_action( 'kanga_welcome_page_right_sidebar_content', __CLASS__ . '::kanga_welcome_page_five_star_scetion', 13 );

			add_action( 'kanga_welcome_page_content', __CLASS__ . '::kanga_welcome_page_content' );
			add_action( 'kanga_welcome_page_content', __class__ . '::kanga_available_plugins', 30 );

			// AJAX.
			add_action( 'wp_ajax_kanga-sites-plugin-activate', __CLASS__ . '::required_plugin_activate' );
			add_action( 'wp_ajax_kanga-sites-plugin-deactivate', __CLASS__ . '::required_plugin_deactivate' );

			add_action( 'admin_notices', __CLASS__ . '::register_notices' );
			add_action( 'kanga_notice_before_markup', __CLASS__ . '::notice_assets' );

			add_action( 'admin_notices', __CLASS__ . '::minimum_addon_version_notice' );
		}

		/**
		 * Save All admin settings here
		 */
		public static function save_settings() {

			// Only admins can save settings.
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			// Let extensions hook into saving.
			do_action( 'kanga_admin_settings_save' );
		}

		/**
		 * Theme options page Slug getter including White Label string.
		 *
		 * @since 2.1.0
		 * @return string Theme Options Page Slug.
		 */
		public static function get_theme_page_slug() {
			return apply_filters( 'kanga_theme_page_slug', self::$plugin_slug );
		}

		/**
		 * Ask Theme Rating
		 *
		 * @since 1.4.0
		 */
		public static function register_notices() {

			if ( class_exists( 'Kanga_Ext_White_Label_Markup' ) ) {
				if ( ! empty( Kanga_Ext_White_Label_Markup::$branding['kanga']['name'] ) ) {
					return;
				}
			}

			if ( false === get_option( 'kanga-theme-old-setup' ) ) {
				set_transient( 'kanga-theme-first-rating', true, MONTH_IN_SECONDS );
				update_option( 'kanga-theme-old-setup', true );
			} elseif ( false === get_transient( 'kanga-theme-first-rating' ) && current_user_can( 'install_plugins' ) ) {
				$image_path = KANGA_THEME_URI . 'inc/assets/images/kanga-logo.svg';
				Kanga_Notices::add_notice(
					array(
						'id'                         => 'kanga-theme-rating',
						'type'                       => '',
						'message'                    => sprintf(
							'<div class="notice-image">
								<img src="%1$s" class="custom-logo" alt="Kanga" itemprop="logo"></div> 
								<div class="notice-content">
									<div class="notice-heading">
										%2$s
									</div>
									%3$s<br />
									<div class="kanga-review-notice-container">
										<a href="%4$s" class="kanga-notice-close kanga-review-notice button-primary" target="_blank">
										%5$s
										</a>
									<span class="dashicons dashicons-calendar"></span>
										<a href="#" data-repeat-notice-after="%6$s" class="kanga-notice-close kanga-review-notice">
										%7$s
										</a>
									<span class="dashicons dashicons-smiley"></span>
										<a href="#" class="kanga-notice-close kanga-review-notice">
										%8$s
										</a>
									</div>
								</div>',
							$image_path,
							__( 'Hello! Seems like you have used Kanga theme to build this website &mdash; Thanks a ton!', 'kanga' ),
							__( 'Could you please do us a BIG favor and give it a 5-star rating on WordPress? This would boost our motivation and help other users make a comfortable decision while choosing the Kanga theme.', 'kanga' ),
							'https://wordpress.org/support/theme/kanga/reviews/?filter=5#new-post',
							__( 'Ok, you deserve it', 'kanga' ),
							MONTH_IN_SECONDS,
							__( 'Nope, maybe later', 'kanga' ),
							__( 'I already did', 'kanga' )
						),
						'repeat-notice-after'        => MONTH_IN_SECONDS,
						'priority'                   => 10,
						'display-with-other-notices' => false,
						'show_if'                    => class_exists( 'Kanga_Ext_White_Label_Markup' ) ? Kanga_Ext_White_Label_Markup::show_branding() : true,
					)
				);
			}

			// Force Kanga welcome notice on theme activation.
			if ( current_user_can( 'install_plugins' ) && ! defined( 'KANGA_SITES_NAME' ) && '1' == get_option( 'fresh_site' ) ) {

				wp_enqueue_script( 'kanga-admin-settings' );
				$image_path           = KANGA_THEME_URI . 'inc/assets/images/kanga-logo.svg';
				$ast_sites_notice_btn = self::kanga_sites_notice_button();

				if ( file_exists( WP_PLUGIN_DIR . '/kanga-sites/kanga-sites.php' ) && is_plugin_inactive( 'kanga-sites/kanga-sites.php' ) && is_plugin_inactive( 'kanga-pro-sites/kanga-pro-sites.php' ) ) {
					$ast_sites_notice_btn['button_text'] = __( 'Get Started', 'kanga' );
					$ast_sites_notice_btn['class']      .= ' button button-primary button-hero';
				} elseif ( ! file_exists( WP_PLUGIN_DIR . '/kanga-sites/kanga-sites.php' ) && is_plugin_inactive( 'kanga-pro-sites/kanga-pro-sites.php' ) ) {
					$ast_sites_notice_btn['button_text'] = __( 'Get Started', 'kanga' );
					$ast_sites_notice_btn['class']      .= ' button button-primary button-hero';
					// Kanga Premium Sites - Active.
				} elseif ( is_plugin_active( 'kanga-pro-sites/kanga-pro-sites.php' ) ) {
					$ast_sites_notice_btn['class'] = ' button button-primary button-hero kanga-notice-close';
				} else {
					$ast_sites_notice_btn['class'] = ' button button-primary button-hero kanga-notice-close';
				}

				$kanga_sites_notice_args = array(
					'id'                         => 'kanga-sites-on-active',
					'type'                       => 'info',
					'message'                    => sprintf(
						'<div class="notice-image">
							<img src="%1$s" class="custom-logo" alt="Kanga" itemprop="logo"></div> 
							<div class="notice-content">
								<h2 class="notice-heading">
									%2$s
								</h2>
								<p>%3$s</p>
								<div class="kanga-review-notice-container">
									<a class="%4$s" %5$s %6$s %7$s %8$s %9$s %10$s> %11$s </a>
								</div>
							</div>',
						$image_path,
						__( 'Thank you for installing Kanga!', 'kanga' ),
						__( 'Did you know Kanga comes with dozens of ready-to-use <a href="https://wpkanga.com/ready-websites/?utm_source=install-notice">starter templates</a>? Install the Starter Templates plugin to get started.', 'kanga' ),
						esc_attr( $ast_sites_notice_btn['class'] ),
						'href="' . kanga_get_prop( $ast_sites_notice_btn, 'link', '' ) . '"',
						'data-slug="' . kanga_get_prop( $ast_sites_notice_btn, 'data_slug', '' ) . '"',
						'data-init="' . kanga_get_prop( $ast_sites_notice_btn, 'data_init', '' ) . '"',
						'data-settings-link-text="' . kanga_get_prop( $ast_sites_notice_btn, 'data_settings_link_text', '' ) . '"',
						'data-settings-link="' . kanga_get_prop( $ast_sites_notice_btn, 'data_settings_link', '' ) . '"',
						'data-activating-text="' . kanga_get_prop( $ast_sites_notice_btn, 'activating_text', '' ) . '"',
						esc_html( $ast_sites_notice_btn['button_text'] )
					),
					'priority'                   => 5,
					'display-with-other-notices' => false,
					'show_if'                    => class_exists( 'Kanga_Ext_White_Label_Markup' ) ? Kanga_Ext_White_Label_Markup::show_branding() : true,
				);

				Kanga_Notices::add_notice(
					$kanga_sites_notice_args
				);
			}
		}

		/**
		 * Display notice for minimun version for Kanga addon.
		 *
		 * @since 2.0.0
		 */
		public static function minimum_addon_version_notice() {

			if ( ! defined( 'KANGA_EXT_VER' ) ) {
				return;
			}

			if ( version_compare( KANGA_EXT_VER, KANGA_EXT_MIN_VER ) < 0 ) {

				$message = sprintf(
					/* translators: %1$1s: Theme Name, %2$2s: Minimum Required version of the addon */
					__( 'Please update the %1$1s to version %2$2s or higher. Ignore if already updated.', 'kanga' ),
					kanga_get_addon_name(),
					KANGA_EXT_MIN_VER
				);

				$min_version = get_user_meta( get_current_user_id(), 'ast-minimum-addon-version-notice-min-ver', true );

				if ( ! $min_version ) {
					update_user_meta( get_current_user_id(), 'ast-minimum-addon-version-notice-min-ver', KANGA_EXT_MIN_VER );
				}

				if ( version_compare( $min_version, KANGA_EXT_MIN_VER, '!=' ) ) {
					delete_user_meta( get_current_user_id(), 'ast-minimum-addon-version-notice' );
					update_user_meta( get_current_user_id(), 'ast-minimum-addon-version-notice-min-ver', KANGA_EXT_MIN_VER );
				}

				$notice_args = array(
					'id'                         => 'ast-minimum-addon-version-notice',
					'type'                       => 'warning',
					'message'                    => $message,
					'show_if'                    => true,
					'repeat-notice-after'        => false,
					'priority'                   => 18,
					'display-with-other-notices' => true,
				);

				Kanga_Notices::add_notice( $notice_args );
			}
		}

		/**
		 * Enqueue Kanga Notices CSS.
		 *
		 * @since 2.0.0
		 *
		 * @return void
		 */
		public static function notice_assets() {
			if ( is_rtl() ) {
				wp_enqueue_style( 'kanga-notices-rtl', KANGA_THEME_URI . 'inc/assets/css/kanga-notices-rtl.css', array(), KANGA_THEME_VERSION );
			} else {
				wp_enqueue_style( 'kanga-notices', KANGA_THEME_URI . 'inc/assets/css/kanga-notices.css', array(), KANGA_THEME_VERSION );
			}
		}

		/**
		 * Render button for Kanga Site notices
		 *
		 * @since 1.6.5
		 * @return array $ast_sites_notice_btn Rendered button
		 */
		public static function kanga_sites_notice_button() {
			$ast_sites_notice_btn = array();
			// Kanga Sites - Installed but Inactive.
			// Kanga Premium Sites - Inactive.
			if ( file_exists( WP_PLUGIN_DIR . '/kanga-sites/kanga-sites.php' ) && is_plugin_inactive( 'kanga-sites/kanga-sites.php' ) && is_plugin_inactive( 'kanga-pro-sites/kanga-pro-sites.php' ) ) {
				$ast_sites_notice_btn['class']                   = 'kanga-activate-recommended-plugin';
				$ast_sites_notice_btn['button_text']             = __( 'Activate Importer Plugin', 'kanga' );
				$ast_sites_notice_btn['data_slug']               = 'kanga-sites';
				$ast_sites_notice_btn['data_init']               = '/kanga-sites/kanga-sites.php';
				$ast_sites_notice_btn['data_settings_link']      = admin_url( 'themes.php?page=' . self::$starter_templates_slug );
				$ast_sites_notice_btn['data_settings_link_text'] = __( 'See Library &#187;', 'kanga' );
				$ast_sites_notice_btn['activating_text']         = __( 'Activating Importer Plugin ', 'kanga' ) . '&hellip;';

				// Kanga Sites - Not Installed.
				// Kanga Premium Sites - Inactive.
			} elseif ( ! file_exists( WP_PLUGIN_DIR . '/kanga-sites/kanga-sites.php' ) && is_plugin_inactive( 'kanga-pro-sites/kanga-pro-sites.php' ) ) {
				$ast_sites_notice_btn['class']                   = 'kanga-install-recommended-plugin';
				$ast_sites_notice_btn['button_text']             = __( 'Install Importer Plugin', 'kanga' );
				$ast_sites_notice_btn['data_slug']               = 'kanga-sites';
				$ast_sites_notice_btn['data_init']               = '/kanga-sites/kanga-sites.php';
				$ast_sites_notice_btn['data_settings_link']      = admin_url( 'themes.php?page=' . self::$starter_templates_slug );
				$ast_sites_notice_btn['data_settings_link_text'] = __( 'See Library &#187;', 'kanga' );
				$ast_sites_notice_btn['detail_link_class']       = 'plugin-detail thickbox open-plugin-details-modal kanga-starter-sites-detail-link';
				$ast_sites_notice_btn['detail_link']             = network_admin_url( 'plugin-install.php?tab=plugin-information&plugin=kanga-sites&TB_iframe=true&width=772&height=400' );
				$ast_sites_notice_btn['detail_link_text']        = __( 'Details &#187;', 'kanga' );
			} else {
				$ast_sites_notice_btn['class']       = 'active';
				$ast_sites_notice_btn['button_text'] = __( 'See Library &#187;', 'kanga' );
				$ast_sites_notice_btn['link']        = admin_url( 'themes.php?page=' . self::$starter_templates_slug );
			}
			return $ast_sites_notice_btn;
		}

		/**
		 * Check if installed Starter Sites plugin is new.
		 *
		 * @since 2.3.2
		 */
		public static function get_starter_templates_slug() {

			if ( defined( 'KANGA_PRO_SITES_VER' ) && version_compare( KANGA_PRO_SITES_VER, '2.0.0', '>=' ) ) {
				self::$starter_templates_slug = 'starter-templates';
			}

			if ( defined( 'KANGA_SITES_VER' ) && version_compare( KANGA_SITES_VER, '2.0.0', '>=' ) ) {
				self::$starter_templates_slug = 'starter-templates';
			}
		}

		/**
		 * Load the scripts and styles in the customizer controls.
		 *
		 * @since 1.2.1
		 */
		public static function customizer_scripts() {
			$color_palettes = wp_json_encode( kanga_color_palette() );
			wp_add_inline_script( 'wp-color-picker', 'jQuery.wp.wpColorPicker.prototype.options.palettes = ' . $color_palettes . ';' );
		}

		/**
		 * Register admin scripts.
		 *
		 * @param String $hook Screen name where the hook is fired.
		 * @return void
		 */
		public static function register_scripts( $hook ) {
			$js_prefix  = '.min.js';
			$css_prefix = '.min.css';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$js_prefix  = '.js';
				$css_prefix = '.css';
				$dir        = 'unminified';
			}

			if ( is_rtl() ) {
				$css_prefix = '-rtl.min.css';
				if ( SCRIPT_DEBUG ) {
					$css_prefix = '-rtl.css';
				}
			}

			/**
			 * Filters the Admin JavaScript handles added
			 *
			 * @since v1.4.10
			 *
			 * @param array array of the javascript handles.
			 */
			$js_handle = apply_filters( 'kanga_admin_script_handles', array( 'jquery', 'wp-color-picker' ) );

			// Add customize-base handle only for the Customizer Preview Screen.
			if ( true === is_customize_preview() ) {
				$js_handle[] = 'customize-base';
			}

			wp_register_script( 'kanga-color-alpha', KANGA_THEME_URI . 'assets/js/' . $dir . '/wp-color-picker-alpha' . $js_prefix, $js_handle, KANGA_THEME_VERSION, true );

			if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
				$post_types = get_post_types( array( 'public' => true ) );
				$screen     = get_current_screen();
				$post_type  = $screen->id;

				if ( in_array( $post_type, (array) $post_types ) ) {
					echo '<style class="kanga-meta-box-style">
						.block-editor-page #side-sortables #kanga_settings_meta_box select { min-width: 84%; padding: 3px 24px 3px 8px; height: 20px; }
						.block-editor-page #normal-sortables #kanga_settings_meta_box select { min-width: 200px; }
						.block-editor-page .edit-post-meta-boxes-area #poststuff #kanga_settings_meta_box h2.hndle { border-bottom: 0; }
						.block-editor-page #kanga_settings_meta_box .components-base-control__field, .block-editor-page #kanga_settings_meta_box .block-editor-page .transparent-header-wrapper, .block-editor-page #kanga_settings_meta_box .adv-header-wrapper, .block-editor-page #kanga_settings_meta_box .stick-header-wrapper, .block-editor-page #kanga_settings_meta_box .disable-section-meta div { margin-bottom: 8px; }
						.block-editor-page #kanga_settings_meta_box .disable-section-meta div label { vertical-align: inherit; }
						.block-editor-page #kanga_settings_meta_box .post-attributes-label-wrapper { margin-bottom: 4px; }
						#side-sortables #kanga_settings_meta_box select { min-width: 100%; }
						#normal-sortables #kanga_settings_meta_box select { min-width: 200px; }
					</style>';
				}
			}
			/* Add CSS for the Submenu for BSF plugins added in Appearance Menu */

			if ( ! is_customize_preview() ) {
				echo '<style class="kanga-menu-appearance-style">
					#menu-appearance a[href^="edit.php?post_type=kanga-"]:before,
					#menu-appearance a[href^="themes.php?page=kanga-"]:before,
					#menu-appearance a[href^="edit.php?post_type=kanga_"]:before,
					#menu-appearance a[href^="edit-tags.php?taxonomy=bsf_custom_fonts"]:before,
					#menu-appearance a[href^="themes.php?page=custom-typekit-fonts"]:before,
					#menu-appearance a[href^="edit.php?post_type=bsf-sidebar"]:before {
					    content: "\21B3";
					    margin-right: 0.5em;
					    opacity: 0.5;
					}
				</style>';

				if ( ! current_user_can( 'manage_options' ) ) {
					return;
				}

				wp_register_script( 'kanga-admin-settings', KANGA_THEME_URI . 'inc/assets/js/kanga-admin-menu-settings.js', array( 'jquery', 'wp-util', 'updates' ), KANGA_THEME_VERSION, false );

				$localize = array(
					'ajaxUrl'                            => admin_url( 'admin-ajax.php' ),
					'btnActivating'                      => __( 'Activating Importer Plugin ', 'kanga' ) . '&hellip;',
					'kangaSitesLink'                     => admin_url( 'themes.php?page=' ),
					'kangaSitesLinkTitle'                => __( 'See Library &#187;', 'kanga' ),
					'recommendedPluiginActivatingText'   => __( 'Activating', 'kanga' ) . '&hellip;',
					'recommendedPluiginDeactivatingText' => __( 'Deactivating', 'kanga' ) . '&hellip;',
					'recommendedPluiginActivateText'     => __( 'Activate', 'kanga' ),
					'recommendedPluiginDeactivateText'   => __( 'Deactivate', 'kanga' ),
					'recommendedPluiginSettingsText'     => __( 'Settings', 'kanga' ),
					'kangaPluginManagerNonce'            => wp_create_nonce( 'kanga-recommended-plugin-nonce' ),
				);

				wp_localize_script( 'kanga-admin-settings', 'kanga', apply_filters( 'kanga_theme_js_localize', $localize ) );
			}
		}

		/**
		 * Enqueues the needed CSS/JS for the builder's admin settings page.
		 *
		 * @since 1.0
		 */
		public static function styles_scripts() {

			// Styles.
			if ( is_rtl() ) {
				wp_enqueue_style( 'kanga-admin-settings-rtl', KANGA_THEME_URI . 'inc/assets/css/kanga-admin-menu-settings-rtl.css', array(), KANGA_THEME_VERSION );
			} else {
				wp_enqueue_style( 'kanga-admin-settings', KANGA_THEME_URI . 'inc/assets/css/kanga-admin-menu-settings.css', array(), KANGA_THEME_VERSION );
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			wp_register_script( 'kanga-admin-settings', KANGA_THEME_URI . 'inc/assets/js/kanga-admin-menu-settings.js', array( 'jquery', 'wp-util', 'updates' ), KANGA_THEME_VERSION, false );

			$localize = array(
				'ajaxUrl'                            => admin_url( 'admin-ajax.php' ),
				'btnActivating'                      => __( 'Activating Importer Plugin ', 'kanga' ) . '&hellip;',
				'kangaSitesLink'                     => admin_url( 'themes.php?page=' ),
				'kangaSitesLinkTitle'                => __( 'See Library &#187;', 'kanga' ),
				'recommendedPluiginActivatingText'   => __( 'Activating', 'kanga' ) . '&hellip;',
				'recommendedPluiginDeactivatingText' => __( 'Deactivating', 'kanga' ) . '&hellip;',
				'recommendedPluiginActivateText'     => __( 'Activate', 'kanga' ),
				'recommendedPluiginDeactivateText'   => __( 'Deactivate', 'kanga' ),
				'recommendedPluiginSettingsText'     => __( 'Settings', 'kanga' ),
				'kangaPluginManagerNonce'            => wp_create_nonce( 'kanga-recommended-plugin-nonce' ),
			);
			wp_localize_script( 'kanga-admin-settings', 'kanga', apply_filters( 'kanga_theme_js_localize', $localize ) );

			// Script.
			wp_enqueue_script( 'kanga-admin-settings' );

			if ( ! file_exists( WP_PLUGIN_DIR . '/kanga-sites/kanga-sites.php' ) && is_plugin_inactive( 'kanga-pro-sites/kanga-pro-sites.php' ) ) {
				// For starter site plugin popup detail "Details &#187;" on Kanga Options page.
				wp_enqueue_script( 'plugin-install' );
				wp_enqueue_script( 'thickbox' );
				wp_enqueue_style( 'thickbox' );
			}
		}


		/**
		 * Get and return page URL
		 *
		 * @param string $menu_slug Menu name.
		 * @since 1.0
		 * @return  string page url
		 */
		public static function get_page_url( $menu_slug ) {

			$parent_page = self::$default_menu_position;

			if ( strpos( $parent_page, '?' ) !== false ) {
				$query_var = '&page=' . self::$plugin_slug;
			} else {
				$query_var = '?page=' . self::$plugin_slug;
			}

			$parent_page_url = admin_url( $parent_page . $query_var );

			$url = $parent_page_url . '&action=' . $menu_slug;

			return esc_url( $url );
		}

		/**
		 * Add main menu
		 *
		 * @since 1.0
		 */
		public static function add_admin_menu() {

			$parent_page    = self::$default_menu_position;
			$page_title     = self::$menu_page_title;
			$capability     = 'manage_options';
			$page_menu_slug = self::$plugin_slug;
			$page_menu_func = __CLASS__ . '::menu_callback';

			if ( apply_filters( 'kanga_dashboard_admin_menu', true ) ) {
				add_theme_page( $page_title, $page_title, $capability, $page_menu_slug, $page_menu_func );
			} else {
				do_action( 'asta_register_admin_menu', $parent_page, $page_title, $capability, $page_menu_slug, $page_menu_func );
			}
		}

		/**
		 * Menu callback
		 *
		 * @since 1.0
		 */
		public static function menu_callback() {

			$current_slug = isset( $_GET['action'] ) ? esc_attr( $_GET['action'] ) : self::$current_slug; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

			$active_tab   = str_replace( '_', '-', $current_slug );
			$current_slug = str_replace( '-', '_', $current_slug );

			$ast_icon           = apply_filters( 'kanga_page_top_icon', true );
			$ast_visit_site_url = apply_filters( 'kanga_site_url', 'https://wpkanga.com' );
			$ast_wrapper_class  = apply_filters( 'kanga_welcome_wrapper_class', array( $current_slug ) );

			?>
			<div class="ast-menu-page-wrapper wrap ast-clear <?php echo esc_attr( implode( ' ', $ast_wrapper_class ) ); ?>">
					<div class="ast-theme-page-header">
						<div class="ast-container ast-flex">
							<div class="ast-theme-title">
								<a href="<?php echo esc_url( $ast_visit_site_url ); ?>" target="_blank" rel="noopener" >
								<?php if ( $ast_icon ) { ?>
									<img src="<?php echo esc_url( KANGA_THEME_URI . 'inc/assets/images/kanga.svg' ); ?>" class="ast-theme-icon" alt="<?php echo esc_attr( self::$page_title ); ?> " >
									<span class="kanga-theme-version"><?php echo esc_html( KANGA_THEME_VERSION ); ?></span>
								<?php } ?>
								<?php do_action( 'kanga_welcome_page_header_title' ); ?>
								</a>
							</div>

							<?php do_action( 'kanga_header_right_section' ); ?>

						</div>
					</div>

				<?php do_action( 'kanga_menu_' . esc_attr( $current_slug ) . '_action' ); ?>
			</div>
			<?php
		}

		/**
		 * Include general page
		 *
		 * @since 1.0
		 */
		public static function general_page() {
			require_once KANGA_THEME_DIR . 'inc/core/view-general.php';
		}

		/**
		 * Include Welcome page right starter sites content
		 *
		 * @since 1.2.4
		 */
		public static function kanga_welcome_page_starter_sites_section() {

			if ( kanga_is_white_labelled() ) {
				return;
			}
			?>

			<div class="postbox">
				<h2 class="hndle ast-normal-cusror">
					<span class="dashicons dashicons-admin-customizer"></span>
					<span><?php echo esc_html( apply_filters( 'kanga_sites_menu_page_title', __( 'Import Starter Template', 'kanga' ) ) ); ?></span>
				</h2>
				<img class="ast-starter-sites-img" src="<?php echo esc_url( KANGA_THEME_URI . 'assets/images/kanga-starter-sites.jpg' ); ?>">
				<div class="inside">
					<p>
						<?php
							$kanga_starter_sites_doc_link      = apply_filters( 'kanga_starter_sites_documentation_link', kanga_get_pro_url( 'https://wpkanga.com/docs/installing-importing-kanga-sites', 'kanga-dashboard', 'how-kanga-sites-works', 'welcome-page' ) );
							$kanga_starter_sites_doc_link_text = apply_filters( 'kanga_starter_sites_doc_link_text', __( 'Starter Templates?', 'kanga' ) );
							printf(
								/* translators: %1$s: Starter site link. */
								esc_html__( 'Did you know %1$s offers a free library of %2$s ', 'kanga' ),
								self::$page_title,
								! empty( $kanga_starter_sites_doc_link ) ? '<a href=' . esc_url( $kanga_starter_sites_doc_link ) . ' target="_blank" rel="noopener">' . esc_html( $kanga_starter_sites_doc_link_text ) . '</a>' :
								esc_html( $kanga_starter_sites_doc_link_text )
							);
						?>
					</p>
					<p>
						<?php
							esc_html_e( 'Import your favorite site in one click and start your project with style!', 'kanga' );
						?>
					</p>
						<?php
						$ast_sites_notice_btn = self::kanga_sites_notice_button();

						printf(
							'<a class="%1$s" %2$s %3$s %4$s %5$s %6$s %7$s> %8$s </a>',
							esc_attr( $ast_sites_notice_btn['class'] ),
							'href="' . esc_url( kanga_get_prop( $ast_sites_notice_btn, 'link', '' ) ) . '"',
							'data-slug="' . esc_attr( kanga_get_prop( $ast_sites_notice_btn, 'data_slug', '' ) ) . '"',
							'data-init="' . esc_attr( kanga_get_prop( $ast_sites_notice_btn, 'data_init', '' ) ) . '"',
							'data-settings-link-text="' . esc_attr( kanga_get_prop( $ast_sites_notice_btn, 'data_settings_link_text', '' ) ) . '"',
							'data-settings-link="' . esc_attr( kanga_get_prop( $ast_sites_notice_btn, 'data_settings_link', '' ) ) . '"',
							'data-activating-text="' . esc_attr( kanga_get_prop( $ast_sites_notice_btn, 'activating_text', '' ) ) . '"',
							esc_html( $ast_sites_notice_btn['button_text'] )
						);
						printf(
							'<a class="%1$s" %2$s target="_blank" rel="noopener"> %3$s </a>',
							isset( $ast_sites_notice_btn['detail_link_class'] ) ? esc_attr( $ast_sites_notice_btn['detail_link_class'] ) : '',
							isset( $ast_sites_notice_btn['detail_link'] ) ? 'href="' . esc_url( $ast_sites_notice_btn['detail_link'] ) . '"' : '', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							isset( $ast_sites_notice_btn['detail_link_class'] ) ? esc_html( $ast_sites_notice_btn['detail_link_text'] ) : '' // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						);
						?>
					<div>
					</div>
				</div>
			</div>

			<?php
		}

		/**
		 * Include Welcome page right side knowledge base content
		 *
		 * @since 1.2.4
		 */
		public static function kanga_welcome_page_knowledge_base_scetion() {

			if ( kanga_is_white_labelled() ) {
				return;
			}

			?>

			<div class="postbox">
				<h2 class="hndle ast-normal-cusror">
					<span class="dashicons dashicons-book"></span>
					<span><?php esc_html_e( 'Knowledge Base', 'kanga' ); ?></span>
				</h2>
				<div class="inside">
					<p>
						<?php esc_html_e( 'Not sure how something works? Take a peek at the knowledge base and learn.', 'kanga' ); ?>
					</p>
					<?php
					$kanga_knowledge_base_doc_link      = apply_filters( 'kanga_knowledge_base_documentation_link', kanga_get_pro_url( 'https://wpkanga.com/docs/', 'kanga-dashboard', 'visit-documentation', 'welcome-page' ) );
					$kanga_knowledge_base_doc_link_text = apply_filters( 'kanga_knowledge_base_documentation_link_text', __( 'Visit Knowledge Base &#187;', 'kanga' ) );

					printf(
						/* translators: %1$s: Kanga Knowledge doc link. */
						'%1$s',
						! empty( $kanga_knowledge_base_doc_link ) ? '<a href=' . esc_url( $kanga_knowledge_base_doc_link ) . ' target="_blank" rel="noopener">' . esc_html( $kanga_knowledge_base_doc_link_text ) . '</a>' :
						esc_html( $kanga_knowledge_base_doc_link_text )
					);
					?>
				</div>
			</div>
			<?php
		}

		/**
		 * Include Welcome page right side Kanga community content
		 *
		 * @since 1.2.4
		 */
		public static function kanga_welcome_page_community_scetion() {

			if ( kanga_is_white_labelled() ) {
				return;
			}

			?>

			<div class="postbox">
				<h2 class="hndle ast-normal-cusror">
					<span class="dashicons dashicons-groups"></span>
					<span>
						<?php
						printf(
							/* translators: %1$s: Kanga Theme name. */
							esc_html__( '%1$s Community', 'kanga' ),
							esc_html( self::$page_title )
						);
						?>
				</h2>
				<div class="inside">
					<p>
						<?php
						printf(
							/* translators: %1$s: Kanga Theme name. */
							esc_html__( 'Join the community of super helpful %1$s users. Say hello, ask questions, give feedback and help each other!', 'kanga' ),
							esc_html( self::$page_title )
						);
						?>
					</p>
					<?php
					$kanga_community_group_link      = apply_filters( 'kanga_community_group_link', 'https://www.facebook.com/groups/wpkanga' );
					$kanga_community_group_link_text = apply_filters( 'kanga_community_group_link_text', __( 'Join Our Facebook Group &#187;', 'kanga' ) );

					printf(
						/* translators: %1$s: Kanga Knowledge doc link. */
						'%1$s',
						! empty( $kanga_community_group_link ) ? '<a href=' . esc_url( $kanga_community_group_link ) . ' target="_blank" rel="noopener">' . esc_html( $kanga_community_group_link_text ) . '</a>' :
						esc_html( $kanga_community_group_link_text )
					);
					?>
				</div>
			</div>
			<?php
		}

		/**
		 * Include Welcome page right side Five Star Support
		 *
		 * @since 1.2.4
		 */
		public static function kanga_welcome_page_five_star_scetion() {

			if ( kanga_is_white_labelled() ) {
				return;
			}

			?>

			<div class="postbox">
				<h2 class="hndle ast-normal-cusror">
					<span class="dashicons dashicons-sos"></span>
					<span><?php esc_html_e( 'Five Star Support', 'kanga' ); ?></span>
				</h2>
				<div class="inside">
					<p>
						<?php
						printf(
							/* translators: %1$s: Kanga Theme name. */
							esc_html__( 'Got a question? Get in touch with %1$s developers. We\'re happy to help!', 'kanga' ),
							esc_html( self::$page_title )
						);
						?>
					</p>
					<?php
						$kanga_support_link      = apply_filters( 'kanga_support_link', kanga_get_pro_url( 'https://wpkanga.com/contact/', 'kanga-dashboard', 'submit-a-ticket', 'welcome-page' ) );
						$kanga_support_link_text = apply_filters( 'kanga_support_link_text', __( 'Submit a Ticket &#187;', 'kanga' ) );

						printf(
							/* translators: %1$s: Kanga Knowledge doc link. */
							'%1$s',
							! empty( $kanga_support_link ) ? '<a href=' . esc_url( $kanga_support_link ) . ' target="_blank" rel="noopener">' . esc_html( $kanga_support_link_text ) . '</a>' :
							esc_html( $kanga_support_link_text )
						);
					?>
				</div>
			</div>
			<?php
		}

		/**
		 * Include Welcome page content
		 *
		 * @since 1.2.4
		 */
		public static function kanga_welcome_page_content() {

			$kanga_addon_tagline = apply_filters( 'kanga_addon_list_tagline', __( 'More Options Available with Kanga Pro!', 'kanga' ) );

			// Quick settings.
			$quick_settings = apply_filters(
				'kanga_quick_settings',
				array(
					'logo-favicon' => array(
						'title'     => __( 'Upload Logo', 'kanga' ),
						'dashicon'  => 'dashicons-format-image',
						'quick_url' => admin_url( 'customize.php?autofocus[control]=custom_logo' ),
					),
					'colors'       => array(
						'title'     => __( 'Set Colors', 'kanga' ),
						'dashicon'  => 'dashicons-admin-customizer',
						'quick_url' => admin_url( 'customize.php?autofocus[section]=section-colors-background' ),
					),
					'typography'   => array(
						'title'     => __( 'Customize Fonts', 'kanga' ),
						'dashicon'  => 'dashicons-editor-textcolor',
						'quick_url' => admin_url( 'customize.php?autofocus[section]=section-typography' ),
					),
					'layout'       => array(
						'title'     => __( 'Layout Options', 'kanga' ),
						'dashicon'  => 'dashicons-layout',
						'quick_url' => admin_url( 'customize.php?autofocus[section]=section-container-layout' ),
					),
					'header'       => array(
						'title'     => __( 'Header Options', 'kanga' ),
						'dashicon'  => 'dashicons-align-center',
						'quick_url' => admin_url( 'customize.php?autofocus[panel]=panel-header-group' ),
					),
					'blog-layout'  => array(
						'title'     => __( 'Blog Layouts', 'kanga' ),
						'dashicon'  => 'dashicons-welcome-write-blog',
						'quick_url' => admin_url( 'customize.php?autofocus[section]=section-blog-group' ),
					),
					'footer'       => array(
						'title'     => __( 'Footer Settings', 'kanga' ),
						'dashicon'  => 'dashicons-admin-generic',
						'quick_url' => admin_url( 'customize.php?autofocus[section]=section-footer-group' ),
					),
					'sidebars'     => array(
						'title'     => __( 'Sidebar Options', 'kanga' ),
						'dashicon'  => 'dashicons-align-left',
						'quick_url' => admin_url( 'customize.php?autofocus[section]=section-sidebars' ),
					),
				)
			);

			$extensions = apply_filters(
				'kanga_addon_list',
				array(
					'colors-and-background' => array(
						'title'     => __( 'Colors & Background', 'kanga' ),
						'class'     => 'ast-addon',
						'title_url' => kanga_get_pro_url( 'https://wpkanga.com/docs/colors-background-module/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
						'links'     => array(
							array(
								'link_class'   => 'ast-learn-more',
								'link_url'     => kanga_get_pro_url( 'https://wpkanga.com/docs/colors-background-module/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
								'link_text'    => __( 'Learn More &#187;', 'kanga' ),
								'target_blank' => true,
							),
						),
					),
					'typography'            => array(
						'title'     => __( 'Typography', 'kanga' ),
						'class'     => 'ast-addon',
						'title_url' => kanga_get_pro_url( 'https://wpkanga.com/docs/typography-module/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
						'links'     => array(
							array(
								'link_class'   => 'ast-learn-more',
								'link_url'     => kanga_get_pro_url( 'https://wpkanga.com/docs/typography-module/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
								'link_text'    => __( 'Learn More &#187;', 'kanga' ),
								'target_blank' => true,
							),
						),
					),
					'spacing'               => array(
						'title'     => __( 'Spacing', 'kanga' ),
						'class'     => 'ast-addon',
						'title_url' => kanga_get_pro_url( 'https://wpkanga.com/docs/spacing-addon-overview/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
						'links'     => array(
							array(
								'link_class'   => 'ast-learn-more',
								'link_url'     => kanga_get_pro_url( 'https://wpkanga.com/docs/spacing-addon-overview/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
								'link_text'    => __( 'Learn More &#187;', 'kanga' ),
								'target_blank' => true,
							),
						),
					),
					'blog-pro'              => array(
						'title'     => __( 'Blog Pro', 'kanga' ),
						'class'     => 'ast-addon',
						'title_url' => kanga_get_pro_url( 'https://wpkanga.com/docs/blog-pro-overview/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
						'links'     => array(
							array(
								'link_class'   => 'ast-learn-more',
								'link_url'     => kanga_get_pro_url( 'https://wpkanga.com/docs/blog-pro-overview/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
								'link_text'    => __( 'Learn More &#187;', 'kanga' ),
								'target_blank' => true,
							),
						),
					),
					'mobile-header'         => array(
						'title'     => __( 'Mobile Header', 'kanga' ),
						'class'     => 'ast-addon',
						'title_url' => kanga_get_pro_url( 'https://wpkanga.com/docs/mobile-header-with-kanga/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
						'links'     => array(
							array(
								'link_class'   => 'ast-learn-more',
								'link_url'     => kanga_get_pro_url( 'https://wpkanga.com/docs/mobile-header-with-kanga/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
								'link_text'    => __( 'Learn More &#187;', 'kanga' ),
								'target_blank' => true,
							),
						),
					),
					'header-sections'       => array(
						'title'     => __( 'Header Sections', 'kanga' ),
						'class'     => 'ast-addon',
						'title_url' => kanga_get_pro_url( 'https://wpkanga.com/docs/header-sections-pro/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
						'links'     => array(
							array(
								'link_class'   => 'ast-learn-more',
								'link_url'     => kanga_get_pro_url( 'https://wpkanga.com/docs/header-sections-pro/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
								'link_text'    => __( 'Learn More &#187;', 'kanga' ),
								'target_blank' => true,
							),
						),
					),
					'nav-menu'              => array(
						'title'     => __( 'Nav Menu', 'kanga' ),
						'class'     => 'ast-addon',
						'title_url' => kanga_get_pro_url( 'https://wpkanga.com/docs/nav-menu-addon/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
						'links'     => array(
							array(
								'link_class'   => 'ast-learn-more',
								'link_url'     => kanga_get_pro_url( 'https://wpkanga.com/docs/how-to-white-label-kanga/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
								'link_text'    => __( 'Learn More &#187;', 'kanga' ),
								'target_blank' => true,
							),
						),
					),
					'sticky-header'         => array(
						'title'     => __( 'Sticky Header', 'kanga' ),
						'class'     => 'ast-addon',
						'title_url' => kanga_get_pro_url( 'https://wpkanga.com/docs/sticky-header-pro/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
						'links'     => array(
							array(
								'link_class'   => 'ast-learn-more',
								'link_url'     => kanga_get_pro_url( 'https://wpkanga.com/docs/sticky-header-pro/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
								'link_text'    => __( 'Learn More &#187;', 'kanga' ),
								'target_blank' => true,
							),
						),
					),
					'advanced-headers'      => array(
						'title'           => __( 'Page Headers', 'kanga' ),
						'description'     => __( 'Make your header layouts look more appealing and sexy!', 'kanga' ),
						'manage_settings' => true,
						'class'           => 'ast-addon',
						'title_url'       => kanga_get_pro_url( 'https://wpkanga.com/docs/page-headers-overview/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
						'links'           => array(
							array(
								'link_class'   => 'ast-learn-more',
								'link_url'     => kanga_get_pro_url( 'https://wpkanga.com/docs/page-headers-overview/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
								'link_text'    => __( 'Learn More &#187;', 'kanga' ),
								'target_blank' => true,
							),
						),
					),
					'advanced-hooks'        => array(
						'title'           => __( 'Custom Layouts', 'kanga' ),
						// 'icon'            => KANGA_THEME_URI . 'assets/img/kanga-advanced-hooks.png',
						'description'     => __( 'Add content conditionally in the various hook areas of the theme.', 'kanga' ),
						'manage_settings' => true,
						'class'           => 'ast-addon',
						'title_url'       => kanga_get_pro_url( 'https://wpkanga.com/docs/custom-layouts-pro/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
						'links'           => array(
							array(
								'link_class'   => 'ast-learn-more',
								'link_url'     => kanga_get_pro_url( 'https://wpkanga.com/docs/custom-layouts-pro/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
								'link_text'    => __( 'Learn More &#187;', 'kanga' ),
								'target_blank' => true,
							),
						),
					),
					'site-layouts'          => array(
						'title'     => __( 'Site Layouts', 'kanga' ),
						'class'     => 'ast-addon',
						'title_url' => kanga_get_pro_url( 'https://wpkanga.com/docs/site-layout-overview/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
						'links'     => array(
							array(
								'link_class'   => 'ast-learn-more',
								'link_url'     => kanga_get_pro_url( 'https://wpkanga.com/docs/site-layout-overview/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
								'link_text'    => __( 'Learn More &#187;', 'kanga' ),
								'target_blank' => true,
							),
						),
					),
					'advanced-footer'       => array(
						'title'     => __( 'Footer Widgets', 'kanga' ),
						'class'     => 'ast-addon',
						'title_url' => kanga_get_pro_url( 'https://wpkanga.com/docs/footer-widgets-kanga-pro/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
						'links'     => array(
							array(
								'link_class'   => 'ast-learn-more',
								'link_url'     => kanga_get_pro_url( 'https://wpkanga.com/docs/footer-widgets-kanga-pro/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
								'link_text'    => __( 'Learn More &#187;', 'kanga' ),
								'target_blank' => true,
							),
						),
					),
					'scroll-to-top'         => array(
						'title'     => __( 'Scroll To Top', 'kanga' ),
						'class'     => 'ast-addon',
						'title_url' => kanga_get_pro_url( 'https://wpkanga.com/docs/scroll-to-top-pro/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
						'links'     => array(
							array(
								'link_class'   => 'ast-learn-more',
								'link_url'     => kanga_get_pro_url( 'https://wpkanga.com/docs/scroll-to-top-pro/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
								'link_text'    => __( 'Learn More &#187;', 'kanga' ),
								'target_blank' => true,
							),
						),
					),
					'woocommerce'           => array(
						'title'     => __( 'WooCommerce', 'kanga' ),
						'class'     => 'ast-addon',
						'title_url' => kanga_get_pro_url( 'https://wpkanga.com/docs/woocommerce-module-overview/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
						'links'     => array(
							array(
								'link_class'   => 'ast-learn-more',
								'link_url'     => kanga_get_pro_url( 'https://wpkanga.com/docs/woocommerce-module-overview/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
								'link_text'    => __( 'Learn More &#187;', 'kanga' ),
								'target_blank' => true,
							),
						),
					),
					'edd'                   => array(
						'title'     => __( 'Easy Digital Downloads', 'kanga' ),
						'class'     => 'ast-addon',
						'title_url' => kanga_get_pro_url( 'https://wpkanga.com/docs/easy-digital-downloads-module-overview/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
						'links'     => array(
							array(
								'link_class'   => 'ast-learn-more',
								'link_url'     => kanga_get_pro_url( 'https://wpkanga.com/docs', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
								'link_text'    => __( 'Learn More &#187;', 'kanga' ),
								'target_blank' => true,
							),
						),
					),
					'learndash'             => array(
						'title'       => __( 'LearnDash', 'kanga' ),
						'description' => __( 'Supercharge your LearnDash website with amazing design features.', 'kanga' ),
						'class'       => 'ast-addon',
						'title_url'   => kanga_get_pro_url( 'https://wpkanga.com/docs/learndash-integration-in-kanga-pro/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
						'links'       => array(
							array(
								'link_class'   => 'ast-learn-more',
								'link_url'     => kanga_get_pro_url( 'https://wpkanga.com/docs/learndash-integration-in-kanga-pro/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
								'link_text'    => __( 'Learn More &#187;', 'kanga' ),
								'target_blank' => true,
							),
						),
					),
					'lifterlms'             => array(
						'title'     => __( 'LifterLMS', 'kanga' ),
						'class'     => 'ast-addon',
						'title_url' => kanga_get_pro_url( 'https://wpkanga.com/docs/lifterlms-module-pro/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
						'links'     => array(
							array(
								'link_class'   => 'ast-learn-more',
								'link_url'     => kanga_get_pro_url( 'https://wpkanga.com/docs/lifterlms-module-pro/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
								'link_text'    => __( 'Learn More &#187;', 'kanga' ),
								'target_blank' => true,
							),
						),
					),
					'white-label'           => array(
						'title'     => __( 'White Label', 'kanga' ),
						'class'     => 'ast-addon',
						'title_url' => kanga_get_pro_url( 'https://wpkanga.com/docs/how-to-white-label-kanga/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
						'links'     => array(
							array(
								'link_class'   => 'ast-learn-more',
								'link_url'     => kanga_get_pro_url( 'https://wpkanga.com/docs/how-to-white-label-kanga/', 'kanga-dashboard', 'learn-more', 'welcome-page' ),
								'link_text'    => __( 'Learn More &#187;', 'kanga' ),
								'target_blank' => true,
							),
						),
					),
				)
			);
			?>
			<div class="postbox">
				<h2 class="hndle ast-normal-cusror"><span><?php esc_html_e( 'Links to Customizer Settings:', 'kanga' ); ?></span></h2>
					<div class="ast-quick-setting-section">
						<?php
						if ( ! empty( $quick_settings ) ) :
							?>
							<div class="ast-quick-links">
								<ul class="ast-flex">
									<?php
									foreach ( (array) $quick_settings as $key => $link ) {
										echo '<li class=""><span class="dashicons ' . esc_attr( $link['dashicon'] ) . '"></span><a class="ast-quick-setting-title" href="' . esc_url( $link['quick_url'] ) . '" target="_blank" rel="noopener">' . esc_html( $link['title'] ) . '</a></li>';
									}
									?>
								</ul>
							</div>
						<?php endif; ?>
					</div>
			</div>

			<!-- Notice for Older version of Kanga Addon -->
			<?php self::min_addon_version_message(); ?>

			<div class="postbox">
				<h2 class="hndle ast-normal-cusror ast-addon-heading ast-flex"><span><?php echo esc_html( $kanga_addon_tagline ); ?></span>
					<?php do_action( 'kanga_addon_bulk_action' ); ?>
				</h2>
					<div class="ast-addon-list-section">
						<?php
						if ( ! empty( $extensions ) ) :
							?>
							<div>
								<ul class="ast-addon-list">
									<?php
									foreach ( (array) $extensions as $addon => $info ) {
										$title_url     = ( isset( $info['title_url'] ) && ! empty( $info['title_url'] ) ) ? 'href="' . esc_url( $info['title_url'] ) . '"' : '';
										$anchor_target = ( isset( $info['title_url'] ) && ! empty( $info['title_url'] ) ) ? "target='_blank' rel='noopener'" : '';

										echo '<li id="' . esc_attr( $addon ) . '"  class="' . esc_attr( $info['class'] ) . '"><a class="ast-addon-title"' . $title_url . $anchor_target . ' >' . esc_html( $info['title'] ) . '</a><div class="ast-addon-link-wrapper">'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

										foreach ( $info['links'] as $key => $link ) {
											printf(
												'<a class="%1$s" %2$s %3$s> %4$s </a>',
												esc_attr( $link['link_class'] ),
												isset( $link['link_url'] ) ? 'href="' . esc_url( $link['link_url'] ) . '"' : '',
												( isset( $link['target_blank'] ) && $link['target_blank'] ) ? 'target="_blank" rel="noopener"' : '', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
												esc_html( $link['link_text'] )
											);
										}
										echo '</div></li>';
									}
									?>
								</ul>
							</div>
						<?php endif; ?>
					</div>
			</div>

			<?php
		}

		/**
		 * Include Welcome page content
		 *
		 * @since 1.2.4
		 */
		public static function kanga_available_plugins() {

			if ( kanga_is_white_labelled() ) {
				return;
			}

			$kanga_addon_tagline = apply_filters(
				'kanga_available_plugins',
				sprintf(
					/* translators: %1s Kanga Theme */
					__( 'Extend %1s with free plugins!', 'kanga' ),
					kanga_get_theme_name()
				)
			);

			$recommended_plugins = apply_filters(
				'kanga_recommended_plugins',
				array(
					'kanga-import-export'           =>
						array(
							'plugin-name'        => 'Import / Export Customizer Settings',
							'plugin-init'        => 'kanga-import-export/kanga-import-export.php',
							'settings-link'      => '',
							'settings-link-text' => 'Settings',
						),
					'reset-kanga-customizer'        =>
						array(
							'plugin-name'        => 'Kanga Customizer Reset',
							'plugin-init'        => 'reset-kanga-customizer/class-kanga-theme-customizer-reset.php',
							'settings-link'      => admin_url( 'customize.php' ),
							'settings-link-text' => 'Settings',
						),

					'customizer-search'             =>
					array(
						'plugin-name'        => 'Customizer Search',
						'plugin-init'        => 'customizer-search/customizer-search.php',
						'settings-link'      => admin_url( 'customize.php' ),
						'settings-link-text' => 'Settings',
					),

					'kanga-bulk-edit'               =>
					array(
						'plugin-name'        => 'Kanga Bulk Edit',
						'plugin-init'        => 'kanga-bulk-edit/kanga-bulk-edit.php',
						'settings-link'      => '',
						'settings-link-text' => 'Settings',
					),

					'kanga-widgets'                 =>
					array(
						'plugin-name'        => 'Kanga Widgets',
						'plugin-init'        => 'kanga-widgets/kanga-widgets.php',
						'settings-link'      => admin_url( 'widgets.php' ),
						'settings-link-text' => 'Settings',
					),

					'leadin'                        =>
						array(
							'plugin-name'        => 'HubSpot - CRM, Email Marketing & Analytics',
							'plugin-init'        => 'leadin/leadin.php',
							'settings-link'      => admin_url( 'admin.php?page=leadin' ),
							'settings-link-text' => 'Settings',
						),

					'custom-fonts'                  =>
					array(
						'plugin-name'        => 'Custom Fonts',
						'plugin-init'        => 'custom-fonts/custom-fonts.php',
						'settings-link'      => admin_url( 'edit-tags.php?taxonomy=bsf_custom_fonts' ),
						'settings-link-text' => 'Settings',
					),

					'custom-typekit-fonts'          =>
						array(
							'plugin-name'        => 'Custom Typekit Fonts',
							'plugin-init'        => 'custom-typekit-fonts/custom-typekit-fonts.php',
							'settings-link'      => admin_url( 'themes.php?page=custom-typekit-fonts' ),
							'settings-link-text' => 'Settings',
						),

					'sidebar-manager'               =>
					array(
						'plugin-name'        => 'Sidebar Manager',
						'plugin-init'        => 'sidebar-manager/sidebar-manager.php',
						'settings-link'      => admin_url( 'edit.php?post_type=bsf-sidebar' ),
						'settings-link-text' => 'Settings',
					),

					'ultimate-addons-for-gutenberg' =>
						array(
							'plugin-name'        => 'Ultimate Addons for Gutenberg',
							'plugin-init'        => 'ultimate-addons-for-gutenberg/ultimate-addons-for-gutenberg.php',
							'settings-link'      => admin_url( 'options-general.php?page=uag' ),
							'settings-link-text' => 'Settings',
							'display'            => function_exists( 'register_block_type' ),
						),
				)
			);

			if ( apply_filters( 'kanga_show_free_extend_plugins', true ) ) {
				?>

				<div class="postbox">
					<h2 class="hndle ast-normal-cusror ast-addon-heading ast-flex"><span><?php echo esc_html( $kanga_addon_tagline ); ?></span>
					</h2>
						<div class="ast-addon-list-section">
							<?php
							if ( ! empty( $recommended_plugins ) ) :
								?>
								<div>
									<ul class="ast-addon-list">
										<?php
										foreach ( $recommended_plugins as $slug => $plugin ) {

											// If display condition for the plugin does not meet, skip the plugin from displaying.
											if ( isset( $plugin['display'] ) && false === $plugin['display'] ) {
												continue;
											}

											$plugin_active_status = '';
											if ( is_plugin_active( $plugin['plugin-init'] ) ) {
												$plugin_active_status = ' active';
											}

											echo '<li ' . kanga_attr(
												'kanga-recommended-plugin-' . esc_attr( $slug ),
												array(
													'id' => esc_attr( $slug ),
													'class' => 'kanga-recommended-plugin' . $plugin_active_status,
													'data-slug' => $slug,
												)
											) . '>';

												echo '<a href="' . esc_url( self::build_worg_plugin_link( $slug ) ) . '" target="_blank">';
													echo esc_html( $plugin['plugin-name'] );
												echo '</a>';

												echo '<div class="ast-addon-link-wrapper">';

											if ( ! is_plugin_active( $plugin['plugin-init'] ) ) {

												if ( file_exists( WP_CONTENT_DIR . '/plugins/' . $plugin['plugin-init'] ) ) {
													echo '<a ' . kanga_attr(
														'kanga-activate-recommended-plugin',
														array(
															'data-slug' => $slug,
															'href' => '#',
															'data-init' => $plugin['plugin-init'],
															'data-settings-link' => esc_url( $plugin['settings-link'] ),
															'data-settings-link-text' => $plugin['settings-link-text'],
														)
													) . '>';

													esc_html_e( 'Activate', 'kanga' );

													echo '</a>';

												} else {

													echo '<a ' . kanga_attr(
														'kanga-install-recommended-plugin',
														array(
															'data-slug' => $slug,
															'href' => '#',
															'data-init' => $plugin['plugin-init'],
															'data-settings-link' => esc_url( $plugin['settings-link'] ),
															'data-settings-link-text' => $plugin['settings-link-text'],
														)
													) . '>';

													esc_html_e( 'Activate', 'kanga' );

													echo '</a>';
												}
											} else {

												echo '<a ' . kanga_attr(
													'kanga-deactivate-recommended-plugin',
													array(
														'data-slug' => $slug,
														'href' => '#',
														'data-init' => $plugin['plugin-init'],
														'data-settings-link' => esc_url( $plugin['settings-link'] ),
														'data-settings-link-text' => $plugin['settings-link-text'],
													)
												) . '>';

												esc_html_e( 'Deactivate', 'kanga' );

												echo '</a>';

												if ( '' !== $plugin['settings-link'] ) {

													echo '<a ' . kanga_attr(
														'kanga-recommended-plugin-links',
														array(
															'data-slug' => $slug,
															'href' => $plugin['settings-link'],
														)
													) . '>';

													echo esc_html( $plugin['settings-link-text'] );

													echo '</a>';
												}
											}

												echo '</div>';

											echo '</li>';
										}
										?>
									</ul>
								</div>
								<?php endif; ?>
						</div>
				</div>

				<?php
			}

		}

		/**
		 * Build plugin's page URL on WordPress.org
		 * https://wordpress.org/plugins/{plugin-slug}
		 *
		 * @since 1.6.9
		 * @param String $slug plugin slug.
		 * @return String Plugin URL on WordPress.org
		 */
		private static function build_worg_plugin_link( $slug ) {
			return esc_url( trailingslashit( 'https://wordpress.org/plugins/' . $slug ) );
		}

		/**
		 * Required Plugin Activate
		 *
		 * @since 1.2.4
		 */
		public static function required_plugin_activate() {

			$nonce = ( isset( $_POST['nonce'] ) ) ? sanitize_key( $_POST['nonce'] ) : '';

			if ( false === wp_verify_nonce( $nonce, 'kanga-recommended-plugin-nonce' ) ) {
				wp_send_json_error( esc_html_e( 'WordPress Nonce not validated.', 'kanga' ) );
			}

			if ( ! current_user_can( 'install_plugins' ) || ! isset( $_POST['init'] ) || ! $_POST['init'] ) {
				wp_send_json_error(
					array(
						'success' => false,
						'message' => __( 'No plugin specified', 'kanga' ),
					)
				);
			}

			$plugin_init = ( isset( $_POST['init'] ) ) ? esc_attr( $_POST['init'] ) : '';

			$activate = activate_plugin( $plugin_init, '', false, true );

			if ( '/kanga-sites/kanga-sites.php' === $plugin_init ) {
				self::get_starter_templates_slug();
			}

			if ( is_wp_error( $activate ) ) {
				wp_send_json_error(
					array(
						'success'               => false,
						'message'               => $activate->get_error_message(),
						'starter_template_slug' => self::$starter_templates_slug,
					)
				);
			}

			wp_send_json_success(
				array(
					'success'               => true,
					'message'               => __( 'Plugin Successfully Activated', 'kanga' ),
					'starter_template_slug' => self::$starter_templates_slug,
				)
			);
		}

		/**
		 * Required Plugin Activate
		 *
		 * @since 1.2.4
		 */
		public static function required_plugin_deactivate() {

			$nonce = ( isset( $_POST['nonce'] ) ) ? sanitize_key( $_POST['nonce'] ) : '';

			if ( false === wp_verify_nonce( $nonce, 'kanga-recommended-plugin-nonce' ) ) {
				wp_send_json_error( esc_html_e( 'WordPress Nonce not validated.', 'kanga' ) );
			}

			if ( ! current_user_can( 'install_plugins' ) || ! isset( $_POST['init'] ) || ! $_POST['init'] ) {
				wp_send_json_error(
					array(
						'success' => false,
						'message' => __( 'No plugin specified', 'kanga' ),
					)
				);
			}

			$plugin_init = ( isset( $_POST['init'] ) ) ? esc_attr( $_POST['init'] ) : '';

			$deactivate = deactivate_plugins( $plugin_init, '', false );

			if ( is_wp_error( $deactivate ) ) {
				wp_send_json_error(
					array(
						'success' => false,
						'message' => $deactivate->get_error_message(),
					)
				);
			}

			wp_send_json_success(
				array(
					'success' => true,
					'message' => __( 'Plugin Successfully Deactivated', 'kanga' ),
				)
			);

		}

		/**
		 * Check compatible theme version.
		 *
		 * @since 1.2.4
		 */
		public static function min_addon_version_message() {

			$kanga_global_options = get_option( 'kanga-settings' );

			if ( isset( $kanga_global_options['kanga-addon-auto-version'] ) && defined( 'KANGA_EXT_VER' ) ) {

				if ( version_compare( $kanga_global_options['kanga-addon-auto-version'], '1.2.1' ) < 0 ) {

					// If addon is not updated & White Label for Addon is added then show the white labelewd pro name.
					$kanga_addon_name        = kanga_get_addon_name();
					$update_kanga_addon_link = kanga_get_pro_url( 'https://wpkanga.com/?p=25258', 'kanga-dashboard', 'update-to-kanga-pro', 'welcome-page' );
					if ( class_exists( 'Kanga_Ext_White_Label_Markup' ) ) {
						$plugin_data = Kanga_Ext_White_Label_Markup::$branding;
						if ( ! empty( $plugin_data['kanga-pro']['name'] ) ) {
							$update_kanga_addon_link = '';
						}
					}

					$class   = 'ast-notice ast-notice-error';
					$message = sprintf(
						/* translators: %1$1s: Addon Name, %2$2s: Minimum Required version of the Kanga Addon */
						__( 'Update to the latest version of %1$2s to make changes in settings below.', 'kanga' ),
						( ! empty( $update_kanga_addon_link ) ) ? '<a href=' . esc_url( $update_kanga_addon_link ) . ' target="_blank" rel="noopener">' . $kanga_addon_name . '</a>' : $kanga_addon_name
					);

					printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
				}
			}
		}

		/**
		 * Kanga Header Right Section Links
		 *
		 * @since 1.2.4
		 */
		public static function top_header_right_section() {

			$allowed_html = array(
				'svg'  => array(
					'width'   => array(),
					'height'  => array(),
					'xmlns'   => array(),
					'viewBox' => array(),
				),
				'path' => array(
					'fill' => array(),
					'd'    => array(),
				),
			);

			$top_links = apply_filters(
				'kanga_header_top_links',
				array(
					'kanga-theme-info' => array(
						'title' => '<img src=" ' . KANGA_THEME_URI . 'inc/assets/images/lightning-speed.svg" class="kanga-lightning-icon" alt="Kanga Lightning Speed">' . __( ' Lightning Fast & Fully Customizable WordPress theme!', 'kanga' ),
					),
				)
			);

			if ( ! empty( $top_links ) ) {
				?>
				<div class="ast-top-links">
					<ul>
						<?php
						foreach ( (array) $top_links as $key => $info ) {
							/* translators: %1$s: Top Link URL wrapper, %2$s: Top Link URL, %3$s: Top Link URL target attribute */
							printf(
								'<li><%1$s %2$s %3$s > %4$s </%1$s>',
								isset( $info['url'] ) ? 'a' : 'span',
								isset( $info['url'] ) ? 'href="' . esc_url( $info['url'] ) . '"' : '', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								isset( $info['url'] ) ? 'target="_blank" rel="noopener"' : '', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								$info['title']// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							);
						}
						?>
						</ul>
					</div>
				<?php
			}
		}
	}

	new Kanga_Admin_Settings();
}
