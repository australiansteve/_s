<?php 
if ($section['video_url']) :
	?>
	<video playsInline preload="none" controls width="100%" src="<?php echo $section['video_url']; ?>" poster="<?php echo wp_get_attachment_image_src($section['placeholder_image'], 'full')[0];?>">
		Your browser doesn't support HTML5 video tag.
	</video>
	<?php
endif; ?>
<div class="grid-x video-overlay" id="video-controls">
	<div class="cell">
		<div class="button play-button"><i class="fas fa-play fa-2x"></i></div>

		<script type="text/javascript">
			function hideControls() {
				jQuery("#video-controls").css('opacity', '0');
				setTimeout(function() {jQuery("#video-controls").css('z-index', '-1');}, 5000);
			}
			function playVideo() {
				var video = document.querySelector("section#video video");
				video.play();
				hideControls();
			}
			jQuery(document).on("click", ".play-button", playVideo);

			var video = document.querySelector("section#video video");
			video.addEventListener("play", hideControls);

		</script>
	</div>
</div>