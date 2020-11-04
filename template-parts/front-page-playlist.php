<div class="grid-x grid-margin-x">
	<div class="cell">
		<?php echo $section['soundcloud_embed_code']; ?>
		<?php 
		if ($section['button_text']) :
			echo "<a href='".$section['button_ink']."' class='button'>".$section['button_text']."</a>";
		endif;
		?>
	</div>
</div>