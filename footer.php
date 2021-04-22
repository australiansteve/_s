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
			<div class="grid-container">
				<div class="grid-x" id="footer">

					<div class="cell small-12 medium-4 left-column">

						<div class="container">
							<strong>Street address</strong>
							<p class="street-address">
								<?php the_field('street_address', 'option'); ?>
							</p>
						</div>

						<div class="container">
							<strong>Mailing address</strong>
							<p class="mailing-address">
								<?php the_field('mailing_address', 'option'); ?>
							</p>
						</div>

					</div>

					<div class="cell small-12 medium-4 center-column">

						<div class="container">
							<strong>Contact</strong>
							<p class="contact">
								<?php the_field('contact', 'option'); ?>
							</p>
						</div>

						<?php 
						if( have_rows('page_links', 'option') ):
							?>
							<div class="container page-links">
								<?php
								while ( have_rows('page_links', 'option') ) : the_row();
									$post_id = get_sub_field('page', false, false);

									if( $post_id ): 
										?>
										<p><a href="<?php echo get_the_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></p>
										<?php 	
									endif; 
								endwhile;
								?>
							</div>
							<?php
						endif;
						?>

						<div class="container">

							<div class="find-us-on">
								<strong>
									<?php 
									$findUsOn = get_field('find_us_on', 'option'); 
									if( have_rows('find_us_on', 'option') ):

										while ( have_rows('find_us_on', 'option') ) : the_row();

											echo "<p>";
											$url = get_sub_field('footer_find_us_link', 'option');

											if ($url):
												echo "<a href='".$url."' target='blank'>";
											endif;

											if( have_rows('footer_find_us_logo', 'option') ):

												while ( have_rows('footer_find_us_logo', 'option') ) : the_row();

													if( get_row_layout() == 'html' ):

														the_sub_field('html');

													elseif( get_row_layout() == 'image' ): 

														error_log("Need to output images here");

													endif;

												endwhile;

											endif;

											if (get_sub_field('footer_find_us_text', 'option')) :

												the_sub_field('footer_find_us_text', 'option');

											endif;

											if ($url):
												echo "</a>";
											endif;

											echo "</p>";

										endwhile;

									else :

							    // no rows found

									endif;

									?>
								</strong>
							</div>

						</div>
					</div>


					<div class="cell small-12 medium-4 right-column">

						<div class="container">
							<strong>A member of</strong>
							<p class="a-member-of">
								<?php
								if( have_rows('a_member_of', 'option') ):

									while ( have_rows('a_member_of', 'option') ) : the_row();

										$image = get_sub_field('image', 'option');

										if( !empty($image) ): 
											$linkTo = get_sub_field('link_to', 'option');
											if (!empty($linkTo)) :
												echo "<a href='".$linkTo."' target='blank'>";
											endif;
											?>
											<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
											<?php 
											if (!empty($linkTo)) :
												echo "</a>";
											endif;
										endif; 
										?>
										<?php
									endwhile;
								endif;
								?>
							</p>
						</div>

					</div>
				</div><!-- .grid-x -->


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

		<?php
		$customJS = get_field('custom_js', 'option');

		if( have_rows('custom_js', 'option') ):
			while( have_rows('custom_js', 'option') ) : the_row();
				error_log("custom_js");

		        // Loop over sub repeater rows.
				if( have_rows('js_script') ):
					while( have_rows('js_script') ) : the_row();

		                // Get sub values.
						$name = get_sub_field('name');
						$script = get_sub_field('script');
						$location = get_sub_field('display_in');

						if ($location == 'footer') {
							echo $script;
						}

					endwhile;
				endif;
			endwhile;
		endif;

		?>

	<?php wp_footer(); ?>

	</body>
</html>
