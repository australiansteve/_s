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


				<?php
				$sectionId = 'footer';
				$section = get_field($sectionId, 'option');
				if ($section) {
					error_log("Footer section: ".print_r($section, true));
					include( locate_template( 'template-parts/section-header.php', false, false ) ); 
					?>	
					<div class="grid-container">
						<div class="grid-x">
							<div class="cell">
								<a href="<?php echo home_url();?>">
									<?php 
									$image = $section['logo'];
									$size = 'rect-small'; 

									if( $image ) {
										echo wp_get_attachment_image( $image, $size );
									}
									?>
								</a>
							</div>
						</div>
						<div class="grid-x">
							<div class="cell">
								<?php 
								echo $section['text'];
								?>
								
								<ul class="social-menu">
									<?php
									wp_nav_menu(
										array(
											'theme_location'	=> 'menu-2',
											'container'		=> false,
											'items_wrap' => '%3$s'
										)
									);
									?>
								</ul>
							</div>
						</div>
					</div>
					<?php
					include( locate_template( 'template-parts/section-footer.php', false, false ) ); 

				}
				?>
			</footer><!-- #colophon -->
		</div><!-- #page -->

	<?php wp_footer(); ?>

	</body>
</html>
