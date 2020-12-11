<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

get_header();
?>


<main id="primary" class="site-main">

	<?php if ( have_posts() ) { ?>

		<?php
		$sectionId = 'other_landing';
		$section = get_field($sectionId, 'options');
		if ($section) {
			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			?>
			<header class="page-header">
				<h1 class="page-title"><?php
				echo get_the_title( get_option('page_for_posts') );
				?></h1>
			</header><!-- .page-header -->
			<?php
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
		}


		$sectionId = 'other_body';
		$section = get_field($sectionId, 'options');
		if ($section) {
			include( locate_template( 'template-parts/section-header.php', false, false ) ); 

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				echo get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
		}

	}
	else {

		get_template_part( 'template-parts/content', 'none' );

	}
	?>

</main><!-- #main -->

<?php
get_footer();
