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

while ( have_posts() ) :
	the_post();

	$pageBackground = get_field('custom_page_background') ? get_field('custom_page_background') : get_field('default_page_background', 'options');
	$contentBackground = get_field('custom_content_background') ? get_field('custom_content_background') : get_field('default_content_background', 'options');
	?>

	<main id="primary" class="site-main" style="background: <?php echo $pageBackground;?>">
		<?php
		get_template_part( 'template-parts/hero-image', get_post_type() );
		?>

		<div class="grid-container">
			<div class="page-content">
				<?php the_title('<h2 class="page-title"><span>', '</span></h2>');?>  
				
				<div class="entry-content" style="background: <?php echo $contentBackground;?>">
					<article>
						<?php the_content(); ?>
					</article>
				</div>
			</div>
		</div>

	</main><!-- #main -->

	<?php
endwhile; 

get_footer();
