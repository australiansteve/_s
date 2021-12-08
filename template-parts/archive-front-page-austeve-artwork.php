<?php
$gallery = get_field('gallery');
$thumbnail = $gallery && count($gallery) > 0 ? wp_get_attachment_image_src($gallery[0], 'archive-image')[0] : wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'archive-image')[0]; 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<a href="<?php echo the_permalink();?>" title="<?php the_title();?>">
		<img class="archive-image" src='<?php echo $thumbnail; ?>' title="<?php the_title();?>" />
	</a>
		
</article><!-- #post-<?php the_ID(); ?> -->
