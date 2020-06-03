<?php
/**
 * The header for Kanga Theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kanga
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?><!DOCTYPE html>
<?php kanga_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php kanga_head_top(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">

<?php wp_head(); ?>
<?php kanga_head_bottom(); ?>
</head>

<body <?php kanga_schema_body(); ?> <?php body_class(); ?>>

<?php kanga_body_top(); ?>
<?php wp_body_open(); ?>
<div 
	<?php
	echo kanga_attr(
		'site',
		array(
			'id'    => 'page',
			'class' => 'hfeed site',
		)
	);
	?>
>
	<a class="skip-link screen-reader-text" href="#content"><?php echo esc_html( kanga_default_strings( 'string-header-skip-link', false ) ); ?></a>

	<?php kanga_header_before(); ?>

	<?php kanga_header(); ?>

	<?php kanga_header_after(); ?>

	<?php kanga_content_before(); ?>

	<div id="content" class="site-content">

		<div class="ast-container">

		<?php kanga_content_top(); ?>
