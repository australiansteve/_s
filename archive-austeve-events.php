<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

get_header();
?>

<main id="primary" class="site-main">

	<div class="page-content">

		<div class="grid-container">

			<?php
			the_archive_title( '<h1 class="page-title"><span>', '</span></h1>' );
			
			/* Upcoming Events first */
			$date_now = date('Y-m-d H:i:s');

			$args = array(
				'post_type'              => array( 'austeve-events' ),
				'post_status'            => array( 'publish' ),
				'posts_per_page'         => '3',
				'meta_query' 		=> array(
					'relation' 			=> 'AND',

					array(
						'key'			=> 'end_date',
						'compare'		=> '>=',
						'value'			=> $date_now,
						'type'			=> 'DATETIME'
					)
				),
				'order'				=> 'ASC',
				'orderby'			=> 'meta_value',
				'meta_key'			=> 'end_date',
				'meta_type'			=> 'DATETIME'
			);

			$postsquery = new WP_Query( $args );

			if ( $postsquery->have_posts() ) {
				?>
				<section id="upcoming-events">
					<h2><?php _e('Upcoming Events & Exhibits', 'hamburger-cat'); ?></h2>

					<div class="posts-container" id="events-grid" data-equalizer="events-title" data-equalize-on="medium">
						<div data-equalizer="events-location" data-equalize-on="medium">


							<div class="grid-x small-up-1 medium-up-3 align-center">
								<?php
								while ( $postsquery->have_posts() ) {
									$postsquery->the_post();
									?>
									<div class="cell">
										<?php get_template_part( 'template-parts/front-page', get_post_type() ); ?>
									</div>
									<?php
								}
								?>
							</div>

						</div>
					</div>
				</section>
				<?php
			}

			wp_reset_postdata();

			/* Past Events - aka the archive */
			?>

			
			<?php
			if ( have_posts()) :
				?>
				<section id="past-events">
					<h2><?php _e('Past Events and Exhibits', 'hamburger-cat'); ?></h2>
					<div class="grid-x grid-padding-x small-up-1">
						<?php
						while ( have_posts() ) :
							the_post();
							?>

							<div class="cell">
								<?php get_template_part( 'template-parts/archive', get_post_type() ); ?>
							</div>

							<?php
						endwhile;

						$nav_type = get_field('archive_navigation_type', 'option');
						if ($nav_type == 'infinite-scroll'):
							echo '<span class="next-page" data-page="2"/>';
						endif;
						?>
						<span class="next-page" data-page="2"/>
					</div>

					<?php get_template_part( 'template-parts/archive', 'nav' ); ?>
				</section>
				<?php
			endif;
			?>

		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
