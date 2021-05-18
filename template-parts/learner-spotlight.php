<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<h3 class="page-title"><?php the_title();?></h3>
		
		<div class="grid-x">
			<div class="cell medium-9 large-7">
				<?php the_excerpt();?>
				
				<a href="<?php the_permalink();?>" class="button"><?php the_field('learn_more_button_text', 'options'); ?></a>
			</div>
		</div>

		
		<div class="highlight-cluster">
			<div class="grid-x">
				<div class="cell medium-8 medium-offset-2 large-6 large-offset-3">
					<?php the_post_thumbnail('full');?>
				</div>
			</div>

			<div class="overlay"> 
				<div class="grid-x">
					<div class="cell medium-4 medium-offset-8">
						<div style="background: orange;" class="feature-quote">
							Feature quote
						</div>
					</div>
				</div>

				<div class="grid-x">
					<div class="cell medium-6">
						<?php 
						$image = get_field('secondary_feature_image');
						$size = 'full'; // (thumbnail, medium, large, full or custom size)
						
						if( $image ) {
							echo wp_get_attachment_image( $image, $size );
						}
						?>
					</div>
				</div>
			</div>
		</div>

</article><!-- #post-<?php the_ID(); ?> -->

<script type="text/javascript">
	jQuery(document).on('ready', function() {

			jQuery(this).find(".overlay").each(function(){
			    var quoteHeight = jQuery(this).find(".feature-quote").outerHeight();
			    var adjustmentHeight = (jQuery(this).outerHeight() - quoteHeight - 100);
			    console.log(jQuery(this).outerHeight());
			    console.log(quoteHeight);
			    console.log(adjustmentHeight);

			    jQuery(this).css("bottom", (adjustmentHeight * -1) + "px");
				jQuery(this).parents("article.category-learner-spotlight").css("padding-bottom", (adjustmentHeight < 100 ) ? 100 : adjustmentHeight + "px");
			});


		
	});
</script>