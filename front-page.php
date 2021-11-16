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
					<?php 
					get_template_part('template-parts/school-search');
					?>
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