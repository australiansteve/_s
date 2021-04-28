<?php
global $post;
$thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url($post, 'archive-image') : wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'archive-image')[0]; 
error_log("fetaured thumbnail: ".$thumbnail);
?>
<div class="cell small-12">
	<div class="grid-x align-middle container">
		<div class="cell small-12 medium-4 large-7 featured-post-image">
			<?php
			$video = get_field('post_video'); 
			if ($video) :
			?>
						<div class="embed-container" data-equalizer-watch="box">
							<?php echo $video; ?>
						</div>
			<?php
				else:
			?>
						<div class="image-container" data-equalizer-watch="box">
							<img src='<?php echo $thumbnail; ?>' width="100%"/>
						</div>
			<?php
				endif;
				//Else display image
			?>
		</div>
		<div class="cell small-12 medium-8 large-5 featured-post-content">
				<div class="grid-x featured-post-content container content align-middle" data-equalizer-watch="box">
					<div class="cell small-12">

						<?php the_title('<h3>', '</h3>'); ?>
						
						<div class="excerpt">
							<?php the_excerpt(); ?>
						</div>

						<div class="action">		
							<a class="button" href="<?php the_permalink();?>">READ MORE</a>
						</div>

					</div>
				</div>
		</div>
	</div>
</div>