<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

get_header();

$pageBackground = get_field('resources_page_custom_page_background', 'options') ? get_field('resources_page_custom_page_background', 'options') :get_field('default_page_background', 'options');
$contentBackground = get_field('resources_page_custom_content_background', 'options') ? get_field('resources_page_custom_content_background', 'options') :get_field('default_content_background', 'options');
?>

<main id="primary" class="site-main" style="background: <?php echo $pageBackground;?>">

	<div class="page-content">

		<div class="grid-container">

			<?php get_template_part( 'template-parts/links-resource-category' ) ?>

			<?php
			the_archive_title( '<h2 class="page-title"><span>', '</span></h2>' );
			?>


			<div class="entry-content">

				<div class="grid-x grid-padding-x small-up-1" >
					<?php
					while ( have_posts() ) :
						the_post();

						?>

						<div class="cell">
							<?php get_template_part( 'template-parts/archive', get_post_type() ); ?>
						</div>


						<?php
					endwhile;
					?>
				</div>

				<div class="grid-x <?php echo get_post_type(); ?>">

					<div class="cell">
						<div class="entry-content" style="background: <?php echo $contentBackground;?>">

							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

								<div class="grid-x">
									<div class="cell medium-5 large-4">
										<img class="image" src="<?php echo wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'archive-image')[0]; ?>"/>
									</div>
									<div class="cell medium-7 large-8">
										<h2>Your organization here</h2>

										<p>Do you belong here? </p>
										<a class="web-site button" href="<?php echo home_url('contact-us');?>">Contact us</a>
									</div>
								</div>

							</article><!-- #post-<?php the_ID(); ?> -->

						</div>
					</div>

				</div>

				<?php get_template_part( 'template-parts/archive', 'nav' ); ?>
			</div>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
