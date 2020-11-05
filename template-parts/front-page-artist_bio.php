<div class="grid-x grid-margin-x">
	<div class="cell">
		<h2><?php echo $section['title']; ?></h2>
		<div id="artist-bio-text"><?php echo $section['text']; ?></div>
		<?php echo wp_get_attachment_image($section['image'], 'full'); ?>
	</div>
</div>