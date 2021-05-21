<?php
/**
 * Template Name: About / Social Enterprises Page
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

				<div id="social-enterprise-grid" class="grid-x grid-margin-y">

					<?php
					$args = array(
						'post_type'              => array( 'social-enterprises' ),
						'post_status'            => array( 'publish' ),
						'posts_per_page'         => '-1',
					);

					$postsquery = new WP_Query( $args );

					if ( $postsquery->have_posts() ) {
						while ( $postsquery->have_posts() ) {
							$postsquery->the_post();

							?>
							<div class="cell">
								<div class="grid-x grid-margin-x social-enterprise">
									<div class="cell medium-6">
										<div class="image">
											<?php 
											echo the_post_thumbnail('archive-image');
											?>
										</div>
									</div>
									<div class="cell medium-6">
										<div class="name">
											<?php the_title('<h3>', '</h3>'); ?>
										</div>
										<div class="entry-content">
											<?php the_content(); ?>
										</div>
										<div class="website">
											<?php
											$website = get_field('website');
											if ($website) {
												?>
												<a href="<?php echo $website;?>" class="button" target="_blank"><?php the_field('visit_website_button_text', 'options'); ?></a>
												<?php
											}
											?>
										</div>
									</div>
								</div>
							</div>
							<?php
						}
					}

					wp_reset_postdata();
					?>

				</div>

			</div>

		</div>

		<?php
	endwhile;
	?>

</main><!-- #main -->

<?php
get_footer();
