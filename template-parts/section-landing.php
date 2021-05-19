<section id="landing" class="background-container">
	<?php
	$pageType = is_front_page() ? 'front-page' : '';
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
		if ($backgroundImageAccent == 'yellow-green') {
			$backgroundImageAccent = get_stylesheet_directory_uri().'/media/accent-yellow-green.png';
		}
		else if ($backgroundImageAccent == 'pink') {
			$backgroundImageAccent = get_stylesheet_directory_uri().'/media/accent-pink.png';
		}
		else if ($backgroundImageAccent == 'orange-green') {
			$backgroundImageAccent = get_stylesheet_directory_uri().'/media/accent-orange-green.png';
		}
	}
	?>

	<div class="grid-container">
		<div class="grid-x">

			<div class="cell medium-5 medium-offset-1">
				<?php
				get_template_part( 'template-parts/section-landing-left', $pageType );
				?>
			</div>

			<div class="cell medium-6" id="landing-right">
				<div class="background-image" style="background-image: url(<?php echo $backgroundImageUrl;?>);"></div>
				<?php if ($backgroundImageAccent) : ?>
					<div class="background-image-accent" style="background-image: url(<?php echo $backgroundImageAccent;?>);"></div>
				<?php endif; ?>
				<?php
				get_template_part( 'template-parts/section-landing-right', $pageType );
				?>
			</div>

		</div>
	</div>
</section>