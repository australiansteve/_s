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
					<div class="cell medium-3 text-center medium-text-left" id="footer-column-1">
						<div id="social-menu">
							<?php
							if (has_nav_menu( 'social-menu' )):
								wp_nav_menu(
									array(
										'theme_location'	=> 'social-menu',
										'menu_id'		=> 'social-menu-footer',
										'menu_class'	=> 'horizontal menu text-center medium-text-left',
										'container'		=> false
									)
								);
							endif;
							?>
						</div>
					</div>
					<div class="cell text-center medium-6" id="footer-column-2">
						<?php 
						$image = get_field('footer_logo', 'options');
						$size = 'footer-logo';
						
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
					<div class="cell medium-3 text-center medium-text-right" id="footer-column-3">
						<div id="language-menu">
							<?php
							if (has_nav_menu( 'language-menu' )):
								wp_nav_menu(
									array(
										'theme_location'	=> 'language-menu',
										'menu_id'		=> 'language-menu-footer',
										'menu_class'	=> 'horizontal menu text-center medium-text-right',
										'container'		=> false
									)
								);
							endif;
							?>
						</div>
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
