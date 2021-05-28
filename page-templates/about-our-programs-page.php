<?php
/**
 * Template Name: About / Our Programs Page
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

				<div data-equalizer="wif-match" data-equalize-on="medium" data-equalize-by-row="true">
					<div id="sjle-programs-grid" class="grid-x grid-margin-x grid-margin-y small-up-1 medium-up-3 text-center align-center"data-equalizer="title-match" data-equalize-on="medium" data-equalize-by-row="true">
						<?php
						$args = array(
							'post_type'				=> array( 'sjle-programs' ),
							'post_status'			=> array( 'publish' ),
							'posts_per_page'		=> '-1',
							'orderby' 				=> 'menu_order', 
							'order' 				=> 'ASC', 
						);

						$postsquery = new WP_Query( $args );

						if ( $postsquery->have_posts() ) {
							while ( $postsquery->have_posts() ) {
								$postsquery->the_post();

								?>
								<div class="cell">
									<?php get_template_part('template-parts/archive', get_post_type()); ?>
								</div>
								<?php
							}
						}

						wp_reset_postdata();
						?>
					</div>
				</div>

			</div>

		</div>

		<?php
	endwhile;
	?>

</main><!-- #main -->

<?php
get_footer();
