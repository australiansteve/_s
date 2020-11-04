<div class="grid-x grid-margin-x">
	<div class="cell">
		<h2><?php echo $section['title']; ?></h2>
	</div>
</div>

<div class="grid-x grid-margin-x">
	<div class="cell medium-4">
		<?php echo wp_get_attachment_image($section['image'], 'large-square'); ?>
	</div>
	<div class="cell medium-8">
		<?php 
		echo $section['text']; 
		if ($section['button_text']) :
			echo "<a href='".$section['button_ink']."' class='button'>".$section['button_text']."</a>";
		endif;
		?>

	</div>
</div>

<div class="grid-x grid-margin-x">
	<div class="cell">
		<?php echo $section['soundcloud_embed_code']; ?>
	</div>
</div>