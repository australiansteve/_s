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

	<div class="grid-container">

		<div class="page-content text-center">

			<div class="entry-content">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				?>

				<div class="grid-x grid-padding-x small-up-1 archive-grid-<?php echo get_queried_object()->name; ?>" >
					<?php
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							?>

							<div class="cell">
								<?php get_template_part( 'template-parts/archive', get_post_type() ); ?>
							</div>

							<?php
						endwhile;
					else :?>

						<div class="cell">
							<?php get_template_part( 'template-parts/empty-archive', get_queried_object()->name ); ?>
						</div>
						<?php
					endif;
					?>
				</div>

				<div>
					
					<div class="after-archive">
						<?php get_template_part( 'template-parts/after-archive', get_queried_object()->name ); ?>
					</div>

				</div>
				<?php get_template_part( 'template-parts/archive', 'nav' ); ?>
			</div>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
