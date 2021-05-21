<?php
/**
 * Template Name: About / Our Team Page
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

				<div id="team-member-grid" class="grid-x grid-margin-x grid-margin-y small-up-2 medium-up-3">

					<?php
						if( have_rows('team_members') ):
						    while( have_rows('team_members') ) : the_row();
						        $teamMember = get_sub_field('team_member');
						        ?>
								<div class="cell">
									<div class="team-member">
										<div class="image">
											<?php 
											$image = $teamMember['image'];
											$size = 'team-member-profile'; 
											if( $image ) {
												echo wp_get_attachment_image( $image, $size );
											}
											?>
										</div>
										<div class="name">
											<?php echo $teamMember['name']; ?>
										</div>
										<div class="title">
											<?php echo $teamMember['title']; ?>
										</div>
									</div>
								</div>
						        <?php
						    endwhile;
						endif;
					?>

				</div>

			</div>

		</div>

		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	<?php
	get_footer();
