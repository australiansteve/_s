<?php
$displayHeroImage = get_field('display_hero_image');
$alternateHeroImageId = get_field('use_alternative_hero_image');

if ($displayHeroImage) :
	?>
	<div class="hero-container bling container">
		<?php
	if($alternateHeroImageId) {
		echo wp_get_attachment_image( $alternateHeroImageId, 'hero-image' );
	}
	else if (has_post_thumbnail($post)) {
		the_post_thumbnail( 'hero-image' );
	}
?>
	</div>
		<?php
endif;

?>