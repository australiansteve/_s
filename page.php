<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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

			get_template_part( 'template-parts/hero-image', get_post_type() );
		?>

		<div class="grid-container">
			<div class="page-content">
				<?php the_title('<h2 class="page-title"><span>', '</span></h2>');?>  
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>

		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
