<?php
/**
 * Kanga Theme Customizer Controls.
 *
 * @package     Kanga
 * @author      Kanga
 * @copyright   Copyright (c) 2020, Kanga
 * @link        https://wpkanga.com/
 * @since       Kanga 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$control_dir = KANGA_THEME_DIR . 'inc/customizer/custom-controls';

require $control_dir . '/class-kanga-customizer-control-base.php';
require $control_dir . '/sortable/class-kanga-control-sortable.php';
require $control_dir . '/radio-image/class-kanga-control-radio-image.php';
require $control_dir . '/slider/class-kanga-control-slider.php';
require $control_dir . '/responsive-slider/class-kanga-control-responsive-slider.php';
require $control_dir . '/responsive/class-kanga-control-responsive.php';
require $control_dir . '/typography/class-kanga-control-typography.php';
require $control_dir . '/responsive-spacing/class-kanga-control-responsive-spacing.php';
require $control_dir . '/divider/class-kanga-control-divider.php';
require $control_dir . '/heading/class-kanga-control-heading.php';
require $control_dir . '/hidden/class-kanga-control-hidden.php';
require $control_dir . '/link/class-kanga-control-link.php';
require $control_dir . '/color/class-kanga-control-color.php';
require $control_dir . '/description/class-kanga-control-description.php';
require $control_dir . '/background/class-kanga-control-background.php';
require $control_dir . '/responsive-color/class-kanga-control-responsive-color.php';
require $control_dir . '/responsive-background/class-kanga-control-responsive-background.php';
require $control_dir . '/border/class-kanga-control-border.php';
require $control_dir . '/customizer-link/class-kanga-control-customizer-link.php';
require $control_dir . '/settings-group/class-kanga-control-settings-group.php';
require $control_dir . '/select/class-kanga-control-select.php';
