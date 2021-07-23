<?php
 /**
 * Template Name: About Page
 */

 get_header();
 ?>

 <main id="primary" class="site-main">

 	<?php

 	while ( have_posts() ) :
 		the_post();

 		?>

 		<div class="grid-container">
 			<div class="page-content">

 				<section id="section-1">
 					<div class="entry-content">
 						<h2 class="page-title"><span><?php the_field('section_1_title');?></span></h2>
 						<div class="grid-x">
 							<div class="cell medium-6 medium-order-2">
 								<?php 
 								$image = get_field('section_1_image');
 								$size = 'about-portrait'; 

 								if( $image ) {
 									echo wp_get_attachment_image( $image, $size );
 								}
 								?>
 							</div>
 							<div class="cell medium-6 medium-order-1" id="section-1-text">
 								<?php the_field('section_1_text');?>
 							</div>
 							
 						</div>
 					</div>
 				</section>

 				<section id="section-2">
 					<div class="entry-content no-padding" id="section-2-content">
 						<div class="iframe-container">
 							<iframe class="responsive" src="https://player.vimeo.com/video/<?php the_field('section_2_video_id');?>?color=c02c8b&title=0&byline=0&portrait=0&autoplay=0&loop=0&autopause=0&muted=0&controls=1&background=0" frameborder="0"allow="autoplay; fullscreen; picture-in-picture" muted autoplay></iframe>
 						</div>
 					</div>
 				</section>

 				<section id="section-3">
 					<div class="entry-content">
 						<h2 class="page-title"><span><?php the_field('section_3_title');?></span></h2>
 						<div class="grid-x">
 							<div class="cell medium-6">
 								<?php 
 								$image = get_field('section_3_image');
 								$size = 'about-portrait'; 

 								if( $image ) {
 									echo wp_get_attachment_image( $image, $size );
 								}
 								?>
 							</div>
 							<div class="cell medium-6" id="section-3-text">
 								<?php the_field('section_3_text');?>
 							</div>
 						</div>
 					</div>
 				</section>

 			</div> 
 		</div>

 		<?php

 	endwhile;
 	?>

 </main><!-- #main -->

 <?php
 get_footer();
