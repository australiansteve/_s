<?php
$thumbnail = get_field('cover_image') ? wp_get_attachment_image_src(get_field('cover_image'), 'archive-image')[0] : wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'archive-image')[0]; 

$contentBackground = get_field('default_content_background', 'options');
?>

<div class="entry-content" style="background: <?php echo $contentBackground;?>">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="grid-x">
			<div class="cell medium-5 large-4">
				<a href="<?php echo the_permalink();?>">
					<img class="image" src='<?php echo $thumbnail; ?>' />
				</a>
			</div>
			<div class="cell medium-7 large-8">
				<a href="<?php echo the_permalink();?>">
					<h3 class="page-title"><?php the_title();?></h3>
				</a>
				<div class="event-date"><?php the_field('event_date');?></div>

				<?php get_template_part( 'template-parts/excerpt', get_post_type() ); ?>
				<?php if (get_field('eventbrite_link')) : ?><a class="button" href="<?php echo get_field('eventbrite_link');?>"><?php echo get_field('eventbrite_button_text');?></a> <?php endif;?><a class="button" href="<?php echo the_permalink();?>">Read More</a>
			</div>
		</div>

	</article><!-- #post-<?php the_ID(); ?> -->

</div>