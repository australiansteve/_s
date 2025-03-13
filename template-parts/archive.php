<?php
$thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url($post, 'archive-image') : wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'archive-image')[0]; 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<a href="<?php echo the_permalink();?>">
		<img src='<?php echo $thumbnail; ?>' />
		<h5 class="page-title"><?php the_title();?></h5>
		
	</a>

	<?php if (has_category('Events')):?>
		<div class="excerpt date"><?php echo get_field('event_date');?></div>
	<?php else : ?>
		<?php get_template_part( 'template-parts/excerpt', get_post_type() ); ?>
	<?php endif; ?>

	<div class="more"><a class="button" href="<?php echo the_permalink();?>"><?php echo get_field('read_more_text', 'options'); ?></a></div>
	
</article><!-- #post-<?php the_ID(); ?> -->
