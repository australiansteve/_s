<?php
/**
 * Template part for displaying posts in archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

?>

<div class="cell medium-6">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<a class="link" href="<?php the_permalink();?>">
			<div class="image">
				<?php
				if (has_post_thumbnail()):
					echo the_post_thumbnail('square-large');
				else :
					echo wp_get_attachment_image( get_field('general_image', 'option'), 'square-large' );;
				endif;
				?>
			</div>
			<div class="title text-center">
				<?php the_title();?>
			</div>
		</a>
	</article><!-- #post-<?php the_ID(); ?> -->
</div>
