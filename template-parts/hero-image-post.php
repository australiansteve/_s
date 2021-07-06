<?php

if (is_home()) {
	$displayHeroImage = get_field('display_hero_image',  get_option( 'page_for_posts' ));
	$alternateHeroImageId = get_field('use_alternative_hero_image',  get_option( 'page_for_posts' ));
	$postId = get_option( 'page_for_posts' );
}
else {
	$displayHeroImage = get_field('display_hero_image');
	$alternateHeroImageId = get_field('use_alternative_hero_image');
	$postId = $post->id;
	
}
if ($displayHeroImage) :
	?>
	<div class="hero-container bling container">
		<?php
		if($alternateHeroImageId) {
			echo wp_get_attachment_image( $alternateHeroImageId, 'hero-image' );
		}
		else if (has_post_thumbnail($postId)) {
			echo get_the_post_thumbnail( $postId, 'hero-image' );
		}
		?>
	</div>
	<?php
endif;

?>