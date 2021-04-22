<?php
/***
  * Template Name: Give Page
  */

get_header(); ?>

<main id="main" class="site-main" role="main">
	<div class="page-content">
		<div class="grid-container">
			<div class="entry-content">

				<div class="grid-x" id="give-page">

					<?php while ( have_posts() ) : the_post(); ?>

						<div class="cell small-12" id="page-title">
							<h1><?php the_title(); ?></h1>
						</div>

						<div class="cell small-12" id="page-content">
							<?php the_content(); ?>
						</div>

						<?php get_template_part('template-parts/austeve-give-page', 'common'); ?>

						<?php 
						if( have_rows('reasons_to_give') ):
							?>
							<div class="cell small-12" id="reasons">

								<div class="container">
									<h2>Reasons to Give</h2>
									<?php
									$reasonNum = 0;
									?>
									<div class="grid-x grid-padding-x small-up-2 medium-up-5">
										<?php
										while ( have_rows('reasons_to_give') ) : the_row();

											get_template_part('template-parts/austeve-give-reason');

											$reasonNum++;

											if ($reasonNum % 2 == 0 || $reasonNum == count(get_field('reasons_to_give')))
											{
												echo "<div class='reason-display small-12 hide-for-medium'></div>";
											}
											if ($reasonNum % 5 == 0 || $reasonNum == count(get_field('reasons_to_give')))
											{
												echo "<div class='reason-display small-12 show-for-medium'></div>";
											}
										endwhile;
										?>
									</div>
								</div>
							</div>			
							<?php
						endif;
						?>

					<?php endwhile; // End of the loop. ?>

				</div>

			</div>
		</div>
	</div>
</main><!-- #main -->

<?php get_footer(); ?>