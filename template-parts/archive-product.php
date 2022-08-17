<?php
$thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url($post, 'archive-image') : wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'archive-image')[0]; 

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	
		<img src='<?php echo $thumbnail; ?>' />
		<h3 class="page-title"><?php the_title();?></h3>

		<button class="button" onclick="return add_to_cart(jQuery(this), <?php echo get_the_ID();?>, null, getCookie('wishlist_id'));">
			Add to cart
		</a>
		
</article><!-- #post-<?php the_ID(); ?> -->
