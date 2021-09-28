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
	
	<?php the_title('<h1 class="page-title">', '</h1>');?>  

	<div class="meta-date"><p><?php echo get_the_date()?></p></div>

	<?php the_content(); ?>

	<?php get_template_part( 'template-parts/breadcrumbs', get_post_type() ); ?>
	
</article><!-- #post-<?php the_ID(); ?> -->


