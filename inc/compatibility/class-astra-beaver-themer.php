<?php
/**
 * Beaver Themer Compatibility File.
 *
 * @package Kanga
 */

// If plugin - 'Beaver Themer' not exist then return.
if ( ! class_exists( 'FLThemeBuilderLoader' ) || ! class_exists( 'FLThemeBuilderLayoutData' ) ) {
	return;
}

/**
 * Kanga Beaver Themer Compatibility
 */
if ( ! class_exists( 'Kanga_Beaver_Themer' ) ) :

	/**
	 * Kanga Beaver Themer Compatibility
	 *
	 * @since 1.0.0
	 */
	class Kanga_Beaver_Themer {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'after_setup_theme', array( $this, 'header_footer_support' ) );
			add_action( 'wp', array( $this, 'theme_header_footer_render' ) );
			add_filter( 'fl_theme_builder_part_hooks', array( $this, 'register_part_hooks' ) );
			add_filter( 'post_class', array( $this, 'render_post_class' ), 99 );
			add_action( 'fl_theme_builder_before_render_content', array( $this, 'builder_before_render_content' ), 10, 1 );
			add_action( 'fl_theme_builder_after_render_content', array( $this, 'builder_after_render_content' ), 10, 1 );
		}

		/**
		 * Builder Template Content layout set as Full Width / Stretched
		 *
		 * @param  string $layout Content Layout.
		 * @return string
		 * @since  1.0.2
		 */
		public function builder_template_content_layout( $layout ) {

			$ids       = FLThemeBuilderLayoutData::get_current_page_content_ids();
			$post_type = get_post_type();

			if ( 'fl-theme-layout' == $post_type ) {
				remove_action( 'kanga_entry_after', 'kanga_single_post_navigation_markup' );
			}

			if ( empty( $ids ) && 'fl-theme-layout' != $post_type ) {
				return $layout;
			}

			return 'page-builder';
		}

		/**
		 * Remove theme post's default classes
		 *
		 * @param  array $classes Post Classes.
		 * @return array
		 * @since  1.0.2
		 */
		public function render_post_class( $classes ) {

			$post_class = array( 'fl-post-grid-post', 'fl-post-gallery-post', 'fl-post-feed-post' );
			$result     = array_intersect( $classes, $post_class );

			if ( count( $result ) > 0 ) {
				$classes = array_diff(
					$classes,
					array(
						// Kanga common grid.
						'ast-col-xs-1',
						'ast-col-xs-2',
						'ast-col-xs-3',
						'ast-col-xs-4',
						'ast-col-xs-5',
						'ast-col-xs-6',
						'ast-col-xs-7',
						'ast-col-xs-8',
						'ast-col-xs-9',
						'ast-col-xs-10',
						'ast-col-xs-11',
						'ast-col-xs-12',
						'ast-col-sm-1',
						'ast-col-sm-2',
						'ast-col-sm-3',
						'ast-col-sm-4',
						'ast-col-sm-5',
						'ast-col-sm-6',
						'ast-col-sm-7',
						'ast-col-sm-8',
						'ast-col-sm-9',
						'ast-col-sm-10',
						'ast-col-sm-11',
						'ast-col-sm-12',
						'ast-col-md-1',
						'ast-col-md-2',
						'ast-col-md-3',
						'ast-col-md-4',
						'ast-col-md-5',
						'ast-col-md-6',
						'ast-col-md-7',
						'ast-col-md-8',
						'ast-col-md-9',
						'ast-col-md-10',
						'ast-col-md-11',
						'ast-col-md-12',
						'ast-col-lg-1',
						'ast-col-lg-2',
						'ast-col-lg-3',
						'ast-col-lg-4',
						'ast-col-lg-5',
						'ast-col-lg-6',
						'ast-col-lg-7',
						'ast-col-lg-8',
						'ast-col-lg-9',
						'ast-col-lg-10',
						'ast-col-lg-11',
						'ast-col-lg-12',
						'ast-col-xl-1',
						'ast-col-xl-2',
						'ast-col-xl-3',
						'ast-col-xl-4',
						'ast-col-xl-5',
						'ast-col-xl-6',
						'ast-col-xl-7',
						'ast-col-xl-8',
						'ast-col-xl-9',
						'ast-col-xl-10',
						'ast-col-xl-11',
						'ast-col-xl-12',

						// Kanga Blog / Single Post.
						'ast-article-post',
						'ast-article-single',
						'ast-separate-posts',
						'remove-featured-img-padding',
						'ast-featured-post',

						// Kanga Woocommerce.
						'ast-product-gallery-layout-vertical',
						'ast-product-gallery-layout-horizontal',
						'ast-product-gallery-with-no-image',

						'ast-product-tabs-layout-vertical',
						'ast-product-tabs-layout-horizontal',

						'ast-qv-disabled',
						'ast-qv-on-image',
						'ast-qv-on-image-click',
						'ast-qv-after-summary',

						'kanga-woo-hover-swap',

						'box-shadow-0',
						'box-shadow-0-hover',
						'box-shadow-1',
						'box-shadow-1-hover',
						'box-shadow-2',
						'box-shadow-2-hover',
						'box-shadow-3',
						'box-shadow-3-hover',
						'box-shadow-4',
						'box-shadow-4-hover',
						'box-shadow-5',
						'box-shadow-5-hover',
					)
				);

				add_filter( 'kanga_post_link_enabled', '__return_false' );
			}

			return $classes;
		}

		/**
		 * Function to add Theme Support
		 *
		 * @since 1.0.0
		 */
		public function header_footer_support() {

			add_theme_support( 'fl-theme-builder-headers' );
			add_theme_support( 'fl-theme-builder-footers' );
			add_theme_support( 'fl-theme-builder-parts' );
		}

		/**
		 * Function to update Atra header/footer with Beaver template
		 *
		 * @since 1.0.0
		 */
		public function theme_header_footer_render() {

			// Get the header ID.
			$header_ids = FLThemeBuilderLayoutData::get_current_page_header_ids();

			// If we have a header, remove the theme header and hook in Theme Builder's.
			if ( ! empty( $header_ids ) ) {
				remove_action( 'kanga_header', 'kanga_header_markup' );
				add_action( 'kanga_header', 'FLThemeBuilderLayoutRenderer::render_header' );
			}

			// Get the footer ID.
			$footer_ids = FLThemeBuilderLayoutData::get_current_page_footer_ids();

			// If we have a footer, remove the theme footer and hook in Theme Builder's.
			if ( ! empty( $footer_ids ) ) {
				remove_action( 'kanga_footer', 'kanga_footer_markup' );
				add_action( 'kanga_footer', 'FLThemeBuilderLayoutRenderer::render_footer' );
			}

			// BB Themer Support.
			$template_ids = FLThemeBuilderLayoutData::get_current_page_content_ids();

			if ( ! empty( $template_ids ) ) {

				$template_id   = $template_ids[0];
				$template_type = get_post_meta( $template_id, '_fl_theme_layout_type', true );

				if ( 'archive' === $template_type || 'singular' === $template_type || '404' === $template_type ) {

					$sidebar = get_post_meta( $template_id, 'site-sidebar-layout', true );

					if ( 'default' !== $sidebar ) {
						add_filter(
							'kanga_page_layout',
							function( $page_layout ) use ( $sidebar ) {

								return $sidebar;
							}
						);
					}

					$content_layout = get_post_meta( $template_id, 'site-content-layout', true );
					if ( 'default' !== $content_layout ) {
						add_filter(
							'kanga_get_content_layout',
							function( $layout ) use ( $content_layout ) {

								return $content_layout;
							}
						);
					}

					$main_header_display = get_post_meta( $template_id, 'ast-main-header-display', true );
					if ( 'disabled' === $main_header_display ) {

						if ( 'archive' === $template_type ) {
							remove_action( 'kanga_masthead', 'kanga_masthead_primary_template' );
						} else {
							add_filter(
								'ast_main_header_display',
								function( $display_header ) {

									return 'disabled';
								}
							);
						}
					}

					$footer_layout = get_post_meta( $template_id, 'footer-sml-layout', true );
					if ( 'disabled' === $footer_layout ) {

						add_filter(
							'ast_footer_sml_layout',
							function( $is_footer ) {

								return 'disabled';
							}
						);
					}

					// Override! Footer Widgets.
					$footer_widgets = get_post_meta( $template_id, 'footer-adv-display', true );
					if ( 'disabled' === $footer_widgets ) {
						add_filter(
							'kanga_advanced_footer_disable',
							function() {
								return true;
							}
						);
					}
				}
			}
		}

		/**
		 * Function to Kanga theme parts
		 *
		 * @since 1.0.0
		 */
		public function register_part_hooks() {

			return array(
				array(
					'label' => 'Page',
					'hooks' => array(
						'kanga_body_top'    => __( 'Before Page', 'kanga' ),
						'kanga_body_bottom' => __( 'After Page', 'kanga' ),
					),
				),
				array(
					'label' => 'Header',
					'hooks' => array(
						'kanga_header_before' => __( 'Before Header', 'kanga' ),
						'kanga_header_after'  => __( 'After Header', 'kanga' ),
					),
				),
				array(
					'label' => 'Content',
					'hooks' => array(
						'kanga_primary_content_top'    => __( 'Before Content', 'kanga' ),
						'kanga_primary_content_bottom' => __( 'After Content', 'kanga' ),
					),
				),
				array(
					'label' => 'Footer',
					'hooks' => array(
						'kanga_footer_before' => __( 'Before Footer', 'kanga' ),
						'kanga_footer_after'  => __( 'After Footer', 'kanga' ),
					),
				),
				array(
					'label' => 'Sidebar',
					'hooks' => array(
						'kanga_sidebars_before' => __( 'Before Sidebar', 'kanga' ),
						'kanga_sidebars_after'  => __( 'After Sidebar', 'kanga' ),
					),
				),
				array(
					'label' => 'Posts',
					'hooks' => array(
						'loop_start'                 => __( 'Loop Start', 'kanga' ),
						'kanga_entry_top'            => __( 'Before Post', 'kanga' ),
						'kanga_entry_content_before' => __( 'Before Post Content', 'kanga' ),
						'kanga_entry_content_after'  => __( 'After Post Content', 'kanga' ),
						'kanga_entry_bottom'         => __( 'After Post', 'kanga' ),
						'kanga_comments_before'      => __( 'Before Comments', 'kanga' ),
						'kanga_comments_after'       => __( 'After Comments', 'kanga' ),
						'loop_end'                   => __( 'Loop End', 'kanga' ),
					),
				),
			);
		}

		/**
		 * Function to theme before render content
		 *
		 * @param int $post_id Post ID.
		 * @since 1.0.28
		 */
		public function builder_before_render_content( $post_id ) {

			?>
			<?php if ( 'left-sidebar' === kanga_page_layout() ) : ?>

				<?php get_sidebar(); ?>

			<?php endif ?>

			<div id="primary" <?php kanga_primary_class(); ?>>
			<?php
		}

		/**
		 * Function to theme after render content
		 *
		 * @param int $post_id Post ID.
		 * @since 1.0.28
		 */
		public function builder_after_render_content( $post_id ) {

			?>
			</div><!-- #primary -->

			<?php if ( 'right-sidebar' === kanga_page_layout() ) : ?>

				<?php get_sidebar(); ?>

			<?php endif ?>

			<?php
		}

	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
Kanga_Beaver_Themer::get_instance();
