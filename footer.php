<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kanga
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
			<?php kanga_content_bottom(); ?>

			</div> <!-- ast-container -->

		</div><!-- #content -->

		<?php kanga_content_after(); ?>

		<?php kanga_footer_before(); ?>

		<?php kanga_footer(); ?>

		<?php kanga_footer_after(); ?>

	</div><!-- #page -->

	<?php kanga_body_bottom(); ?>

	<?php wp_footer(); ?>

	</body>
</html>
