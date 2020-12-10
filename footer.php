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
			<div class="grid-container">
				<div class="grid-x footer-logo">
					<div class="cell text-center">
						<?php 
						$image = get_field('footer_logo', 'options');
						$size = 'full';
						
						if( $image ) {
							echo wp_get_attachment_image( $image, $size );
						}
						?>
					</div>
				</div><!-- .site-info -->
				<div class="grid-x site-info">
					<div class="cell text-center medium-text-right">
						<?php the_field('footer_site_info_text', 'options'); ?>
					</div>
				</div><!-- .site-info -->
			</div>
		</footer><!-- #colophon -->
	</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
