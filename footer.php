<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hamburger_Cat
 */

?>

		
		<footer id="colophon" class="site-footer">

			<div class="grid-x grid-margin-x">

				<div class="cell small-12 medium-4 footer-left text-center medium-text-left">
					<?php the_field('footer_left', 'option'); ?>
				</div>

				<div class="cell small-12 medium-4 footer-left text-center">
					<?php the_field('footer_center', 'option'); ?>
				</div>

				<div class="cell small-12 medium-4 footer-left text-center medium-text-right">
					<?php the_field('footer_right', 'option'); ?>
				</div>

			</div><!-- .column.row -->

		</footer><!-- #colophon -->
	</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
