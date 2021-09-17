<?php
$thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url($post, 'archive-landscape') : wp_get_attachment_image_src( get_field('default_placeholder_image_landscape', 'options'), 'archive-landscape')[0]; 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="grid-x grid-margin-x">
		<div class="cell medium-6">
			<img src='<?php echo $thumbnail; ?>' />
		</div>
		<div class="cell medium-6">
			<a href="<?php echo the_permalink();?>"><h5 class="page-title"><?php the_title();?></h5></a>
			<?php get_template_part( 'template-parts/excerpt', get_post_type() ); ?>
			<div class="more"><a class="button" href="<?php echo the_permalink();?>"><?php _e('More', 'hamburger-cat'); ?></a></div>
		</div>
	</div>
	
</article><!-- #post-<?php the_ID(); ?> -->
