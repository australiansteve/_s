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
			<div class="grid-x">

				<div class="cell medium-3 text-center medium-text-left footer-logo">

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

				</div>
				<div class="cell text-center medium-6 site-info">
					<div class="grid-y align-center" style="height: 100px">
						<div class="cell">
							<?php the_field('footer_site_info_text', 'options'); ?>
						</div>
					</div>

				</div>
				<div class="cell medium-3 text-center medium-text-right copyright">
					<div class="grid-y align-right" style="height: 100px">
						<div class="cell">
							<a href="https://weavercrawford.com" target="_blank" rel="noopener"><i class="far fa-copyright"></i> Weaver Crawford Creative <script>document.write(new Date().getFullYear())</script></a>
						</div>
					</div>
				</div>

			</div>
		</footer><!-- #colophon -->
	</div><!-- #page -->

<?php
$customJS = get_field('custom_js', 'option');

if( have_rows('custom_js', 'option') ):
    while( have_rows('custom_js', 'option') ) : the_row();

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
