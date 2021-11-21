<?php
$thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url($post, 'archive-image-square') : wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'archive-image-square')[0]; 

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="container bling">
			<img src='<?php echo $thumbnail; ?>' />
		</div>
		<h3 class="page-title"><?php the_title();?></h3>

		<a class="button" href="<?php echo the_permalink();?>"><?php _e('Read More', 'hamburger-cat'); ?></a>
		
</article><!-- #post-<?php the_ID(); ?> -->
