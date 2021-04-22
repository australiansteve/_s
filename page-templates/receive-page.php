<?php
/***
  * Template Name: Receive Page
  */

get_header(); ?>

<main id="main" class="site-main" role="main">
	<div class="page-content">
		<div class="grid-container">
			<div class="entry-content">

				<div class="grid-x" id="receive-page">

					<?php while ( have_posts() ) : the_post(); ?>

						<div class="cell small-12" id="page-title">
							<h2><span><?php the_title(); ?></span></h2>
						</div>


						<?php 
						$today = date('Y-m-d');
						//error_log(print_r($today, true));
						$args = array(
							'post_type'              => array( 'austeve-grants' ),
							'post_status'            => array( 'publish' ),
							'meta_query' => array(
								'relation' => 'AND',
								array(
									'key'     => 'applications_open',
									'value'   => $today,
									'compare' => '<=',
									'type'    => 'DATE',
								),
								array(
									'key'     => 'applications_close',
									'value'   => $today,
									'compare' => '>=',
									'type'    => 'DATE',
								),
							),
						);
						//error_log(print_r($args, true));

						$grantsQuery = new WP_Query( $args );

						$grantCount = $grantsQuery->post_count;

						if ($grantsQuery->have_posts() ) :
							?>
							<div class="cell small-12" id="open-grants-highlight">
								<div class="container">
									<p>Applications are now being accepted for:</p>
									<ul>
										<?php
										while ( $grantsQuery->have_posts() ) :
											$grantsQuery->the_post();
											$date = new DateTime(get_field('applications_close'));

											echo "<li><a href='".get_permalink()."'>".get_the_title()."<br class='show-for-small-only'><span class='deadline'><span class='show-for-medium'> (</span>Deadline is ".$date->format('jS F Y')."<span class='show-for-medium'>)</span></span></a></li>";    
										endwhile;
										?>
									</ul>
								</div>
							</div>
							<?php
						endif;
						wp_reset_postdata();

						?>

						<div class="cell small-12" id="intro">
							<?php the_field('introduction'); ?>
						</div>

						<div class="cell small-12" id="grants" data-equalizer="grant-title">

							<?php 

							$args = array(
								'post_type'		=> array( 'austeve-grants' ),
								'post_status'	=> array( 'publish' ),
								'orderby'		=> 'menu_order',
								'order'			=> 'ASC',
							);

							$grantsQuery = new WP_Query( $args );
							error_log("Grants query:".print_r($grantsQuery, true));

							$grantCount = $grantsQuery->post_count;

							if ($grantsQuery->have_posts()) :
								$mediumCells = 2 + ($grantCount % 2);
								?>
								<div class="grid-x align-center small-up-1 medium-up-<?php echo $mediumCells;?>">
									<?php
									while ( $grantsQuery->have_posts() ) :
										$grantsQuery->the_post();
										get_template_part( 'template-parts/austeve-grants', 'archive' );
									endwhile;
									?>
								</div>
								<?php
							endif;
							wp_reset_postdata();
							?>

						</div>

						<div class="cell small-12" id="after-grants">
							<?php the_field('after_grants'); ?>
						</div>

					<?php endwhile; // End of the loop. ?>

				</div>

			</div>
		</div>
	</div>
</main><!-- #main -->

<?php get_footer(); ?>