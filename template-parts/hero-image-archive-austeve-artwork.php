<?php
$displayHeroImage = get_field('artwork_archive_hero_image', 'options');

if ($displayHeroImage) :
	echo wp_get_attachment_image( $displayHeroImage, 'hero-image' );
endif;

?>