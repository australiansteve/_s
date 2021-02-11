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
									<?php the_field("text_1"); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="grid-container">
					<div class="grid-x" id="custom-content-2">
						<div class="cell medium-6">
							<div class="grid-y align-center grid-padding-x" style="height: 100%">
								<div class="cell">
									<div class="container text_2">
										<?php the_field("text_2"); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="cell medium-6">
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
					</div>
					<div class="grid-x" id="custom-content-3">
						<div class="cell medium-6">
							<div class="container contact_form_id">
								<?php 
								$formId = get_field('contact_form_id');
								if( $formId ) {
									echo do_shortcode("[ninja_forms id='".$formId."']");
								}
								?>
							</div>
						</div>
						<div class="cell medium-6">
							<div class="grid-y align-center grid-padding-x" style="height: 100%">
								<div class="cell">
									<div class="container text_3">
										<?php the_field("text_3"); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="custom-content-4">
					<div class="container professional_affilations">
						<div class="grid-x align-middle align-center">
							<?php 
							$images = get_field('professional_affilations');
							$size = 'full';
							if( $images ): ?>

								<?php foreach( $images as $image_id ): ?>
									<div class="cell shrink text-center">
										<?php echo wp_get_attachment_image( $image_id, $size ); ?>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
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