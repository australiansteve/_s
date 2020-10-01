<?php
/**
 * Template Name: About Page 
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

		$section = get_field('landing');
		if ($section) {
			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			?>	
			<div class="grid-container">
				<div class="grid-x">
					<div class="grid-x">
						<div class="cell">
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

			$section = get_field('video');
			if ($section) {

				include( locate_template( 'template-parts/section-header.php', false, false ) ); 
				?>	
				<div class="grid-container">
					
					<?php 
					if ($section['video_url']) :
						?>
						<video playsInline preload="none" src="<?php echo $section['video_url']; ?>">
							  Your browser doesn't support HTML5 video tag.
						</video>
						<?php
					endif; ?>
				</div>
				<?php
				include( locate_template( 'template-parts/section-footer.php', false, false ) ); 

			}

			$section = get_field('meet_the_team');
			if ($section) {

				include( locate_template( 'template-parts/section-header.php', false, false ) ); 
				?>	
				<div class="grid-container">
					<div class="grid-x">
						<div class="cell">
							<h2><?php echo $section['title']; ?></h2>
							<?php echo $section['intro_text']; ?>

							<div class="grid-x small-up-1 medium-up-2" id="team-members-grid">
								<?php
								foreach($section['team_members'] as $teamMember) {
									?>
									<div class="cell">
									<?php
									$image = $teamMember['image'];
									$size = 'square-large';
									
									if( $image ) {
										echo wp_get_attachment_image( $image, $size );
									}

									echo "<div class='name'>".$teamMember['name']."</div>";
									echo "<div class='position'>".$teamMember['position']."</div>";
									?>
								</div>
								<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
				<?php
				include( locate_template( 'template-parts/section-footer.php', false, false ) ); 

			}

			$section = get_field('contact');
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
