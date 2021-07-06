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
						<article>
							<?php the_title('<h2 class="page-title"><span>', '</span></h2>');?>  
							<?php get_template_part( 'template-parts/excerpt', get_post_type() ); ?>
							<?php the_field('project-description'); ?>
						</article>
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
