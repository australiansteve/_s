<?php
$thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url($post, 'archive-image') : wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'archive-image')[0];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="grid-x grid-margin-x text-left">
		<div class="cell small-9">
			<h3 class="post-title"><?php the_title();?></h3>
		</div>
		<div class="cell small-3 text-right">
			<a class="button" href="<?php the_field('wishlist_url');?>" target="_blank"><?php _e('View Wishlist', 'hamburger-cat'); ?></a>
		</div>
		
</article><!-- #post-<?php the_ID(); ?> -->
