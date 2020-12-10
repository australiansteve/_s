<?php
/**
 * The template for displaying the blog page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	$sectionId = 'blog_landing';
	$section = get_field($sectionId, 'options');
	if ($section) {
		$blogPageId = get_option('page_for_posts');

		include( locate_template( 'template-parts/section-header.php', false, false ) ); 

		?>
		<h1 class="page-title"><?php echo get_the_title($blogPageId);?></h1>
		<?php

		if ( have_posts() ) {
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/archive', get_post_type() );

			endwhile;

			include( locate_template( 'template-parts/archive-nav.php', false, false ) ); 
		}
		else {

			get_template_part( 'template-parts/content', 'none' );

		}

		include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
	}
	?>

</main><!-- #main -->

<?php
get_footer();
