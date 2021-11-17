<?php
/**
 * Template part for displaying page content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<h1 class="page-title"><?php the_title();?></h1>
		
	<?php the_content();?>

</article><!-- #post-<?php the_ID(); ?> -->