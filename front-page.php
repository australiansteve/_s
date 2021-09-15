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
			<div class="grid-container">
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>

			<div class="custom-content">
				<div class="grid-x" id="custom-content-1">
					<div class="cell medium-6 text-left medium-text-right">
						<div class="container image_1">
							<?php 
							$image = get_field('image_1');
							$size = 'full';

							if( $image ) {
								echo wp_get_attachment_image( $image, $size );
							}
							?>
						</div>
					</div>
					<div class="cell medium-6 text-left">
						<div class="grid-y align-center grid-padding-x" style="height: 100%">
							<div class="cell">
								<div class="container text_1">
									<div class="inner-container">
										<?php the_field("text_1"); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="grid-container">
					<div class="grid-x" id="custom-content-2">
						<div class="cell medium-6 medium-order-2">
							<div class="container image_2">
								<?php 
								$image = get_field('image_2');
								$size = 'full'; 							
								if( $image ) {
									echo wp_get_attachment_image( $image, $size );
								}
								?>
							</div>
						</div>
						<div class="cell medium-6 medium-order-1">
							<div class="grid-y align-center grid-padding-x" style="height: 100%">
								<div class="cell">
									<div class="container text_2">
										<div class="inner-container">
											<?php the_field("text_2"); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="grid-x" id="custom-content-3">
						<div class="cell text-center">
							<h2 class="section-title"><?php the_field("text_3"); ?></h2>
						</div>
						<div class="cell">
								<div class="grid-x grid-padding-x align-center small-up-1 medium-up-3">

									<?php
									$args = array(
										'post_type'              => array( 'post' ),
										'post_status'            => array( 'publish' ),
										'posts_per_page'         => '3',
										'tax_query'              => array(
											array(
												'taxonomy'         => 'category',
												'terms'            => 'news',
												'field'            => 'slug',
												'operator'         => 'IN',
											),
										),
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
?>