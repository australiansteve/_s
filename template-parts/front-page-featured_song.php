<div class="embed-width-match">
	<div class="grid-x grid-margin-x">
		<div class="cell" id="featured-song-title">
			<h2><?php echo $section['title']; ?></h2>
		</div>
	</div>

	<div class="grid-x grid-margin-x">
		<div class="cell medium-4" id="featured-song-embed">
			<?php 
			echo wp_get_attachment_image($section['image'], 'large-square');
			echo $section['soundcloud_embed_code']; 
			// if ($section['soundcloud_embed_code']) :
				
			// else :

			// endif;
			?>
		</div>
		<div class="cell medium-8" id="featured-song-description">
			<?php 
			echo $section['text']; 
			if ($section['button_text']) :
				echo "<a href='".$section['button_link']."' class='button'>".$section['button_text']."</a>";
			endif;
			?>

		</div>
	</div>
</div>