<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		?>
		<div class="position"><?php the_field('position'); ?></div>
		
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'hamburger-cat' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		?>
		<div class="image-gallery-container">
			<div class="grid-x grid-margin-x small-up-2 align-center" id="image-gallery">
				<?php 
				$images = get_field('images');
				$size = 'square-large';
				$imageCounter = 1;
				if( $images ): ?>
					<?php foreach( $images as $image_id ): ?>
						<div class="cell project">
							<div class="container" href="#" data-open="imageModal" title="<?php echo get_post($image_id)->post_excerpt;?>" data-imageid="<?php echo $image_id;?>" data-fullimage="<?php echo wp_get_attachment_url($image_id);?>" data-imagecounter="<?php echo $imageCounter++;?>"><?php echo wp_get_attachment_image( $image_id, $size ); ?></div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>

			<div class="reveal" id="imageModal" data-reveal>
				<div class="grid-y align-center" style="height: 100%">
					<div class="cell text-center">
						<div class="container">
							<div class="image">
								<img src=""/>
							</div>
						</div>
					</div>
				</div>
				<button class="close-button" data-close aria-label="Close Accessible Modal" type="button">
					<span aria-hidden="true"><i class="fas fa-times"></i></span>
				</button>
				<button class="next-button modal-button" aria-label="Next image" type="button">
					<span aria-hidden="true"><i class="fas fa-2x fa-chevron-right"></i></span>
				</button>
				<button class="previous-button modal-button" aria-label="Previous image" type="button">
					<span aria-hidden="true"><i class="fas fa-2x fa-chevron-left"></i></span>
				</button>

			</div>

			<script type="text/javascript">

				function setNextPreviousButton(selector, imageNumber) {
					if (jQuery("#image-gallery .project:nth-of-type(" + imageNumber + ")").length) {
						jQuery(selector).attr('data-image', imageNumber);
						jQuery(selector).css('display', 'block');

					}
					else {
						jQuery(selector).css('display', 'none');
					}
				}

				jQuery(document).ready(function() {

					jQuery(document).on('click', '.modal-button', function(event) {
						var imageContainer = jQuery("#image-gallery .project:nth-of-type(" + this.dataset.image + ") .container");
						jQuery(imageContainer).trigger('click');
					});

					jQuery(document).on('click', '[data-open]', function(event) {
						jQuery("#imageModal img").attr('src', this.dataset.fullimage);

						var previousImage = parseInt(this.dataset.imagecounter, 10) - 1;
						setNextPreviousButton("#imageModal .previous-button", previousImage);

						var nextImage = parseInt(this.dataset.imagecounter, 10) + 1;
						setNextPreviousButton("#imageModal .next-button", nextImage);
					});
				});
			</script>
		</div>

		<?php get_template_part( 'template-parts/javascript-single', get_post_type() ); ?>	

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php hamburger_cat_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
