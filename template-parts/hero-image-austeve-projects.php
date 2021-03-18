<?php
if (get_field('display_hero_image') && has_post_thumbnail($post)) :
	the_post_thumbnail( 'hero-image' );
endif;
?>