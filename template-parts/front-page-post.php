<?php
$thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url($post, 'polaroid') : wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'polaroid')[0];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<a href="<?php echo the_permalink();?>">
		<div class="polaroid-container">
			<div class="polaroid-frame">
				<img src='<?php echo $thumbnail; ?>' />
			</div>
		</div>
		<h3 class="page-title"><?php the_title();?></h3>
	</a>
		
</article><!-- #post-<?php the_ID(); ?> -->
