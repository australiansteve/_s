<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Hamburger_Cat
 */

get_header();
?>

<main id="primary" class="site-main">

		<?php
		$sectionId = 'other_landing';
		$section = get_field($sectionId, 'options');
		if ($section) {
			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			?>
			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'hamburger-cat' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->
			<?php
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
		}


		$sectionId = 'other_body';
		$section = get_field($sectionId, 'options');
		if ($section) {
			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			
	if ( have_posts() ) {

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();
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
