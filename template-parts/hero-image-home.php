<?php

$displayHeroImage = get_field('display_hero_image', get_option('page_for_posts'));
$alternateHeroImageId = get_field('use_alternative_hero_image', get_option('page_for_posts'));

if ($displayHeroImage) :
	
	if($alternateHeroImageId) {
		echo wp_get_attachment_image( $alternateHeroImageId, 'hero-image' );
	}
	else if (has_post_thumbnail(get_option('page_for_posts'))) {
		echo get_the_post_thumbnail( get_option('page_for_posts'), 'hero-image' );
	}

endif;
?>