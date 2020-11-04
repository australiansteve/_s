<?php
/* Artist details */
?>
<div class="portfolio-artist">
	<div class="grid-x grid-margin-x">
		<div class="cell small-12 medium-8">			
			<?php the_post_thumbnail( 'full' ); ?>
			<?php get_template_part( 'template-parts/artist', 'bandcamp' ); ?>				
		</div>		
		<div class="cell small-12 medium-4 ">
			<?php get_template_part( 'template-parts/artist', 'details' ); ?>
		</div>
	</div>
</div>