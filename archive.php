<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	get_template_part( 'template-parts/hero-image', get_post_type() );
	?>

	<div class="grid-container">
		
		<div class="page-content">

			<div class="entry-content">
				<?php
				the_archive_title( '<h2 class="page-title">', '</h2>' );
				get_template_part( 'template-parts/archive-description', get_post_type() ); 
				?>
			</div>

			<?php
			if (have_posts()) :

				get_template_part( 'template-parts/archive-tabs', get_post_type() );
				?>

				<div class="grid-x grid-padding-x small-up-1 medium-up-2 large-up-3">

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
			endif;
			?>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
