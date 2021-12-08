<?php
$thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url($post, 'archive-image-square') : wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'archive-image-square')[0]; 

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="container bling">
			<img src='<?php echo $thumbnail; ?>' />
		</div>
		<div class="quote-container">
			<div class="quote" data-equalizer-watch="quote-text">
				<?php the_excerpt();?>
			</div>
			<div class="attributed-to text-right">- <?php the_title();?></div>
		</div>
				
</article><!-- #post-<?php the_ID(); ?> -->
