<?php 

get_header();

?>
<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/hero-image', get_post_type() );
		?>

		<div class="page-content">
			<div class="grid-container">
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>


		<?php
		$date = new DateTime();
		$date->sub(new DateInterval('P30D'));
		error_log($date->format('Y-m-d'));

		// WP_Query arguments
		$args = array(
			'post_type'              => array( 'post' ),
			'post_status'            => array( 'publish' ),
			'date_query'             => array(
				array(
					'after' => array(
						'year'  => $date->format('Y') ,
						'month' => $date->format('m') ,
						'day'   => $date->format('d') ,
					),
				),
			),
		);

		// The Query
		$query = new WP_Query( $args );

		// The Loop
		if ( $query->have_posts() ) {
			?>

			<div id="news-ticker" class="marquee">
				<div class="container">
					<?php
					while ( $query->have_posts() ) {
						$query->the_post();
						?>
						<span class="ticker-container">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo get_the_date('j M Y'); ?>: <?php echo get_the_excerpt(); ?> <?php the_field('read_more_text', 'option'); ?></a>
						</span>
						<?php
					}
					?>
				</div>
			</div>
			<div class="all-news-link">
				<div class="grid-container">
					<div class="entry-content">
						<h3><a href="<?php the_permalink(get_option('page_for_posts')); ?>"><?php the_field('home_page_all_news_link_text', 'option'); ?></a></h3>
					</div>
				</div>
			</div>
			
			<?php
		} 
		// Restore original Post Data
		wp_reset_postdata();

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
	<?php

	get_footer();
	?>