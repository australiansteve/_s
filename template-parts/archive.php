<?php
$thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url($post, 'archive-image') : wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'archive-image')[0]; 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<a href="<?php echo the_permalink();?>">
		<img class="archive-image" src='<?php echo $thumbnail; ?>' />
		<h4 class="page-title"><?php the_title();?></h4>
		<div class="meta-date"><?php echo get_the_date()?></div>
		<?php get_template_part( 'template-parts/excerpt', get_post_type() ); ?>
	</a>
		
</article><!-- #post-<?php the_ID(); ?> -->
