<?php
$images = get_field('project-gallery', $post);
error_log("Gallery: " . print_r($images, true));

$thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url($post, 'archive-image') : 
	($images ? $images[0]['sizes']['archive-image'] : 
		wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'archive-image')[0]); 

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<a href="<?php echo the_permalink();?>">
		<div class="bling container">
			<img src='<?php echo $thumbnail; ?>' width="800" height="470"/>
		</div>
		<h4 class="post-title"><?php the_title();?></h4>
		<?php get_template_part( 'template-parts/excerpt', get_post_type() ); ?>
	</a>
		
</article><!-- #post-<?php the_ID(); ?> -->
