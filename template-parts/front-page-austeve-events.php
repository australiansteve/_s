<?php
$thumbnail = get_field('cover_image') ? wp_get_attachment_image_src(get_field('cover_image'), 'archive-image')[0] : wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'archive-image')[0]; 

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-background-url="<?php echo $thumbnail;?>">

		<div class="background-image" style="background-image:url();"></div>

		<div class="content-container">
			<h4 class="title"><?php the_title();?></h4>
			<div class="event-date"><?php the_field('event_date');?></div>
			<?php get_template_part( 'template-parts/excerpt', get_post_type() ); ?>
			<div class="actions">
				<a class="button" href="<?php echo get_field('eventbrite_link');?>"><?php echo get_field('eventbrite_button_text');?></a> <a class="button" href="<?php echo the_permalink();?>">Read More</a>
			</div>
		</div>

</article><!-- #post-<?php the_ID(); ?> -->
