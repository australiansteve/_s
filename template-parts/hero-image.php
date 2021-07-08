<?php
$displayHeroImage = get_field('display_hero_image');
$alternateHeroImageId = get_field('use_alternative_hero_image');
$videoVimeoId = get_field('video_background_vimeo_id');

$videoEmbed = !empty($videoVimeoId);

if ($displayHeroImage && ($videoEmbed || $alternateHeroImageId || has_post_thumbnail($post))) :

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
			else if (has_post_thumbnail($post)) {
				the_post_thumbnail( 'hero-image' );
			}
			?>
		</div>
		<?php
	}
endif;

?>