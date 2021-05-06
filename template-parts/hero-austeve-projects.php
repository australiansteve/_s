<?php
if ( have_posts() ) :
	?>
	<div class="hero-austeve-projects-background">
		<div class="grid-container">
			<div class="grid-x small-up-2 medium-up-4 align-center austeve-projects-hero">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part('template-parts/hero', 'austeve-project');

				endwhile;
				?>

				<span class="load-more-projects">
				</span>
			</div>
		</div>
	</div>
	<?php
	rewind_posts();
endif;
?>