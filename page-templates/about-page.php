<?php
/**
 * Template Name: About Page
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

		$contentBackgroundColour = get_field('page_content_background_color');
		?>

		<div class="page-content" style="background-color: <?php echo $contentBackgroundColour;?>;">

			<?php
			get_template_part( 'template-parts/section-landing' );
			?>

			<div class="grid-container">

				<?php get_template_part( 'template-parts/about-page', 'menu' ); ?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>

			</div>

		</div>

		<?php
	endwhile;
	?>

</main><!-- #main -->

<?php
get_footer();
