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

	<h1 class="page-title"><?php the_title();?></h1>
		
		<?php the_content();?>

		<footer class="entry-footer">

			<?php get_template_part( 'template-parts/breadcrumbs', get_post_type() ); ?>

		</footer><!-- .entry-footer -->


</article><!-- #post-<?php the_ID(); ?> -->