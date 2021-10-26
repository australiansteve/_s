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

				<?php
				$section1VideoId = get_field('video_id_1');
				$section1VideoType = get_field('video_type_1');

				if ($section1VideoId) :
					?>
					<section id="section-1">
						<div class="entry-content no-padding" id="section-1-content">
							<?php

							if ($section1VideoType == 'vimeo') :
								?>
								<div class="iframe-container">
									<iframe class="responsive" src="https://player.vimeo.com/video/<?php echo $section1VideoId;?>?color=c02c8b&title=0&byline=0&portrait=0&autoplay=0&loop=0&autopause=0&muted=0&controls=1&background=0" frameborder="0"allow="autoplay; fullscreen; picture-in-picture" muted autoplay></iframe>
								</div>
								<?php
							elseif ($section1VideoType == 'youtube') :
								?>
								<div class="iframe-container">
									<iframe class="responsive" src="https://www.youtube.com/embed/<?php echo $section1VideoId;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope" allowfullscreen></iframe>
								</div>
								<?php
							endif;
							?>
						</div>
					</section>
					<?php
				endif;

				$section2LinkText = get_field('link_text_2');
				$section2LinkUrl = get_field('link_url_2');
				$section2LinkInNewTab = get_field('link_open_in_new_tab_2');

				if ($section2LinkText && $section2LinkUrl) :
					?>
					<section id="section-2">
						<div class="entry-content no-padding no-background text-center" id="section-2-content">
							<a href="<?php echo $section2LinkUrl;?>" class="button" <?php echo $section2LinkInNewTab ? "target='blank'" : "";?>><?php echo $section2LinkText;?></a>
						</div>
					</section>
					<?php
				endif;

				//Get all the content for sections 3-10
				$section3Title = get_field('title_3');
				$section3VideoId = get_field('video_id_3');
				$section3VideoType = get_field('video_type_3');
				$section4Title = get_field('title_4');
				$section4Text = get_field('text_4');
				$section5Title = get_field('title_5');
				$section5Text = get_field('text_5');
				$section6Title = get_field('title_6');
				$section6Text = get_field('text_6');
				$section7Title = get_field('title_7');
				$section7Text = get_field('text_7');
				$section8Title = get_field('title_8');
				$section8Text = get_field('text_8');
				$section9Title = get_field('title_9');
				$section9Text = get_field('text_9');
				$section10Title = get_field('title_10');
				$section10Text = get_field('text_10');
				$section11Title = get_field('title_11');
				$section11Text = get_field('text_11');
				$section11Gallery = get_field('gallery_11');

				?>

				<div class="show-for-small-only">
					<?php
					include( locate_template( 'template-parts/front-page/section-3.php', false, false ) ); 
					
					include( locate_template( 'template-parts/front-page/section-4.php', false, false ) ); 
					
					include( locate_template( 'template-parts/front-page/section-5.php', false, false ) ); 
					
					include( locate_template( 'template-parts/front-page/section-6.php', false, false ) ); 
					
					include( locate_template( 'template-parts/front-page/section-7.php', false, false ) ); 
					
					include( locate_template( 'template-parts/front-page/section-8.php', false, false ) ); 
					
					include( locate_template( 'template-parts/front-page/section-9.php', false, false ) ); 
					
					include( locate_template( 'template-parts/front-page/section-10.php', false, false ) ); 
					?>
				</div>

				<div class="grid-x show-for-medium">
					<div class="cell medium-6">
						<div class="left-column">
							<?php
							include( locate_template( 'template-parts/front-page/section-3.php', false, false ) ); 

							include( locate_template( 'template-parts/front-page/section-5.php', false, false ) ); 

							include( locate_template( 'template-parts/front-page/section-7.php', false, false ) ); 

							include( locate_template( 'template-parts/front-page/section-9.php', false, false ) ); 
							?>
						</div>
					</div>
					<div class="cell medium-6">
						<div class="right-column">
							<?php
							include( locate_template( 'template-parts/front-page/section-4.php', false, false ) ); 

							include( locate_template( 'template-parts/front-page/section-6.php', false, false ) ); 

							include( locate_template( 'template-parts/front-page/section-8.php', false, false ) ); 

							include( locate_template( 'template-parts/front-page/section-10.php', false, false ) ); 
							?>
						</div>
					</div>
				</div>

				<div class="grid-x">
					<div class="cell">
						<?php
							include( locate_template( 'template-parts/front-page/section-11.php', false, false ) ); 
						?>
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