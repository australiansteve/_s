<?php
$term = get_queried_object();

error_log("term: ".print_r($term, true));

$heroImage = get_field('hero_image', $term);

error_log("heroImage: ".print_r($heroImage, true));

if ($heroImage) :
	
	echo wp_get_attachment_image( $heroImage, 'hero-image' );

endif;

?>