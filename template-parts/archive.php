
<?php
$image_id = has_post_thumbnail() ? get_post_thumbnail_id() : get_field('default_placeholder_image', 'options');
$thumbnail = wp_get_attachment_image_src( $image_id, 'archive-image')[0]; 
$caption = wp_get_attachment_caption($image_id);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<a href="<?php echo the_permalink();?>">
		<img src='<?php echo $thumbnail; ?>' />
		<?php echo ($caption) ? "<figcaption class='caption'>".$caption."</figcaption>" : ""; ?>
		<h3 class="page-title"><?php the_title();?></h3>
	</a>
	<?php get_template_part( 'template-parts/archive-excerpt', get_post_type() ); ?>
		
</article><!-- #post-<?php the_ID(); ?> -->
