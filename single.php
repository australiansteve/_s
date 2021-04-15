<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
				
				<div class="entry-content" style="background: <?php echo $contentBackground;?>">
					<div class="grid-x grid-margin-x">
						<div class="cell medium-5 large-4">
							<?php
							$thumbnail = get_field('cover_image') ? wp_get_attachment_image_src(get_field('cover_image'), 'archive-image')[0] : wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'archive-image')[0]; 
							?>
							<img src='<?php echo $thumbnail; ?>' />
						</div>
						
						<div class="cell medium-7 large-8">
							<?php the_title('<h2 class="page-title"><span>', '</span></h2>');?>  

							<?php the_content(); ?>

							<?php get_template_part( 'template-parts/breadcrumbs', get_post_type() ); ?>
						</div>
					</div>
					
				</div>
			</div> 
		</div>

	</main><!-- #main -->
	<?php

endwhile; 
?>

<?php
get_footer();
