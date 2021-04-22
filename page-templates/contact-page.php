<?php
/***
  * Template Name: Contact Page
  */

get_header(); 

?>

<main id="main" class="site-main" role="main">
	<div class="page-content">
		<div class="grid-container">
			<div class="entry-content">

				<div class="grid-x" id="contact-page">

					<?php while ( have_posts() ) : the_post(); ?>

						<div class="cell small-12" id="page-title">
							<h2><span><?php the_title(); ?></span></h2>
						</div>

						<div class="cell small-12" id="page-content">

							<div class="grid-x">

								<div class="cell small-12 medium-4" id="page-content">
									<?php the_content(); ?>
								</div>

								<div class="cell small-12 medium-8" id="feature-image">
									<?php the_post_thumbnail('feature-pic-size'); ?>
								</div>

							</div>

							<div class="grid-x">

								<div class="cell small-12 medium-4" id="contact-form-into">
									<b><?php the_field('contact_form_intro');?></b>
								</div>

								<div class="cell small-12 medium-8" id="contact-form">
									<div class="container">
										<?php echo do_shortcode("[ninja_form id='".get_field('contact_form_id')."']"); ?>
									</div>
								</div>

							</div>

						</div>

					<?php endwhile; // End of the loop. ?>

				</div>

			</div>
		</div>
	</div>
</main><!-- #main -->

<?php get_footer(); ?>