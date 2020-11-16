<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Hamburger_Cat
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php

	while ( have_posts() ) :
		the_post();

		$sectionId = 'landing';
		$section = get_field($sectionId);
		if ($section) {
			include( locate_template( 'template-parts/section-header.php', false, false ) ); 

			get_template_part( 'template-parts/content', get_post_type() );
			
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
		}

	endwhile;
	?>

</main><!-- #main -->

<?php
get_footer();
