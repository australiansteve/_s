<?php
/**
 * Template Name: Contact Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			if (has_post_thumbnail($post)) :
				the_post_thumbnail( 'hero-image' );
			endif;
		?>

		<div class="grid-container">
			<div class="page-content">
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				<div class="custom-content">
					<?php the_title('<h2 class="page-title"><span>', '</span></h2>');?>  
					<div class="grid-x" id="custom-content-1">
						<div class="cell medium-6">
							<div class="container contact_form_id">
								<?php 
								$formId = get_field('contact_form_id');
								if( $formId ) {
									echo do_shortcode("[ninja_forms id='".$formId."']");
								}
								?>
							</div>
						</div>
						<div class="cell medium-6">
							<div class="grid-y grid-padding-x" style="height: 100%">
								<div class="cell">
									<div class="container text_1">
										<div class="inner-container">
											<?php the_field("text_1"); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
