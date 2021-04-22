<div class="grid-x" id="featured-funds">

<?php
$featuredFundsArgs = array(
	'post_type'				=> array( 'austeve-funds' ),
	'post_status'           => array( 'publish' ),
	'tax_query'				=> array(
		'relation' => 'AND',
		array(
			'taxonomy'         => 'austeve-funds-category',
			'terms'            => 'featured',
			'field'            => 'slug',
			'operator'         => 'IN',
			'include_children' => false,
		),
	),
	'posts_per_page'		=> 2
);
//error_log(print_r($featuredFundsArgs, true));

// The Query
$featuredFundsQuery = new WP_Query( $featuredFundsArgs );
if ( $featuredFundsQuery->have_posts() ) :
	while ( $featuredFundsQuery->have_posts() ) : 
		$featuredFundsQuery->the_post();
		get_template_part( 'template-parts/austeve-funds', 'featured' );
	endwhile; 
endif;
wp_reset_postdata();
?>			
</div>