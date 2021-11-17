<?php

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<h3 class="page-title"><a href="<?php echo the_permalink();?>"><?php the_title();?></a></h3>
	<div class="post-meta"><?php _e('Posted on: ', 'hamburger-cat');?><?php echo get_the_date(); ?></div>
		
</article><!-- #post-<?php the_ID(); ?> -->
