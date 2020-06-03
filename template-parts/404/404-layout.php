<?php
/**
 * Template for 404
 *
 * @package     Kanga
 * @author      Kanga
 * @copyright   Copyright (c) 2020, Kanga
 * @link        https://wpkanga.com/
 * @since       Kanga 1.0.0
 */

?>
<div class="ast-404-layout-1">

	<?php kanga_the_title( '<header class="page-header"><h1 class="page-title">', '</h1></header><!-- .page-header -->' ); ?>

	<div class="page-content">

		<div class="page-sub-title">
			<?php echo esc_html( kanga_default_strings( 'string-404-sub-title', false ) ); ?>
		</div>

		<div class="ast-404-search">
			<?php the_widget( 'WP_Widget_Search' ); ?>
		</div>

	</div><!-- .page-content -->
</div>
