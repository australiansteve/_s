<?php

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php the_title();?>, <?php the_field('location', false, false);?>, <?php the_field('date', false, false); ?>
		
</article><!-- #post-<?php the_ID(); ?> -->
