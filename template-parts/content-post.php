<?php
$featureVideo = get_field('feature_video');
$postImageContent = get_the_post_thumbnail(get_the_ID(), 'featured-image-skinny');
if($featureVideo) {
	$postImageContent = "<div class='iframe-container'>".$GLOBALS['wp_embed']->run_shortcode( "[embed width='100%']".$featureVideo."[/embed]" )."</div>";
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-container">
		<h1 class="page-title"><?php the_title();?></h1>

		<div class="post-image"><?php echo $postImageContent; ?></div>

		<div class="post-content">
		<?php the_content();?>
		</div>

		<div class="grid-x navigation">
			<div class="cell small-6 text-right medium-4 medium-order-1">
				<?php echo get_next_post_link(
					'%link',
					'<i class="fas fa-2x fa-chevron-left"></i> <span class="nav-title screen-reader-text">%title</span>'
				); ?>
			</div>
			<div class="cell small-6 text-left medium-4 medium-order-3">
				<?php echo get_previous_post_link(
					'%link',
					'<i class="fas fa-2x fa-chevron-right"></i> <span class="nav-title screen-reader-text">%title</span>'
				); ?>
			</div>
			<div class="cell text-center medium-4 medium-order-2">
				<a class="button" href="<?php echo get_post_type_archive_link(get_post_type());?>"><?php echo the_field('back_to_blog_button_text', 'options');?></a>
			</div>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
