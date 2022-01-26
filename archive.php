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

		<div class="page-content">

			<div class="entry-content">

				<?php 
				the_archive_title( '<h2 class="page-title"><span>', '</span></h2>' );
				?>

				<div class="grid-x grid-margin-x small-up-1">
					<?php
					$postCount = 1;
					while ( have_posts() ) :
						the_post();
						?>
							<div class="cell">
								<?php get_template_part( 'template-parts/archive', get_post_type(), array( 
								'post_count' => $postCount++) ); ?>
							</div>
						<?php
					endwhile;
					?>
				</div>
				<?php get_template_part( 'template-parts/archive', 'nav' ); ?>

			</div>
		</div>
	</div>

</main><!-- #main -->

<?php  get_template_part( 'template-parts/reveal-video-modal', get_post_type() ); ?>

<?php
get_footer();
