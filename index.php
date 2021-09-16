<?php 
get_header();
?>
	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/hero-image', get_post_type() );
		?>

		<div class="grid-container">
			<div class="page-content text-center">
				<div class="entry-content">
					<?php the_content(); ?>
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