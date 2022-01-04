<?php
$videoType = get_field('feature_video_type');
$videoId = get_field('feature_video_id');
$displayHeroImage = get_field('display_hero_image');
$alternateHeroImageId = get_field('use_alternative_hero_image');

if ($videoId) :
	?>
	<div class="iframe-container">
	<?php
	if ($videoType == 'vimeo') :
		?>
			<iframe class="responsive" src="https://player.vimeo.com/video/<?php echo $videoId;?>?color=c02c8b&title=0&byline=0&portrait=0&autoplay=0&loop=0&autopause=0&muted=0&controls=1&background=0" frameborder="0"allow="autoplay; fullscreen; picture-in-picture" muted autoplay></iframe>
		<?php
	elseif ($videoType == 'youtube') :
		?>
			<iframe class="responsive" src="https://www.youtube.com/embed/<?php echo $videoId;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope" allowfullscreen></iframe>
		<?php
	endif;
	?>
	</div>
	<?php
else :

	if ($displayHeroImage) :

		if($alternateHeroImageId) {
			echo wp_get_attachment_image( $alternateHeroImageId, 'hero-image' );
		}
		else if (has_post_thumbnail($post)) {
			the_post_thumbnail( 'hero-image' );
		}

	endif;
endif;

?>