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

	<?php get_template_part( 'template-parts/hero-image-archive', get_post_type() ); ?>

	<div class="grid-container">
		
		<div class="page-content">

			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			?>

			<div class="grid-x grid-margin-x small-up-1 medium-up-2" id="archive-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					?>

					<div class="cell">
						<?php get_template_part( 'template-parts/archive', get_post_type() ); ?>
					</div>

					<?php
				endwhile;

				$nav_type = get_field('archive_navigation_type', 'option');
				if ($nav_type == 'infinite-scroll'):
					echo '<span class="next-page" data-page="2"/>';
				endif;
				?>
			</div>

			<?php get_template_part( 'template-parts/archive', 'nav' ); ?>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
