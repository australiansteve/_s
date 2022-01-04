<?php 

get_header();

?>
<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/hero-image-front-page', get_post_type() );
		?>

		<div class="page-content">
			<div class="grid-container">
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>


		<?php

		$tax_query = array(
			array(
				'taxonomy'         => 'category',
				'terms'            => 'featured',
				'field'            => 'slug',
				'operator'         => 'IN',
			),
		);

		// WP_Query arguments
		$args = array(
			'post_type'				=> array( 'post' ),
			'post_status'			=> array( 'publish' ),
			'tax_query'				=> $tax_query,
		);

		// The Query
		$query = new WP_Query( $args );

		// The Loop
		if ( $query->have_posts() ) {
			$postCount = 1;
			?>

			<div class="grid-container">
				<div id="featured-posts">
					<?php
					while ( $query->have_posts() ) {
						$query->the_post();
						?>
						<?php get_template_part( 'template-parts/front-page', get_post_type(), array( 
							'post_count' => $postCount++) ); ?>
						<?php
					}
					?>
				</div>

				<div class="grid-x">
					<div class="cell text-center">
						<div class="entry-content all-posts-link">
							<h3><a href="<?php the_permalink(get_option('page_for_posts')); ?>"><?php the_field('home_page_all_news_link_text', 'option'); ?></a></h3>
						</div>
					</div>
				</div>
			</div>

			<?php
		} 
		// Restore original Post Data
		wp_reset_postdata();

	endwhile;
	?>

</main><!-- #main -->
<?php  get_template_part( 'template-parts/reveal-video-modal', get_post_type() ); ?>

<?php

get_footer();
?>