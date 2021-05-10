<?php
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="date"><?php echo get_the_date('j M Y'); ?></div>
	<h3 class="page-title"><?php the_title();?></h3>
	<?php get_template_part( 'template-parts/excerpt', get_post_type() ); ?>
	
	<a class="read-more" href="<?php the_permalink(); ?>"><?php the_field('read_more_text', 'option'); ?></a>
		
</article><!-- #post-<?php the_ID(); ?> -->
