<div class="grid-x grid-margin-x">
	<div class="cell">
		<div id="playlist-embed">
			<?php echo $section['embed_code']; ?>
		</div>

		<?php 
		if ($section['button_text']) :
			?>
			<div id="playlist-button">
				<?php
				echo "<a href='".$section['button_ink']."' class='button'>".$section['button_text']."</a>";
				?>
			</div>
			<?php
		endif;
		?>
	</div>
</div>