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
		<?php 
		$image = get_field('image');
		$size = 'full'; // (thumbnail, medium, large, full or custom size)
		?>
		<div class="image">
			<?php
			if( $image ) {

				echo wp_get_attachment_image( $image, $size );
				
			}
			else {
				the_post_thumbnail('full');
			}
			?>
		</div>
						
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php hamburger_cat_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
