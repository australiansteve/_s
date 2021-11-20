<?php

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php echo DateTime::createFromFormat('Ymd', get_field('end_date'))->format('Y'); ?> <?php the_title();?>, <?php the_field('location', false, false);?>
		
</article><!-- #post-<?php the_ID(); ?> -->
