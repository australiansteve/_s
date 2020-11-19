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

		<div class="grid-x">
			<div class="cell medium-3">
				<div class="container">
					<div class="footer-title"><?php the_field('footer_1_title', 'options'); ?></div>
					<div id="footer-1-logos">
						<?php
						if( have_rows('footer_1_logos', 'options') ):

							while( have_rows('footer_1_logos', 'options') ) : the_row();

								?>
								<div class="partner-logo grid-x">
									<div class="cell shrink medium-12 large-shrink">
										<?php
										$image = get_sub_field('image');
										$size = 'footer-partner-logo';

										if( $image ) {
											echo wp_get_attachment_image( $image, $size );
										}
										?>
									</div>									
									<div class="cell auto medium-12 large-auto">
										<?php
										echo "<span>".get_sub_field('text')."</span>";
										?>
									</div>
								</div>
								<?php

							endwhile;

						endif;
						?>
					</div>
				</div>
			</div>
			<div class="cell medium-3">
				<div class="container">
					<div class="footer-title"><?php the_field('footer_2_title', 'options'); ?></div>
					<div id="footer-2">
						<?php the_field('footer_2_text', 'options'); ?>
					</div>
				</div>
			</div>
			<div class="cell medium-3">
				<div class="container">
					<div class="footer-title"><?php the_field('footer_3_title', 'options'); ?></div>
					<div id="footer-3">
						<?php the_field('footer_3_text', 'options'); ?>
					</div>
				</div>
			</div>
			<div class="cell medium-3">
				<div class="container">
					<div class="footer-title"><?php the_field('footer_4_title', 'options'); ?></div>
					<div id="footer-4">
						<?php 
						wp_nav_menu(
							array(
								'theme_location'	=> 'social-menu',
								'menu_id'		=> 'social-menu',
								'menu_class'	=> 'horizontal menu text-left',
								'container'		=> false
							)
						);
						$subscriptionFormId = get_field('footer_4_subscription_form_id', 'options');
						if ($subscriptionFormId) {
							echo do_shortcode("[ninja_form id='".$subscriptionFormId."']");
						}
						?>
					</div>
				</div>
			</div>
		</div><!-- .site-info -->

		<div class="grid-x site-info">
			<div class="cell text-center">
				<?php 
				$image = get_field('footer_logo', 'options');
				$size = 'footer-logo';
				
				if( $image ) {
					echo wp_get_attachment_image( $image, $size );
				}
				?>
				<div class="footer-menu">
					<?php 
					wp_nav_menu(
						array(
							'theme_location'	=> 'footer-menu',
							'menu_id'		=> 'footer-menu',
							'menu_class'	=> 'horizontal menu',
							'container'		=> false
						)
					);
					?>
				</div>
				<div class="legal">
					<i class="far fa-copyright"></i> Aquila <?php echo date("Y"); ?><br/>
					Site by: <a href="https://weavercrawford.com" target="_blank">Weaver Crawford Creative</a><br/>
					<span class="gray-text">This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy">Privacy Policy</a> and <a href="https://policies.google.com/terms">Terms of Service</a> apply.</span>
				</div>
			</div>
		</div><!-- .site-info -->
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
