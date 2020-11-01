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

		$sectionId = 'landing';
		$section = get_field($sectionId);
		if ($section) {
			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			?>	
			<div class="grid-container">
				<div class="white-content-container">
					<div class="grid-x">
						<div class="grid-x">
							<div class="cell">

								<div class="page-title">
									<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
								</div>

								<?php 
								echo $section['intro_text'];
								?>
								<a href="<?php echo $section['button_link'];?>" class="button"><?php echo $section['button_text'];?></a>
							</div>
						</div>
					</div>
				</div>
				<?php
				include( locate_template( 'template-parts/section-footer.php', false, false ) ); 

			}

			$sectionId = 'video';
			$section = get_field($sectionId);
			if ($section) {

				include( locate_template( 'template-parts/section-header.php', false, false ) ); 
				?>

				<?php include(locate_template( 'template-parts/about-video.php', false, false)); ?>

				<?php
				include( locate_template( 'template-parts/section-footer.php', false, false ) ); 

			}

			$sectionId = 'meet_the_team';
			$section = get_field($sectionId);
			if ($section) {

				include( locate_template( 'template-parts/section-header.php', false, false ) ); 
				?>	
				<div class="grid-container">
					<div class="white-content-container">
						<div class="grid-x">
							<div class="cell">
								<h2><?php echo $section['title']; ?></h2>
								<?php echo $section['intro_text']; ?>

								<div class="grid-x small-up-1 medium-up-2" id="team-members-grid">
									<?php
									foreach($section['team_members'] as $teamMember) {
										$tmId = $teamMember['team_member'];
										?>
										<div class="cell team-member">
											<a href="<?php echo get_the_permalink($tmId);?>">
												<?php
												if (has_post_thumbnail($tmId)) :
													echo get_the_post_thumbnail($tmId, 'square-large');
												else :
													$tmImage = get_field('image', $tmId);
													echo wp_get_attachment_image( $tmImage, 'square-large' );
												endif;
												echo "<div class='name'>".get_the_title($tmId)."</div>";
												echo "<div class='position'>".get_field('position', $tmId)."</div>";
												?>
											</a>
										</div>
										<?php
									}
									?>
								</div>
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
