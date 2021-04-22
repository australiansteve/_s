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
				<div class="grid-x">

					<div class="cell">
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					</div>

				</div>

				<div class="grid-x">
					<div class="cell small-12">
						<h2 class="title featured-funds">Featured Funds</h2>

						<?php get_template_part( 'template-parts/austeve-funds', 'featured-snippet' ); ?>

					</div>	
				</div>

				<?php
				$bgColor = get_field('featured_post_background_color', 'option');
				if(!$bgColor):
					$bgColor = '#7fb955';
				endif;

				$featuredPostsArgs = array(
					'post_type'				=> array( 'post' ),
					'post_status'           => array( 'publish' ),
					'tax_query'				=> array(
						'relation' => 'AND',
						array(
							'taxonomy'         => 'category',
							'terms'            => 'featured',
							'field'            => 'slug',
							'operator'         => 'IN',
							'include_children' => false,
						),
					),
					'posts_per_page'		=> get_field('number_featured_posts_on_home_page')
				);

				$featuredPostsQuery = new WP_Query( $featuredPostsArgs );
				if ( $featuredPostsQuery->have_posts() ) :
					?>
					<h2 class="title featured-post">Featured Story</h2>	
					<div class="grid-x align-middle" id="featured-post" style="background-color:<?php echo $bgColor;?>">
						<?php
						$counter = 0;
						while ( $featuredPostsQuery->have_posts() ) : 
							$featuredPostsQuery->the_post();
							if ($counter++ % 2 == 0)
							{
								get_template_part( 'template-parts/post', 'featured' );
							}
							else {
								get_template_part( 'template-parts/post', 'featured-even' );
							}
						endwhile; 
						?>
					</div>
					<?php
				endif;
				wp_reset_postdata();
				?>	

				<div class="grid-x" id="more-stories">
					<div class="cell">
						<div class="action">		
							<a class="button" href="<?php echo get_permalink(get_option('page_for_posts')); ?>"><?php the_field('more_stories_button_text')?></a>
						</div>
					</div>
				</div>

				<div class="grid-x" id="what-is-cf">
					<div class="cell small-12">
						<h2 class="title">What is a Community Foundation?</h2>

						<?php $image = get_field('what_is_cf_image');

						if( !empty($image) ): ?>

							<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

						<?php endif; ?>

					</div>
				</div>

			</div>
		</div>

		<?php
	endwhile;
	?>

</main><!-- #main -->
<?php

get_footer();
?>