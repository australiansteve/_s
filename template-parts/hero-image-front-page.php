<?php
?>
<section id="section-1">
	<?php $slider_gallery = get_field('section_1_slider_images');?>
	<div class="slider-container">
		<div class="slider" id="front-page-slider" data-slider-time="5000" data-focus="1" data-max-count="<?php echo count($slider_gallery);?>">
			<?php foreach( $slider_gallery as $image_id ):
				$full_image = wp_get_attachment_image_src($image_id, 'hero-image');
				?><div class="image-wrapper"><img class="size-hero-image" src="<?php echo $full_image[0];?>"/></div><?php endforeach; ?>
		</div>
		<div class="slider-navigation">
			<div class="grid-y align-center">
				<div class="cell">
					<div class="grid-x">
						<div class="cell small-6 text-left">
							<i class="fas fa-chevron-left fa-3x move-left" data-slider-id="front-page-slider"></i>
						</div>
						<div class="cell small-6 text-right">
							<i class="fas fa-chevron-right fa-3x move-right" data-slider-id="front-page-slider"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>