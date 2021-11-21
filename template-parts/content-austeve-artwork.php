<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

?>
<?php
$artwork_gallery = get_field('gallery');

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="grid-x grid-margin-x">
		<div class="cell medium-7">
			<?php $display_image = wp_get_attachment_image_src($artwork_gallery[0], 'artwork-image-large');?>
			<img class="featured-image" src="<?php echo $display_image[0];?>" width="<?php echo $display_image[1];?>" height="<?php echo $display_image[2];?>" data-image-number="1"/>
		</div>
		<div class="cell medium-5">
			<?php the_title('<h1 class="page-title">', '</h1>');?>  

			<?php the_content(); ?>
		</div>
	</div>
	<?php
	if ($artwork_gallery):
		$gallery_count = 1;
		?>
		<div class="grid-x grid-margin-x small-up-2 medium-up-4" id="artwork-gallery">
			
			<?php foreach( $artwork_gallery as $image_id ):
				$display_image = wp_get_attachment_image_src($image_id, 'artwork-image-small');
				$full_image = wp_get_attachment_image_src($image_id, 'full');
				?>
				<div class="cell">
					<img class="" src="<?php echo $display_image[0];?>" width="<?php echo $display_image[1];?>" height="<?php echo $display_image[2];?>" title="<?php echo $display_image[3];?>" data-full-image-url="<?php echo $full_image[0];?>" data-full-image-width="<?php echo $full_image[1];?>" data-full-image-height="<?php echo $full_image[2];?>" data-image-number="<?php echo $gallery_count++;?>"/>
				</div>
			<?php endforeach; ?>

		</div>
		<?php
	endif;
	?>
	<div class="grid-x grid-margin-x">
		<div class="cell text-right">
			<?php get_template_part( 'template-parts/breadcrumbs', get_post_type() ); ?>
		</div>
	</div>
	
</article><!-- #post-<?php the_ID(); ?> -->


<div class="reveal" id="detail-dialog" data-reveal>
	<div class="grid-y align-center" style="height: 100%">
		<div class="cell">

				<div class="slider-container">
					<div class="slider" id="dialog-slider" data-focus="1" data-max-count="<?php echo count($artwork_gallery);?>">
						<?php foreach( $artwork_gallery as $image_id ):
							$full_image = wp_get_attachment_image_src($image_id, 'full');
							?><div class="image-wrapper"><img class="" src="<?php echo $full_image[0];?>" width="<?php echo $full_image[1];?>" height="<?php echo $full_image[2];?>" title="<?php echo $full_image[3];?>" /></div><?php endforeach; ?>
					</div>
					<div class="slider-navigation">
			<div class="grid-y align-center">
				<div class="cell">
					<div class="grid-x">
						<div class="cell small-6 text-left">
							<i class="fas fa-chevron-left fa-3x move-left" data-slider-id="dialog-slider"></i>
						</div>
						<div class="cell small-6 text-right">
							<i class="fas fa-chevron-right fa-3x move-right" data-slider-id="dialog-slider"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
				</div>
		</div>
	</div>
	<button class="close-button" data-close aria-label="Close modal" type="button">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

	<script type="text/javascript">

		jQuery(document).ready(function() {

			var reveal = false;

			var maxHeight = 0;
			jQuery("#detail-dialog img").each(function(){
				if (jQuery(this).height > maxHeight)  {
					maxHeight = jQuery(this.height);
				}
			})
			console.log("max hieght: " + maxHeight);

			var options = { 
				vOffset : window.innerWidth < 640 ? 0 : 75
			};

			jQuery("#artwork-gallery img, .featured-image").on("click", function() {
				var element = jQuery("#detail-dialog");
				if(!reveal) {
					reveal = new Foundation.Reveal(element, options);
				}

				element.foundation('open');

				jQuery("#dialog-slider").attr('data-focus', jQuery(this).data('image-number'));
				jQuery('#dialog-slider').trigger('slider-focus-change');
			});

			jQuery("#detail-dialog .close-button").on('click', function() {
				jQuery("#detail-dialog").foundation('close');
			});

			
		})
	</script>

