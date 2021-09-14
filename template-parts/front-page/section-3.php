<?php
if ($section3VideoId) :
	?>
	<section id="section-3">
		<div class="entry-content" id="section-3-content">
			<?php echo $section3Title ? "<h3 class='section-title'>".$section3Title."</h3>" : ""; ?>

			<?php
			if ($section3VideoType == 'vimeo') :
				?>
				<div class="iframe-container">
					<iframe class="responsive" src="https://player.vimeo.com/video/<?php echo $section3VideoId;?>?color=c02c8b&title=0&byline=0&portrait=0&autoplay=0&loop=0&autopause=0&muted=0&controls=1&background=0" frameborder="0"allow="autoplay; fullscreen; picture-in-picture" muted autoplay></iframe>
				</div>
				<?php
			elseif ($section3VideoType == 'youtube') :
				?>
				<div class="iframe-container">
					<iframe class="responsive" src="https://www.youtube.com/embed/<?php echo $section3VideoId;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope" allowfullscreen></iframe>
				</div>
				<?php
			endif
			?>
		</div>
	</section>
	<?php
endif;
?>