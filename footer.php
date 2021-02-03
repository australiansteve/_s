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
					<div class="cell medium-3 text-center medium-text-left">
						<div id="social-menu">
							<?php
							if (has_nav_menu( 'social-menu' )):
								wp_nav_menu(
									array(
										'theme_location'	=> 'social-menu',
										'menu_id'		=> 'social-menu',
										'menu_class'	=> 'horizontal menu text-center medium-text-left',
										'container'		=> false
									)
								);
							endif;
							?>
						</div>
					</div>
					<div class="cell text-center medium-6">
						<?php 
						$image = get_field('footer_logo', 'options');
						$size = 'full';
						
						if( $image ) {
							?>
							<div id="footer-logo">
								<?php echo wp_get_attachment_image( $image, $size ); ?>
							</div>
							<?php
						}
						?>
						<?php
						$menuLocation = has_nav_menu( 'footer-menu' ) ? 'footer-menu' : 'primary-menu';
						
						wp_nav_menu(
							array(
								'theme_location'	=> $menuLocation,
								'menu_id'		=> 'footer-menu',
								'menu_class'	=> 'vertical medium-horizontal menu text-center',
								'container'		=> false
							)
						);

						?>
					</div>
					<div class="cell medium-3 text-center medium-text-right">
						<div id="back-to-top">
							<a href="#" class="back-to-top">
								<i class="fas fa-2x fa-arrow-circle-up"></i>
							</a>
						</div>
						<script type="text/javascript">
							jQuery(".back-to-top").on('click', function() {
								jQuery('html,body').animate({scrollTop:0},1000);
							});
						</script>
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
