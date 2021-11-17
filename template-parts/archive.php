
<?php
$thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url($post, 'archive-image') : wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'archive-image')[0]; 

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<a href="<?php echo the_permalink();?>">
		<img src='<?php echo $thumbnail; ?>' />
		<h3 class="page-title"><?php the_title();?></h3>
	</a>
	<?php get_template_part( 'template-parts/archive-excerpt', get_post_type() ); ?>
		
</article><!-- #post-<?php the_ID(); ?> -->
