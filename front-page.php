<?php 

get_header();

?>
<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/hero-image', get_post_type() );
		?>

		<div class="page-content">
			<div class="grid-container text-center">

				<section id="section-1">
					<?php
					$section_1_image_id = get_field('section_1_image');
					$section_1_text = get_field('section_1_text');

					?>
					<div class="image-container">
						<?php 
						echo wp_get_attachment_image( $section_1_image_id, 'homepage-landing');
						?>
					</div>
					<div class="text-container">
						<h1 class="page-title"><?php echo $section_1_text; ?></h1>
					</div>

				</section>
				
				<section id="section-2" class="ignore-grid-container-padding-left ignore-grid-container-padding-right">
					<?php
					$section_2_title = get_field('section_2_title');
					$section_2_text = get_field('section_2_text');
					$section_2_image_id = get_field('section_2_image');
					?>

					<div class="grid-x">
						<div class="cell medium-6 large-5">
							<?php 
							echo wp_get_attachment_image( $section_2_image_id, 'section-side');
							?>
						</div>
						<div class="cell medium-6 large-7">
							<div class="grid-y align-center" id="section-2-right">
								<div class="cell">
									<div class="text-container medium-text-left add-grid-container-padding-right">
										<h2 class="section-title"><?php echo $section_2_title; ?></h2>
										<?php echo $section_2_text; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				
				<section id="section-3" class="turquoise-background ignore-grid-container-padding-left ignore-grid-container-padding-right">
					<?php
					$section_3_title = get_field('section_3_title');
					$section_3_button_text = get_field('section_3_button_text');
					$section_3_button_link = get_field('section_3_button_link');
					?>
					<div class="section-container grid-container">
						<h2 class="section-title"><?php echo $section_3_title; ?></h2>
						<div class="posts-container" data-equalizer="paintings-title" data-equalize-on="medium">
							<?php
							$args = array(
								'post_type'              => array( 'austeve-paintings' ),
								'post_status'            => array( 'publish' ),
								'posts_per_page'         => '3',
							);

							$postsquery = new WP_Query( $args );

							if ( $postsquery->have_posts() ) {
								?>
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
								<?php
							}

							wp_reset_postdata();

							?>
						</div>
						<a class="button reverse" href="<?php echo $section_3_button_link; ?>"><?php echo $section_3_button_text; ?></a>
					</div>

				</section>
				
				<section id="section-4">
					<?php
					$section_4_title = get_field('section_4_title');
					$section_4_button_text = get_field('section_4_button_text');
					$section_4_button_link = get_field('section_4_button_link');
					?>
					<div class="section-container">
						<h2 class="section-title"><?php echo $section_4_title; ?></h2>
						<div class="posts-container" id="events-grid" data-equalizer="events-title" data-equalize-on="medium">
							<div data-equalizer="events-location" data-equalize-on="medium">
								<?php
								$args = array(
									'post_type'              => array( 'austeve-events' ),
									'post_status'            => array( 'publish' ),
									'posts_per_page'         => '3',
								);

								$postsquery = new WP_Query( $args );

								if ( $postsquery->have_posts() ) {
									?>
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
									<?php
								}

								wp_reset_postdata();

								?>
							</div>
						</div>
						<a class="button" href="<?php echo $section_4_button_link; ?>"><?php echo $section_4_button_text; ?></a>
					</div>
				</section>

				<div class="teal-background ignore-grid-container-padding-left">
					<section id="section-5" class="teal-background ignore-grid-container-padding-right">
						<?php
						$section_5_title = get_field('section_5_title');
						$section_5_text = get_field('section_5_text');
						$section_5_contact_form_id = get_field('section_5_contact_form_id');
						$section_5_image_id = get_field('section_5_image');
						?>
						<div class="grid-x">
							<div class="cell xlarge-5 xlarge-order-2 show-for-xlarge">
								<?php 
								echo wp_get_attachment_image( $section_5_image_id, 'section-side');
								?>
							</div>

							<div class="cell hide-for-xlarge">
								<?php 
								echo wp_get_attachment_image( $section_5_image_id, 'hero-image-large');
								?>
							</div>

							<div class="cell xlarge-7 xlarge-ordr-1">

								<div class="grid-y align-center" id="section-5-left">
									<div class="cell">
										<div class="text-container medium-text-left">
											<h2 class="section-title"><?php echo $section_5_title; ?></h2>
											<div class="grid-x grid-margin-x">
												<div class="cell medium-7">
													<?php echo do_shortcode('[ninja_forms id="'.$section_5_contact_form_id.'"]'); ?>
												</div>
												<div class="cell medium-5">
													<?php echo $section_5_text; ?>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>

			</div>

			<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
	<?php

	get_footer();
?>