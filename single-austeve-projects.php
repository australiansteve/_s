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

			get_template_part( 'template-parts/hero-image', get_post_type() );

			?>

			<div class="grid-container">
				<div class="page-content">
					<div class="entry-content">
						<?php the_title('<h2 class="page-title"><span>', '</span></h2>');?>  
						<?php the_content(); ?>
						<?php get_template_part( 'template-parts/breadcrumbs', get_post_type() ); ?>
					</div>
				</div> 
			</div>

			<?php 
			$acknowledgements = get_field('acknowledgements');
			if($acknowledgements){
			?>
				<div class="grid-container">
					<div class="page-content" id="acknowledgements">
						<div class="entry-content">
							<div class="grid-x">
								<div class="cell text-center">
									<?php echo $acknowledgements['text']; ?>  
								</div>
							</div>
							<div class="grid-x grid-padding-x grid-padding-y align-middle align-center small-up-2 medium-up-3">
								<?php 
								foreach( $acknowledgements['organizations'] as $org ): ?>
									<div class="cell text-center">
										<?php echo $org['link'] == '' ? '' : '<a href="'.$org['link'].'" target="blank">'; ?>
										<?php echo wp_get_attachment_image( $org['logo'], 'full' ); ?>
										<?php echo $org['link'] == '' ? '' : '</a>'; ?>

									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div> 
				</div>
			<?php

			}

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
