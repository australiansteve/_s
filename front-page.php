<?php 

get_header();

?>
<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/hero-image', 'front-page' );
		?>

		<div class="page-content">
			
			<section id="section-2">
				<div class="grid-container">
					<div class="grid-y align-center" style="height: 500px;">
						<div class="cell text-center">
							<div class="text-container">
								<?php the_field('section_2_text'); ?>
							</div>
							<?php 
							$section_2_button_text = get_field('section_2_button_text'); 
							$section_2_button_url = get_field('section_2_button_url'); 

							if ($section_2_button_text && $section_2_button_url) :
								?>
								<a class="button" href="<?php echo $section_2_button_url;?>"><?php echo $section_2_button_text;?></a>
								<?php
							endif;
							?>
						</div>
					</div>
				</div>
				
				<div class="yarn-bling yarn-bling-1"></div>
				<div class="yarn-bling yarn-bling-2"></div>
				
			</section>

			<section id="section-3">
				<div class="grid-container">
					<div class="text-center">
						<h2 class="section-title"><?php the_field('section_3_title'); ?></h2>
						<div class="text-container">
							<?php the_field('section_3_text'); ?>
						</div>
						<div class="posts-container">
							<div class="grid-x grid-margin-x align-center small-up-2">

								<?php
								if( have_rows('section_3_featured_artwork') ):

									while( have_rows('section_3_featured_artwork') ) : the_row();

								        // Load sub field value.
										$sub_value = get_sub_field('artwork');

										$post = get_post( $sub_value, OBJECT );
										setup_postdata( $post );

										?>
										<div class="cell">
											<?php 
											get_template_part( 'template-parts/archive-front-page', get_post_type() );
											?>
										</div>
										<?php

										wp_reset_postdata();

									endwhile;

								endif;
								?>
							</div>
						</div>
						<?php 
						$section_3_button_text = get_field('section_3_button_text'); 
						$section_3_button_url = get_field('section_3_button_url'); 

						if ($section_3_button_text && $section_3_button_url) :
							?>
							<a class="button" href="<?php echo $section_3_button_url;?>"><?php echo $section_3_button_text;?></a>
							<?php
						endif;
						?>
					</div>
				</div>

				<div class="yarn-bling yarn-bling-3"></div>

			</section>

			<section id="section-4">
				<div class="grid-container">
					<div class="text-center"  data-equalizer="quote-text">
						<h2 class="section-title"><?php the_field('section_4_title'); ?></h2>
						<div class="grid-x grid-margin-x align-center small-up-1 medium-up-3" data-equalizer="home-post-title">

							<?php
							$args = array(
								'post_type'              => array( 'post' ),
								'post_status'            => array( 'publish' ),
								'posts_per_page'         => '3',
								'tax_query' 			=> array(
									array(
										'taxonomy'         => 'category',
										'terms'            => 'testimonials',
										'field'            => 'slug',
										'operator'         => 'IN',
									)
								),
							);

							$postsquery = new WP_Query( $args );

							if ( $postsquery->have_posts() ) {
								while ( $postsquery->have_posts() ) {
									$postsquery->the_post();
									?>
									<div class="cell">
										<?php 
										get_template_part( 'template-parts/front-page-testimonial', get_post_type() );
										?>
									</div>
									<?php
								}
							}

							wp_reset_postdata();
							?>
						</div>
					</div>
				</div>
			</section>

			<section id="section-5">
				<div class="grid-container">
					<div class="grid-x">
						<div class="cell medium-6 aqua-background">
							<h2 class="section-title"><?php the_field('section_5_title'); ?></h2>
						</div>
					</div>
					<div class="grid-x grid-margin-x">
						<div class="cell medium-6 aqua-background">
							<?php
							$ninja_form_id = get_field('section_5_ninja_form_id');
							if($ninja_form_id) :
								echo do_shortcode('[ninja_form id="'.$ninja_form_id.'"]');
							endif;
							?>
						</div>
						<div class="cell medium-6">
							<div class="text-container">
								<?php the_field('section_5_text') ?>
							</div>
						</div>
					</div>
				</div>

				<div class="yarn-bling yarn-bling-4"></div>
				<div class="yarn-bling yarn-bling-5"></div>

			</section>

		</div>

		<?php
	endwhile; 
	?>

</main><!-- #main -->
<?php

get_footer();
?>