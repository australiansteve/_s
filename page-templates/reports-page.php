<?php
/***
  * Template Name: Reports Page
  */

get_header(); 

?>

<main id="main" class="site-main" role="main">
	<div class="page-content">
		<div class="grid-container">
			<div class="entry-content">

				<div class="grid-x" id="about-reports-page">

					<?php while ( have_posts() ) : the_post(); ?>

						<div class="cell small-12" class="page-title">
							<h1><?php the_title(); ?></h1>
						</div>

						<div class="cell small-12" class="page-content">
							<?php the_content(); ?>
						</div>

						<div class="cell small-12" id="report-types">

							<?php 
							if( have_rows('report_type') ):

								while ( have_rows('report_type') ) : the_row();
									error_log("Report Type: ".print_r(get_sub_field('name'), true));
									?>
									<h2 class="report-type"><?php the_sub_field('name');?></h2>
									<div class="reports">
										<div class="grid-x report-type report-type-<?php echo austeve_clean_string(get_sub_field('name')); ?>">
											<?php 
											if( have_rows('reports') ):

												while ( have_rows('reports') ) : the_row();
													error_log(print_r(get_sub_field('report'), true));
													$report = get_sub_field('report');
													?>
													<div class="cell small-12" class="report">
														<p><a href="<?php echo $report['url'];?>" target="_blank"><i class="far fa-file-pdf"></i> <?php echo $report['title'];?></a></p>
													</div>
													<?php
												endwhile;
												?>
												<?php
											else:
												echo "No reports found";
											endif;
											?>
										</div>
									</div>				        
									<?php
								endwhile;
							endif;
							?>

						</div>

					<?php endwhile; // End of the loop. ?>

				</div>

			</div>
		</div>
	</div>
</main><!-- #main -->

<?php get_footer(); ?>