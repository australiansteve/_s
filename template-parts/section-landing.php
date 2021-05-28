<section id="landing" class="background-container">
	<?php
	$pageType = is_front_page() ? 'front-page' : (is_page() ? 'page' : (is_singular('sjle-programs') ? 'sjle-programs' : ''));
	$size = 'full';
	
	if (is_front_page()) {

		$image = get_field('landing_background_image');
		$size = 'full'; // (thumbnail, medium, large, full or custom size)
		
		if( $image ) {
			$backgroundImageUrl = wp_get_attachment_image_src( $image, $size )[0];
		}
	}
	else if( has_post_thumbnail() ) {
		$backgroundImageUrl = get_the_post_thumbnail_url($post, $size);
	}

	if (!empty($backgroundImageUrl)) {
		$backgroundImageAccent = get_field('featured_image_accent');

		if ($backgroundImageAccent) {
			$backgroundImageAccent = wp_get_attachment_image_src( $backgroundImageAccent, 'full' )[0];
		}
	}
	?>

	<div class="grid-container">
		<div class="grid-x grid-margin-x">

			<div class="cell medium-5 medium-offset-1">
				<?php
				get_template_part( 'template-parts/section-landing-left', $pageType );
				?>
			</div>

			<div class="cell medium-6" id="landing-right">
				<div class="background-image" style="<?php echo !empty($backgroundImageUrl) ? 'background-image: url('.$backgroundImageUrl.');' : '' ?>"></div>
				<?php if (isset($backgroundImageAccent)) : ?>
					<div class="background-image-accent" style="background-image: url(<?php echo $backgroundImageAccent;?>);"></div>
				<?php endif; ?>
				<?php
				get_template_part( 'template-parts/section-landing-right', $pageType );
				?>
			</div>

		</div>
	</div>
</section>