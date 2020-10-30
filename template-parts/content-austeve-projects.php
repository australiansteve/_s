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
		<div class="image-gallery">
			<div class="hide-overflow">
				<table>
					<tbody style="border:none">
						<tr id="project-scroll">
							<?php 
							$images = get_field('images');
							$size = 'full';
							if( $images ): ?>
								<?php foreach( $images as $image_id ): ?>
									<td class="project">
										<?php echo wp_get_attachment_image( $image_id, $size ); ?>
									</td>
								<?php endforeach; ?>
							<?php endif; ?>
						</tr>
						<div class="project-nav next"><i class="fas fa-2x fa-chevron-circle-right"></i></div><div class="project-nav previous"><i class="fas fa-2x fa-chevron-circle-left"></i></div>
					</tbody>
				</table>
			</div>
		</div>

		<?php get_template_part( 'template-parts/javascript-single', get_post_type() ); ?>	

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php hamburger_cat_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
