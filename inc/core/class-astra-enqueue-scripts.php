<?php
/**
 * Loader Functions
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

/**
 * Theme Enqueue Scripts
 */
if ( ! class_exists( 'Kanga_Enqueue_Scripts' ) ) {

	/**
	 * Theme Enqueue Scripts
	 */
	class Kanga_Enqueue_Scripts {

		/**
		 * Class styles.
		 *
		 * @access public
		 * @var $styles Enqueued styles.
		 */
		public static $styles;

		/**
		 * Class scripts.
		 *
		 * @access public
		 * @var $scripts Enqueued scripts.
		 */
		public static $scripts;

		/**
		 * Constructor
		 */
		public function __construct() {

			add_action( 'kanga_get_fonts', array( $this, 'add_fonts' ), 1 );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 1 );
			add_action( 'enqueue_block_editor_assets', array( $this, 'gutenberg_assets' ) );
			add_filter( 'admin_body_class', array( $this, 'admin_body_class' ) );
			add_action( 'wp_print_footer_scripts', array( $this, 'kanga_skip_link_focus_fix' ) );
		}

		/**
		 * Fix skip link focus in IE11.
		 *
		 * This does not enqueue the script because it is tiny and because it is only for IE11,
		 * thus it does not warrant having an entire dedicated blocking script being loaded.
		 *
		 * @link https://git.io/vWdr2
		 * @link https://github.com/WordPress/twentynineteen/pull/47/files
		 * @link https://github.com/ampproject/amphtml/issues/18671
		 */
		public function kanga_skip_link_focus_fix() {
			// Skip printing script on AMP content, since accessibility fix is covered by AMP framework.
			if ( kanga_is_amp_endpoint() ) {
				return;
			}

			// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
			?>
			<script>
			/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
			</script>
			<?php
		}

		/**
		 * Admin body classes.
		 *
		 * Body classes to be added to <body> tag in admin page
		 *
		 * @param String $classes body classes returned from the filter.
		 * @return String body classes to be added to <body> tag in admin page
		 */
		public function admin_body_class( $classes ) {

			global $pagenow;
			$screen = get_current_screen();

			if ( ( 'post-new.php' == $pagenow || 'post.php' == $pagenow ) && ( defined( 'KANGA_ADVANCED_HOOKS_POST_TYPE' ) && KANGA_ADVANCED_HOOKS_POST_TYPE == $screen->post_type ) ) {
				return;
			}

			$post_id = get_the_ID();

			if ( $post_id ) {
				$meta_content_layout = get_post_meta( $post_id, 'site-content-layout', true );
			}

			if ( ( isset( $meta_content_layout ) && ! empty( $meta_content_layout ) ) && 'default' !== $meta_content_layout ) {
				$content_layout = $meta_content_layout;
			} else {
				$content_layout = kanga_get_option( 'site-content-layout' );
			}

			if ( 'content-boxed-container' == $content_layout ) {
				$classes .= ' ast-separate-container';
			} elseif ( 'boxed-container' == $content_layout ) {
				$classes .= ' ast-separate-container ast-two-container';
			} elseif ( 'page-builder' == $content_layout ) {
				$classes .= ' ast-page-builder-template';
			} elseif ( 'plain-container' == $content_layout ) {
				$classes .= ' ast-plain-container';
			}

			$classes .= ' ast-' . kanga_page_layout();

			return $classes;
		}

		/**
		 * List of all assets.
		 *
		 * @return array assets array.
		 */
		public static function theme_assets() {

			$default_assets = array(

				// handle => location ( in /assets/js/ ) ( without .js ext).
				'js'  => array(
					'kanga-theme-js' => 'style',
				),

				// handle => location ( in /assets/css/ ) ( without .css ext).
				'css' => array(
					'kanga-theme-css' => 'style',
				),
			);

			return apply_filters( 'kanga_theme_assets', $default_assets );
		}

		/**
		 * Add Fonts
		 */
		public function add_fonts() {

			$font_family  = kanga_get_option( 'body-font-family' );
			$font_weight  = kanga_get_option( 'body-font-weight' );
			$font_variant = kanga_get_option( 'body-font-variant' );

			Kanga_Fonts::add_font( $font_family, $font_weight );
			Kanga_Fonts::add_font( $font_family, $font_variant );

			// Render headings font.
			$heading_font_family  = kanga_get_option( 'headings-font-family' );
			$heading_font_weight  = kanga_get_option( 'headings-font-weight' );
			$heading_font_variant = kanga_get_option( 'headings-font-variant' );

			Kanga_Fonts::add_font( $heading_font_family, $heading_font_weight );
			Kanga_Fonts::add_font( $heading_font_family, $heading_font_variant );
		}

		/**
		 * Enqueue Scripts
		 */
		public function enqueue_scripts() {

			if ( false === self::enqueue_theme_assets() ) {
				return;
			}

			/* Directory and Extension */
			$file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';
			$dir_name    = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';

			$js_uri  = KANGA_THEME_URI . 'assets/js/' . $dir_name . '/';
			$css_uri = KANGA_THEME_URI . 'assets/css/' . $dir_name . '/';

			/**
			 * IE Only Js and CSS Files.
			 */
			// Flexibility.js for flexbox IE10 support.
			wp_enqueue_script( 'kanga-flexibility', $js_uri . 'flexibility' . $file_prefix . '.js', array(), KANGA_THEME_VERSION, false );
			wp_add_inline_script( 'kanga-flexibility', 'flexibility(document.documentElement);' );
			wp_script_add_data( 'kanga-flexibility', 'conditional', 'IE' );

			// Polyfill for CustomEvent for IE.
			wp_register_script( 'kanga-customevent', $js_uri . 'custom-events-polyfill' . $file_prefix . '.js', array(), KANGA_THEME_VERSION, false );

			// All assets.
			$all_assets = self::theme_assets();
			$styles     = $all_assets['css'];
			$scripts    = $all_assets['js'];

			if ( is_array( $styles ) && ! empty( $styles ) ) {
				// Register & Enqueue Styles.
				foreach ( $styles as $key => $style ) {

					$dependency = array();

					// Add dynamic CSS dependency for all styles except for theme's style.css.
					if ( 'kanga-theme-css' !== $key && class_exists( 'Kanga_Cache_Base' ) ) {
						if ( ! Kanga_Cache_Base::inline_assets() ) {
							$dependency[] = 'kanga-theme-dynamic';
						}
					}

					// Generate CSS URL.
					$css_file = $css_uri . $style . $file_prefix . '.css';

					// Register.
					wp_register_style( $key, $css_file, $dependency, KANGA_THEME_VERSION, 'all' );

					// Enqueue.
					wp_enqueue_style( $key );

					// RTL support.
					wp_style_add_data( $key, 'rtl', 'replace' );
				}
			}

			// Fonts - Render Fonts.
			Kanga_Fonts::render_fonts();

			/**
			 * Inline styles
			 */

			add_filter( 'kanga_dynamic_theme_css', array( 'Kanga_Dynamic_CSS', 'return_output' ) );
			add_filter( 'kanga_dynamic_theme_css', array( 'Kanga_Dynamic_CSS', 'return_meta_output' ) );

			// Submenu Container Animation.
			$menu_animation = kanga_get_option( 'header-main-submenu-container-animation' );

			$rtl = ( is_rtl() ) ? '-rtl' : '';

			if ( ! empty( $menu_animation ) ) {
				if ( class_exists( 'Kanga_Cache' ) ) {
					Kanga_Cache::add_css_file( KANGA_THEME_DIR . 'assets/css/' . $dir_name . '/menu-animation' . $rtl . $file_prefix . '.css' );
				} else {
					wp_register_style( 'kanga-menu-animation', $css_uri . 'menu-animation' . $file_prefix . '.css', null, KANGA_THEME_VERSION, 'all' );
					wp_enqueue_style( 'kanga-menu-animation' );
				}
			}

			if ( ! class_exists( 'Kanga_Cache' ) ) {
				$theme_css_data = apply_filters( 'kanga_dynamic_theme_css', '' );
				wp_add_inline_style( 'kanga-theme-css', $theme_css_data );
			}

			if ( kanga_is_amp_endpoint() ) {
				return;
			}

			// Comment assets.
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

			if ( is_array( $scripts ) && ! empty( $scripts ) ) {
				// Register & Enqueue Scripts.
				foreach ( $scripts as $key => $script ) {

					// Register.
					wp_register_script( $key, $js_uri . $script . $file_prefix . '.js', array(), KANGA_THEME_VERSION, true );

					// Enqueue.
					wp_enqueue_script( $key );
				}
			}

			$kanga_localize = array(
				'break_point' => kanga_header_break_point(),    // Header Break Point.
				'isRtl'       => is_rtl(),
			);

			wp_localize_script( 'kanga-theme-js', 'kanga', apply_filters( 'kanga_theme_js_localize', $kanga_localize ) );
		}

		/**
		 * Trim CSS
		 *
		 * @since 1.0.0
		 * @param string $css CSS content to trim.
		 * @return string
		 */
		public static function trim_css( $css = '' ) {

			// Trim white space for faster page loading.
			if ( ! empty( $css ) ) {
				$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
				$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );
				$css = str_replace( ', ', ',', $css );
			}

			return $css;
		}

		/**
		 * Enqueue Gutenberg assets.
		 *
		 * @since 1.5.2
		 *
		 * @return void
		 */
		public function gutenberg_assets() {
			/* Directory and Extension */
			$rtl = '';
			if ( is_rtl() ) {
				$rtl = '-rtl';
			}

			$css_uri = KANGA_THEME_URI . 'inc/assets/css/block-editor-styles' . $rtl . '.css';
			$js_uri  = KANGA_THEME_URI . 'inc/assets/js/block-editor-script.js';

			wp_enqueue_style( 'kanga-block-editor-styles', $css_uri, false, KANGA_THEME_VERSION, 'all' );
			wp_enqueue_script( 'kanga-block-editor-script', $js_uri, false, KANGA_THEME_VERSION, 'all' );

			// Render fonts in Gutenberg layout.
			Kanga_Fonts::render_fonts();

			wp_add_inline_style( 'kanga-block-editor-styles', apply_filters( 'kanga_block_editor_dynamic_css', Gutenberg_Editor_CSS::get_css() ) );
		}

		/**
		 * Function to check if enqueuing of Kanga assets are disabled.
		 *
		 * @since 2.1.0
		 * @return boolean
		 */
		public static function enqueue_theme_assets() {
			return apply_filters( 'kanga_enqueue_theme_assets', true );
		}

	}

	new Kanga_Enqueue_Scripts();
}
