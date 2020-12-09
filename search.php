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
		<div class="single-container">

			<h1 class="page-title">
				<?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Search Results for: %s', 'hamburger-cat' ), '<span>' . get_search_query() . '</span>' );
				?>
			</h1>
			<?php
			if ( have_posts() ) {
							get_search_form();

				?>
				<div id="post-grid" class="grid-x grid-margin-x small-up-1 medium-up-2 large-up-3 austeve-courses align-center" data-equalizer data-equalize-by-row="true">
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/archive' );

					endwhile;

					?>
				</div>
				<?php
				include( locate_template( 'template-parts/archive-nav.php', false, false ) ); 
			}
			else {

				get_template_part( 'template-parts/content', 'none' );

			}
			?>
		</div>
		<?php
		include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
	}

	
	?>

</main><!-- #main -->

<?php
get_footer();
