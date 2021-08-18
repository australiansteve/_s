<?php
/**
 * Template Name: Student Dashboard 
 * 
 * The template for displaying the student dashboard
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Hamburger_Cat
 */

acf_form_head();
get_header();
?>

	<main id="primary" class="site-main">

		<?php

		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/hero-image', get_post_type() );

			?>

			<div class="grid-container">
				<div class="page-content">
					<?php the_title('<h2 class="page-title"><span>', '</span></h2>');?>  
					<div class="entry-content">
						<?php the_content(); ?>

						<?php acf_form(array(
							'post_id'       => 'user_'.get_current_user_id(),
							'field_groups' => array(507),
							'form' => true,
							'submit_value'  => __('Add Goal')
						)); ?>

					</div>

					<div id="my-goals">
						<?php 
						acf_form(array(
							'post_id'       => 'user_'.get_current_user_id(),
							'field_groups' => array(501),
							'form' => true,
							'submit_value'  => __('Update Goals')
						));
						?>
					</div>
				</div> 
			</div>

			<?php

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
