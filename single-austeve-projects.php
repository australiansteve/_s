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

		$sectionId = 'project_landing';
		$section = get_field($sectionId, 'option');
		if ($section) {
			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			?>	
			<div class="grid-container">
				<div class="white-content-container">
					<div class="grid-x">
						<div class="cell">

							<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
							<?php get_template_part( 'template-parts/nav', get_post_type() ); ?>		

						</div>
					</div>
				</div>
			</div>
			<?php
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 

		}

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	<?php
	get_footer();
