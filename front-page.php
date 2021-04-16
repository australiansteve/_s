<?php 

get_header();

?>
<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/hero-image', get_post_type() );
		?>

		<div id="front-page-landing">
			<?php 
			$backgroundImageId = get_field('landing_section_background_image');
			$imageUrl = wp_get_attachment_image_src($backgroundImageId, 'full');
			?>
			<div class="background-image" style="background-image: url(<?php echo $imageUrl[0];?>);"></div>
			<div class="entry-content">

				<?php the_content(); ?>
			</div>
		</div>

		<section id="news-and-events">
			<div class="grid-container">
				<div class="entry-content">
					<div class="grid-x align-center">
						<div class="cell medium-6 large-4 front-page-news">
							<h2><?php the_field('posts_column_1_title');?></h2>
							<?php
							// WP_Query arguments
							$args = array(
								'post_type'              => array( 'post' ),
								'post_status'            => array( 'publish' ),
								'posts_per_page'         => '3',
							);

							// The Query
							$postsquery = new WP_Query( $args );

							// The Loop
							if ( $postsquery->have_posts() ) {
								while ( $postsquery->have_posts() ) {
									$postsquery->the_post();
									
									get_template_part( 'template-parts/front-page', get_post_type() );

								}
							} 
							// Restore original Post Data
							wp_reset_postdata();
							?>

						</div>
						<div class="cell medium-6 large-4 front-page-events">
							<h2><?php the_field('posts_column_2_title');?></h2>
							<?php
							// WP_Query arguments
							$args = array(
								'post_type'              => array( 'austeve-events' ),
								'post_status'            => array( 'publish' ),
								'posts_per_page'         => '3',
							);

							// The Query
							$postsquery = new WP_Query( $args );

							// The Loop
							if ( $postsquery->have_posts() ) {
								while ( $postsquery->have_posts() ) {
									$postsquery->the_post();
									
									get_template_part( 'template-parts/front-page', get_post_type() );

								}
							} 
							// Restore original Post Data
							wp_reset_postdata();
							?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<script type="text/javascript">
			jQuery( document ).ready(function() {
			    jQuery('#news-and-events article').on('mouseenter', function() {

			    	jQuery(this).find('.background-image').css('background-image', 'url('+jQuery(this).data('background-url')+')');
			    });
			    jQuery('#news-and-events article').on('mouseleave', function() {
			    	jQuery(this).find('.background-image').css('background-image', '');
			    });
			});
		</script>

		<section id="newsletter-signup">

			<div class="grid-container">
				<div class="page-content">
					<div class="entry-content">
						<div class="container text-center">
							<?php the_field('mailchimp_embed_code');?>
						</div>
					</div>
				</div>
			</div>
		</section>
<!-- 
		<section id="custom-content-3">
			<div class="grid-container">
				<div class="page-content">
					<div class="entry-content">
					</div>
				</div>
			</div>
		</section> -->

		<section id="resources-section">
			<div class="grid-container">
				<div class="page-content">
					<div class="entry-content">
						<h2><?php the_field('resources_section_title');?></h2>
						<?php get_template_part( 'template-parts/links-resource-category' ) ?>
					</div>
				</div>
			</div>
		</section>

		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
	<?php

	get_footer();
	?>