<?php
/**
 * The template for displaying the Programs archive
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
				$pageIntroduction =  get_field('page_introduction', 'term_'.get_queried_object()->term_id);
				if (!empty($pageIntroduction)) :
					?>
					<div id="page-introduction" class="text-center">
						<?php
						echo $pageIntroduction;
						?>
					</div>
					<?php
				endif;
				?>

				<div data-equalizer="wif-match" data-equalize-on="medium" data-equalize-by-row="true">

					<div id="sjle-programs-grid" class="grid-x grid-margin-x grid-margin-y small-up-1 medium-up-3 text-center align-center"data-equalizer="title-match" data-equalize-on="medium" data-equalize-by-row="true">

						<?php
						while ( have_posts() ) :
							the_post();
							?>

							<div class="cell">
								<?php get_template_part('template-parts/archive', get_post_type()); ?>
							</div>

							<?php
						endwhile;
						?>
					</div>
				</div>

				<?php get_template_part( 'template-parts/archive', 'nav' ); ?>

				<?php get_template_part( 'template-parts/sjle-programs', 'more-options' ); ?>
			</div>

		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
