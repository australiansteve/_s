<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php hamburger_cat_post_thumbnail(); ?>

	<div class="entry-content">

		<?php 

		$allFields = get_fields();

		foreach($allFields as $sectionId => $section) {
			if (array_key_exists('is_page_section', $section)) {
				$contentTextColor = $section['content_text_color'];
				$backgroundColor = $section['background_color'];
				$backgroundImage = $section['background_image'];
				$backgroundImageUrl = wp_get_attachment_image_src($backgroundImage, 'full');
				$backgroundCssValue = array();
				$backgroundClasses = $section['background_classes'];
				$sectionClasses = $section['section_classes'];
				$sectionHAlignment = $section['section_horizontal_alignment'];
				$sectionVAlignment = $section['section_vertical_alignment'];
				$sectionHeight = $section['section_height'];

				include( locate_template( 'template-parts/section-header.php', false, false ) ); 

				the_content();

				include( locate_template( 'template-parts/section-footer.php', false, false ) ); 

			}
		}
		?>

	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'hamburger-cat' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
