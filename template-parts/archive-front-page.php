<?php
$thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url($post, 'archive-image') : wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'archive-image')[0]; 

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<a href="<?php echo the_permalink();?>">
		<div class="container bling">
			<img src='<?php echo $thumbnail; ?>' />
		</div>
		<h3 class="page-title"><?php the_title();?></h3>
		<?php get_template_part( 'template-parts/excerpt-date-only', get_post_type() ); ?>
	</a>
		
</article><!-- #post-<?php the_ID(); ?> -->
