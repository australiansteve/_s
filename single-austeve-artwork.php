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
			<div class="grid-x">
				<div class="cell">
					<div class="page-content">
						<div class="entry-content">
							<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
						</div>
					</div>
				</div>
			</div> 
		</div>

		<?php

	endwhile;
	?>

	<div class="yarn-bling yarn-bling-3"></div>

</main><!-- #main -->

<?php
get_footer();
