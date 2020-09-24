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
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php hamburger_cat_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'hamburger-cat' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php 

	$allFields = get_fields();
	//error_log("Post fields: ".print_r($allFields, true));
	
	foreach($allFields as $sectionId => $section) {
		if (array_key_exists('is_page_section', $section)) {
			$contentHtml = $section['content_html'];
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

			echo $contentHtml;

			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
			
		}
	}
	?>
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
