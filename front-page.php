<?php 

get_header();

?>
	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
		?>

		<div class="page-content">
			<div class="bg-image" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'hero-image');?>);" ></div>
			<div class="grid-y align-center" style="height: 100%;">
				<div class="cell">
					<div class="grid-container">
						<div class="entry-content">
							<div class="white-box">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
<?php

get_footer();
?>