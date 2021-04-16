<?php
$thumbnail = get_field('logo') ? wp_get_attachment_image_src(get_field('logo'), 'archive-image')[0] : wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'archive-image')[0]; 

$contentBackground = get_field('resources_page_custom_content_background', 'options') ? get_field('resources_page_custom_content_background', 'options') :get_field('default_content_background', 'options');
?>

<div class="entry-content" style="background: <?php echo $contentBackground;?>">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="grid-x">
			<div class="cell medium-5 large-4">
				<img class="image" src='<?php echo $thumbnail; ?>' />
			</div>
			<div class="cell medium-7 large-8">
				<h3 class="page-title"><?php the_title();?></h3>

				<?php the_content(); ?>
				<a class="button" href="<?php echo get_field('url');?>">Visit Website</a>
			</div>
		</div>

	</article><!-- #post-<?php the_ID(); ?> -->

</div>