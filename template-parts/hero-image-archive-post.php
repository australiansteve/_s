<?php
if (is_category('testimonials')) :
	error_log('testimonials hero image');
	$displayHeroImage = get_field('testimonials_archive_hero_image', 'options');

	if ($displayHeroImage) :
		echo wp_get_attachment_image( $displayHeroImage, 'hero-image' );
	endif;
endif;
?>