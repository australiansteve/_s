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

			if (has_post_thumbnail($post)) :
				the_post_thumbnail( 'hero-image' );
			endif;

			?>

			<div class="grid-container">
				<div class="page-content">
					<?php the_title('<h2 class="page-title"><span>', '</span></h2>');?>  
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
