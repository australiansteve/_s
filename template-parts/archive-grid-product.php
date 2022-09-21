<?php
$thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url($post, 'archive-image') : wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'archive-image')[0]; 

global $product;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="grid-x grid-margin-x">
		<div class="cell">
			<img src='<?php echo $thumbnail; ?>' onclick="return quick_view_product(jQuery(this), <?php echo get_the_ID();?>);" title="<?php _e('Quick View'); ?>" data-open="quickViewModal"/>
		</div>
		<div class="cell">
			<h3 class="product-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>

			<div class="grid-x grid padding-x">
				<div class="cell">
					<?php
					get_template_part('template-parts/add-to-cart', get_post_type(), $args);
					?>
				</div>
			</div>
		</div>
	</div>
		
</article><!-- #post-<?php the_ID(); ?> -->
