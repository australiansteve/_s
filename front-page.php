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
			<div class="grid-container">
				
				<section id="section-2">
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
				</section>

				<section id="section-3">
					<div class="text-center">
						<h2 class="section-title"><?php the_field('section_3_title'); ?></h2>
						<div class="text-container">
							<?php the_field('section_3_text'); ?>
						</div>
						<div class="posts-container">
							<div class="grid-x grid-margin-x align-center small-up-2">

								<?php
								if( have_rows('section_3_featured_artwork') ):

								    // Loop through rows.
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
								        // Do something...

								    // End loop.
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
				</section>

				<section id="section-4">
					<div class="text-center">
						<h2 class="section-title"><?php the_field('section_4_title'); ?></h2>
					<div class="grid-x grid-margin-x align-center small-up-1 medium-up-3">

								<?php
								$args = array(
									'post_type'              => array( 'post' ),
									'post_status'            => array( 'publish' ),
									'posts_per_page'         => '3'
								);

								$postsquery = new WP_Query( $args );

								if ( $postsquery->have_posts() ) {
									while ( $postsquery->have_posts() ) {
										$postsquery->the_post();
										?>
										<div class="cell">
											<?php 
											get_template_part( 'template-parts/archive-front-page', get_post_type() );
											?>
										</div>
										<?php
									}
								}

								wp_reset_postdata();
								?>
							</div>
						</div>
				</section>

				<section id="section-5">
						<h2 class="section-title"><?php the_field('section_5_title'); ?></h2>

					<div class="grid-x grid-margin-x">
						<div class="cell medium-6">
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