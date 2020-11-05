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

		</div><!-- #page -->

		<footer id="colophon" class="site-footer">

			<div class="grid-x">

				<div class="cell small-12">
					<?php the_field('footer_center', 'option'); ?>
				</div>

			</div><!-- .column.row -->

			<div class="grid-x">

				<div class="cell">
					<?php
					$image = get_field('banner_image', 'option');
					$size = 'full';

					if( $image ) {

						echo wp_get_attachment_image($image, $size); 
						
					}
					?>
				</div>
			</div> 

		</footer><!-- #colophon -->

		<?php wp_footer(); ?>

	</body>
</html>
