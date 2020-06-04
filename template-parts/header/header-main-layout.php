<?php
/**
 * Template for Primary Header
 *
 * The header layout 2 for Kanga Theme. ( No of sections - 1 [ Section 1 limit - 3 )
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Kanga
 * @author      Kanga
 * @copyright   Copyright (c) 2020, Kanga
 * @link        https://wpkanga.com/
 * @since       Kanga 1.0.0
 */

?>

<?php if( get_theme_mod( 'theme_header_bg' ) != '') { // if there is a background img
	$theme_header_bg = get_theme_mod('theme_header_bg');}
	?>

<div class="main-header-bar-wrap" style="background-image:url('<?php echo $theme_header_bg ?>');">
	<div <?php echo kanga_attr( 'main-header-bar' ); ?>>
		<?php kanga_main_header_bar_top(); ?>
		<div class="ast-container">

			<div class="ast-flex main-header-container">
				<?php kanga_masthead_content(); ?>

			</div><!-- Main Header Container -->
		</div><!-- ast-row -->
		<?php kanga_main_header_bar_bottom(); ?>
	</div> <!-- Main Header Bar -->
</div> <!-- Main Header Bar Wrap -->
