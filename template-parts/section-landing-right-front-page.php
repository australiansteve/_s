<div class="polaroids-container">
	<div class="polaroid-container">
		<div class="polaroid-frame">
			<?php 
			$image = get_field('landing_polaroid_1');
			$size = 'polaroid-portrait'; 

			if( $image ) {
				echo wp_get_attachment_image( $image, $size );
			}
			?>
		</div>
	</div>
	<div class="polaroid-container">
		<div class="polaroid-frame">
			<?php 
			$image = get_field('landing_polaroid_2');
			$size = 'polaroid-portrait'; 

			if( $image ) {
				echo wp_get_attachment_image( $image, $size );
			}
			?>
		</div>
	</div>
</div>