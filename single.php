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

			$contentBackgroundColour = get_field('page_content_background_color');
		?>

			<div class="page-content" style="background-color: <?php echo $contentBackgroundColour;?>;">
				
				<?php
				get_template_part( 'template-parts/section-landing' );
				?>

				<div class="grid-container">
					<div class="entry-content">
						<?php the_content(); ?>

						<?php get_template_part( 'template-parts/breadcrumbs', get_post_type() ); ?>
					</div>
				</div>

			</div>

		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
