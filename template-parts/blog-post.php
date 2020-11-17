<?php
$featureVideo = get_field('feature_video');
$postImageContent = get_the_post_thumbnail(get_the_ID(), 'featured-image-skinny');
if($featureVideo) {
	$postImageContent = "<div class='iframe-container'>".$GLOBALS['wp_embed']->run_shortcode( "[embed width='100%']".$featureVideo."[/embed]" )."</div>";
}
?>
<div class="cell text-left">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="post-image"><?php echo $postImageContent; ?></div>
		<div class="post-title"><h3><?php the_title();?></h3></div>
		<div class="post-excerpt"><?php the_excerpt();?></div>
		<div class="post-more-information"><a class="button" href="<?php the_permalink();?>"><?php the_field('read_more_button', 'options');?></a></div>
	</article><!-- #post-<?php the_ID(); ?> -->
</div>