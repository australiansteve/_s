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

	<div class="page-content">

		<div class="grid-container">

			<div class="entry-content">
				<?php
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</div>

			<?php
			the_archive_title( '<h2 class="page-title"><span>', '</span></h2>' );
			?>

			<div class="grid-x">
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

			<?php get_template_part( 'template-parts/archive', 'nav' ); ?>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
