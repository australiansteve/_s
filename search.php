<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

get_header();
?>

<main id="primary" class="site-main">

	<div class="grid-container">
		<div class="page-content text-center">

			<h2 class="page-title">
				<?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Search results for: %s', 'hamburger-cat' ), get_search_query() );
				?>
			</h2>

			<?php
			if (have_posts()) :
				?>
				<div class="grid-x grid-padding-x small-up-1 medium-up-2 xlarge-up-3">
					<?php
					while ( have_posts() ) :
						the_post();
						?>

						<div class="cell">
							<?php get_template_part( 'template-parts/archive', get_post_type() ); ?>
						</div>


						<?php
					endwhile; 
					?>

				</div>
				<?php

				include( locate_template( 'template-parts/archive-nav.php', false, false ) ); 

			else :
				?>
				<div class="entry-content">
					No search results
				</div>
				<?php
			endif;
			?>

		</div>

	</div>

</main><!-- #main -->

<?php
get_footer();
