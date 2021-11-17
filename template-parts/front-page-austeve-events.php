<?php
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<h3 class="post-title" data-equalizer-watch="events-title"><?php the_title();?></h3>
	
	<div class="location" data-equalizer-watch="events-location"><?php the_field('location'); ?>
		
	</div>
	
	<div class="date"><?php the_field('date'); ?></div>

</article><!-- #post-<?php the_ID(); ?> -->
