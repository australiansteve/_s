<?php
/**
 * Front page template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();

		$sectionId = 'landing';
		$section = get_field($sectionId);
		if ($section) {
			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			?>	
			<div class="grid-container">
				<div class="grid-x">
					<div class="cell">
						<?php 
						$image = $section['logo'];
						$size = 'rect-large'; 

						if( $image ) {
							echo wp_get_attachment_image( $image, $size );
						}
						?>
					</div>
				</div>
				<div class="grid-x">
					<div class="cell intro-text">
						<?php 
						echo $section['intro_text'];
						?>
						<a href="<?php echo $section['button_link'];?>" class="button"><?php echo $section['button_text'];?></a>
					</div>
				</div>
			</div>
			<?php
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 

		}

		$sectionId = 'video';
		$section = get_field($sectionId);
		if ($section && $section['video_url']) {

			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			?>
				<?php include(locate_template( 'template-parts/about-video.php', false, false)); ?>

				<div class="grid-x" id="find-out-more">
					<div class="cell">
						<a href="<?php echo $section['button_link'];?>" class="button"><?php echo $section['button_text'];?></a>
					</div>
				</div>
			<?php
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 

		}

		$sectionId = 'projects';
		$section = get_field($sectionId);
		if ($section) {

			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			?>
			<div class="grid-container">
				<div class="white-content-container">
					<div class="grid-x">
						<div class="cell text-center">
							<h2><?php echo $section['section_title'];?></h2>

							<?php include( locate_template( 'template-parts/section-projects.php', false, false )); ?>
						</div>
					</div>
				</div>
			</div>
			<?php
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 

		}

		$sectionId = 'contact';
		$section = get_field($sectionId);
		if ($section) {

			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			?>	
			<div class="grid-container">
				<div class="grid-x">
					<div class="cell">
						<?php echo do_shortcode("[ninja_forms id='".$section['ninja_form_id']."']");?>
					</div>
				</div>
			</div>
			<?php
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 

		}

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	<?php
	get_footer();
