<?php 

get_header();

?>
<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/hero-image-front-page', get_post_type() );
		?>

		<div class="page-content">
			<div class="grid-container">
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>


		<?php

		$tax_query = array(
			array(
				'taxonomy'         => 'category',
				'terms'            => 'featured',
				'field'            => 'slug',
				'operator'         => 'IN',
			),
		);

		// WP_Query arguments
		$args = array(
			'post_type'				=> array( 'post' ),
			'post_status'			=> array( 'publish' ),
			'tax_query'				=> $tax_query,
		);

		// The Query
		$query = new WP_Query( $args );

		// The Loop
		if ( $query->have_posts() ) {
			$postCount = 1;

			$sessionsSectionTitle = get_field('sessions_section_title');
			$seeAllButtonText = get_field('see_all_button_text');
			$seeAllButtonLink = get_field('see_all_button_link');

			if ($sessionsSectionTitle):
				?>

				<div class="page-content">
					<div class="grid-container">
						<div class="entry-content">
							<h2 class="section-title"><?php echo $sessionsSectionTitle;?></h2>
						</div>
					</div>
				</div>
				<?php 
			endif;
			?>
			
			<div class="grid-container">
				<div id="featured-posts">
					<?php
					while ( $query->have_posts() ) {
						$query->the_post();
						?>
						<?php get_template_part( 'template-parts/archive', get_post_type(), array( 
							'post_count' => $postCount++) ); ?>
						<?php
					}
					?>

				</div>
				<div class="grid-x">
					<div class="cell text-center">
						<div class="entry-content all-posts-link">
							<h3><a class="button" href="<?php echo $seeAllButtonLink; ?>"><?php echo $seeAllButtonText; ?></a></h3>
						</div>
					</div>
				</div>
			</div>

			<?php
		} 
		// Restore original Post Data
		wp_reset_postdata();

	endwhile;
	?>

	<div class="grid-container">
		<div class="grid-x">
			<div class="cell text-center">
				<?php
				$sponsorSectionTitle = get_field('sponsor_section_title');
				$sponsorSectionText = get_field('sponsor_section_text');
				$sponsorsGallery = get_field('sponsors_gallery');

				if ($sponsorsGallery) :
					?>
					<section id="sponsors">
						<div class="entry-content" id="section-11-content">
							<?php echo $sponsorSectionTitle ? "<h3 class='section-title'>".$sponsorSectionTitle."</h3>" : ""; ?>
							<?php echo $sponsorSectionText ? $sponsorSectionText : ""; ?>

							<div class="grid-x grid-padding-x small-up-2 medium-up-<?php echo count($sponsorsGallery);?> align-center">
								<?php foreach( $sponsorsGallery as $image_id ): ?>
									<div class="cell">
										<div class="grid-y align-center" style="height: 100%">
											<div class="cell">
												<?php echo wp_get_attachment_image( $image_id, 'sponsor-logo' ); ?>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</section>
					<?php
				endif;
				?>
			</div>
		</div>
	</div>
</main>

<?php  
get_template_part( 'template-parts/reveal-video-modal', get_post_type() ); 

get_footer();
?>