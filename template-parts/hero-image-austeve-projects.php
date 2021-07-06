<?php

if (is_archive()) {
	$image = get_field('projects_page_hero_image', 'options');
	if ($image) :
	?>
		<div class="hero-container bling container">
			<?php
			echo wp_get_attachment_image( $image, 'hero-image' );
			?>
		</div>
	<?php
	endif;
}
else {
	$displayHeroImage = get_field('display_hero_image');
	$alternateHeroImageId = get_field('use_alternative_hero_image');
	$images = get_field('project-gallery', $post);

	if ($displayHeroImage) :
		?>
		<div class="hero-container bling container">
			<?php
		if($alternateHeroImageId) {
			echo wp_get_attachment_image( $alternateHeroImageId, 'hero-image' );
		}
		else if ($images) {
			echo "<img src='".$images[0]['sizes']['hero-image']."' />";
			
		}
		else if (has_post_thumbnail($post)) {
			the_post_thumbnail( 'hero-image' );
		}
	?>
		</div>
			<?php
	endif;
}
?>