<?php
if ($section3VideoId) :
	?>
	<section id="section-3">
		<div class="entry-content" id="section-3-content">
			<?php echo $section3Title ? "<h3 class='section-title'>".$section3Title."</h3>" : ""; ?>
			<div class="iframe-container">
				<iframe class="responsive" src="https://player.vimeo.com/video/<?php echo $section3VideoId;?>?color=c02c8b&title=0&byline=0&portrait=0&autoplay=0&loop=0&autopause=0&muted=0&controls=1&background=0" frameborder="0"allow="autoplay; fullscreen; picture-in-picture" muted autoplay></iframe>
			</div>
		</div>
	</section>
	<?php
endif;
?>