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
			<div class="grid-x">
				<div class="medium-10 large-9 xlarge-8">
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

	<div class="yarn-bling yarn-bling-1"></div>
	<div class="yarn-bling yarn-bling-2"></div>
	<div class="yarn-bling yarn-bling-3"></div>
	<div class="yarn-bling yarn-bling-4"></div>
	<div class="yarn-bling yarn-bling-5"></div>
	<div class="yarn-bling yarn-bling-6"></div>

</main><!-- #main -->

<?php
get_footer();
