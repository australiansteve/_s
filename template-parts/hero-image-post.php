<?php

if (is_home()) {
	$displayHeroImage = get_field('display_hero_image',  get_option( 'page_for_posts' ));
	$alternateHeroImageId = get_field('use_alternative_hero_image',  get_option( 'page_for_posts' ));
	$videoVimeoId = get_field('video_background_vimeo_id',  get_option( 'page_for_posts' ));
	$postId = get_option( 'page_for_posts' );
}
else {
	$displayHeroImage = get_field('display_hero_image');
	$alternateHeroImageId = get_field('use_alternative_hero_image');
	$videoVimeoId = get_field('video_background_vimeo_id');
	$postId = $post->id;
	
}
if ($displayHeroImage) :
	$videoEmbed = !empty($videoVimeoId);

	if ($videoEmbed) {
		$featured_img_url = "";
		$backgroundClass = "bg-video";
		?>
		<div class="header-bg video">
			<iframe id="headerVideo" src="https://player.vimeo.com/video/<?php echo $videoVimeoId; ?>?color=ef0800&title=0&byline=0&portrait=0&autoplay=1&loop=1&autopause=0&muted=1&controls=0&background=1"  frameborder="0" allow="autoplay; fullscreen; picture-in-picture" muted autoplay></iframe>
			<script src="https://player.vimeo.com/api/player.js"></script>
		</div>
		<?php
	}
	else {
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
	}
endif;

?>