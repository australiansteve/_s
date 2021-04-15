<?php
$thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url($post, 'archive-image') : wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'archive-image')[0]; 

$contentBackground = get_field('default_content_background', 'options');
?>

<div class="entry-content" style="background: <?php echo $contentBackground;?>">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="grid-x grid-margin-x">
		<div class="cell medium-5 large-4">
			<a href="<?php echo the_permalink();?>">
				<img src='<?php echo $thumbnail; ?>' />
			</a>
		</div>
		<div class="cell medium-7 large-8">
			<a href="<?php echo the_permalink();?>">
				<h3 class="page-title"><?php the_title();?></h3>
				<?php get_template_part( 'template-parts/excerpt', get_post_type() ); ?>
			</a>
		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
</div>