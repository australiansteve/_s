<?php 
$buttonText = get_field('more_information_button', 'options');
if(get_field('custom_archive_button_text')) {
	$buttonText = get_field('custom_archive_button_text');
}
?>
<div class="cell text-center">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="post-image"><?php the_post_thumbnail('archive-square');?></div>
		<div class="post-title" data-equalizer-watch><?php the_title();?></div>
		<div class="post-more-information"><a class="button" href="<?php the_permalink();?>"><?php echo $buttonText;?></a></div>
	</article><!-- #post-<?php the_ID(); ?> -->
</div>