<?php
/**
 * Template part for displaying projects on archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<a href="<?php echo the_permalink();?>"><h1 class="page-title"><?php the_title();?></h1></a>
		
</article><!-- #post-<?php the_ID(); ?> -->
