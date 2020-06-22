<?php
/**
 * Kanga functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Kanga
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define Constants
 */
define( 'KANGA_THEME_VERSION', '2.4.5' );
define( 'KANGA_THEME_SETTINGS', 'kanga-settings' );
define( 'KANGA_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'KANGA_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );


/**
 * Minimum Version requirement of the Kanga Pro addon.
 * This constant will be used to display the notice asking user to update the Kanga addon to latest version.
 */
define( 'KANGA_EXT_MIN_VER', '2.5.0' );

/**
 * Setup helper functions of Kanga.
 */
require_once KANGA_THEME_DIR . 'inc/core/class-kanga-theme-options.php';
require_once KANGA_THEME_DIR . 'inc/core/class-theme-strings.php';
require_once KANGA_THEME_DIR . 'inc/core/common-functions.php';

/**
 * Update theme
 */
require_once KANGA_THEME_DIR . 'inc/theme-update/class-kanga-theme-update.php';
require_once KANGA_THEME_DIR . 'inc/theme-update/kanga-update-functions.php';
require_once KANGA_THEME_DIR . 'inc/theme-update/class-kanga-theme-background-updater.php';
require_once KANGA_THEME_DIR . 'inc/theme-update/class-kanga-pb-compatibility.php';


/**
 * Fonts Files
 */
require_once KANGA_THEME_DIR . 'inc/customizer/class-kanga-font-families.php';
if ( is_admin() ) {
	require_once KANGA_THEME_DIR . 'inc/customizer/class-kanga-fonts-data.php';
}

require_once KANGA_THEME_DIR . 'inc/customizer/class-kanga-fonts.php';

require_once KANGA_THEME_DIR . 'inc/core/class-kanga-walker-page.php';
require_once KANGA_THEME_DIR . 'inc/core/class-kanga-enqueue-scripts.php';
require_once KANGA_THEME_DIR . 'inc/core/class-gutenberg-editor-css.php';
require_once KANGA_THEME_DIR . 'inc/class-kanga-dynamic-css.php';

/**
 * Custom template tags for this theme.
 */
require_once KANGA_THEME_DIR . 'inc/core/class-kanga-attr.php';
require_once KANGA_THEME_DIR . 'inc/template-tags.php';

require_once KANGA_THEME_DIR . 'inc/widgets.php';
require_once KANGA_THEME_DIR . 'inc/core/theme-hooks.php';
require_once KANGA_THEME_DIR . 'inc/admin-functions.php';
require_once KANGA_THEME_DIR . 'inc/core/sidebar-manager.php';

/**
 * Markup Functions
 */
require_once KANGA_THEME_DIR . 'inc/extras.php';
require_once KANGA_THEME_DIR . 'inc/blog/blog-config.php';
require_once KANGA_THEME_DIR . 'inc/blog/blog.php';
require_once KANGA_THEME_DIR . 'inc/blog/single-blog.php';
/**
 * Markup Files
 */
require_once KANGA_THEME_DIR . 'inc/template-parts.php';
require_once KANGA_THEME_DIR . 'inc/class-kanga-loop.php';
require_once KANGA_THEME_DIR . 'inc/class-kanga-mobile-header.php';

/**
 * Functions and definitions.
 */
require_once KANGA_THEME_DIR . 'inc/class-kanga-after-setup-theme.php';

// Required files.
require_once KANGA_THEME_DIR . 'inc/core/class-kanga-admin-helper.php';

require_once KANGA_THEME_DIR . 'inc/schema/class-kanga-schema.php';

if ( is_admin() ) {

	/**
	 * Admin Menu Settings
	 */
	require_once KANGA_THEME_DIR . 'inc/core/class-kanga-admin-settings.php';
	require_once KANGA_THEME_DIR . 'inc/lib/notices/class-kanga-notices.php';

	/**
	 * Metabox additions.
	 */
	require_once KANGA_THEME_DIR . 'inc/metabox/class-kanga-meta-boxes.php';
}

// BSF Analytics library.
require_once KANGA_THEME_DIR . 'admin/bsf-analytics/class-bsf-analytics.php';

require_once KANGA_THEME_DIR . 'inc/metabox/class-kanga-meta-box-operations.php';


/**
 * Customizer additions.
 */
require_once KANGA_THEME_DIR . 'inc/customizer/class-kanga-customizer.php';


// /**
//  * Compatibility
//  */
// require_once KANGA_THEME_DIR . 'inc/compatibility/class-kanga-jetpack.php';
// require_once KANGA_THEME_DIR . 'inc/compatibility/woocommerce/class-kanga-woocommerce.php';
// require_once KANGA_THEME_DIR . 'inc/compatibility/edd/class-kanga-edd.php';
// require_once KANGA_THEME_DIR . 'inc/compatibility/lifterlms/class-kanga-lifterlms.php';
// require_once KANGA_THEME_DIR . 'inc/compatibility/learndash/class-kanga-learndash.php';
// require_once KANGA_THEME_DIR . 'inc/compatibility/class-kanga-beaver-builder.php';
// require_once KANGA_THEME_DIR . 'inc/compatibility/class-kanga-bb-ultimate-addon.php';
// require_once KANGA_THEME_DIR . 'inc/compatibility/class-kanga-contact-form-7.php';
// require_once KANGA_THEME_DIR . 'inc/compatibility/class-kanga-visual-composer.php';
// require_once KANGA_THEME_DIR . 'inc/compatibility/class-kanga-site-origin.php';
// require_once KANGA_THEME_DIR . 'inc/compatibility/class-kanga-gravity-forms.php';
// require_once KANGA_THEME_DIR . 'inc/compatibility/class-kanga-bne-flyout.php';
// require_once KANGA_THEME_DIR . 'inc/compatibility/class-kanga-ubermeu.php';
// require_once KANGA_THEME_DIR . 'inc/compatibility/class-kanga-divi-builder.php';
// require_once KANGA_THEME_DIR . 'inc/compatibility/class-kanga-amp.php';
// require_once KANGA_THEME_DIR . 'inc/compatibility/class-kanga-yoast-seo.php';
require_once KANGA_THEME_DIR . 'inc/addons/transparent-header/class-kanga-ext-transparent-header.php';
require_once KANGA_THEME_DIR . 'inc/addons/breadcrumbs/class-kanga-breadcrumbs.php';
require_once KANGA_THEME_DIR . 'inc/addons/heading-colors/class-kanga-heading-colors.php';
require_once KANGA_THEME_DIR . 'inc/class-kanga-filesystem.php';

// // Elementor Compatibility requires PHP 5.4 for namespaces.
// if ( version_compare( PHP_VERSION, '5.4', '>=' ) ) {
// 	require_once KANGA_THEME_DIR . 'inc/compatibility/class-kanga-elementor.php';
// 	require_once KANGA_THEME_DIR . 'inc/compatibility/class-kanga-elementor-pro.php';
// }

// // Beaver Themer compatibility requires PHP 5.3 for anonymus functions.
// if ( version_compare( PHP_VERSION, '5.3', '>=' ) ) {
// 	require_once KANGA_THEME_DIR . 'inc/compatibility/class-kanga-beaver-themer.php';
// }

/**
 * Load deprecated functions
 */
require_once KANGA_THEME_DIR . 'inc/core/deprecated/deprecated-filters.php';
require_once KANGA_THEME_DIR . 'inc/core/deprecated/deprecated-hooks.php';
require_once KANGA_THEME_DIR . 'inc/core/deprecated/deprecated-functions.php';
