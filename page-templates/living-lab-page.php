<?php
/**
 * Template Name: Living Lab Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

get_header();
?>

<main id="primary" class="site-main">


	<?php
	$sectionId = 'landing';
	$section = get_field($sectionId);
	if ($section) {
		include( locate_template( 'template-parts/section-header.php', false, false ) ); 
		?>
		<h1 class="page-title"><?php echo $section['title'];?></h1>
		<?php
		include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
	}

	$sectionId = 'intro';
	$section = get_field($sectionId);
	if ($section) {
		include( locate_template( 'template-parts/section-header.php', false, false ) ); 
		?>
		<div class="intro-box">
			<?php echo $section['introductory_text']; ?>
		</div>
		<?php
		include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
	}

	$sectionId = 'excursions';
	$section = get_field($sectionId);
	if ($section) {
		include( locate_template( 'template-parts/section-header.php', false, false ) ); 
		?>
		<div class="blue-box">
			<h2><?php echo $section['subtitle']; ?></h2>
			<div class="text">
				<?php echo $section['text']; ?>
			</div>

			<div class="light-blue-box">
				<div class="logo-box-title"><?php echo $section['logo_box_title']; ?></div>
				<div class="text">
					<?php echo $section['logo_box_text']; ?>
				</div>
				
				<div id="logos" class="grid-x grid-margin-x small-up-2 medium-up-3 align-center">
					<?php 
					error_log("logos:".print_r($section['logos'], true));
					foreach($section['logos'] as $logo) :
						$link = $logo['link'];
						?>
						<div class='cell'>
							<?php
							if ($link) {
								echo "<a class='logo-link' href='".$link."' target='blank'>";
							}
							?>
							<div class="grid-y logo" style="height: 100%">
								<div class="cell" style="flex: 1">
									<div class="grid-y align-center image-grid" style="height: 100%">
										<div class="cell">
											<?php
											$image = $logo['image'];
											$size = 'full';

											if( $image ) {
												echo wp_get_attachment_image( $image, $size );
											}
											?>
										</div>
									</div>
								</div>
								<div class='cell shrink name'><?php echo $logo['name'];?></div>
							</div>									
							<?php
							if ($link) {
								echo "</a>";
							}
							?>
						</div>
						<?php
					endforeach;
					?>
				</div>
			</div>

			<div class="text" id="byline">
				<?php echo $section['footer_byline']; ?>
			</div>
		</div>
		<?php
		include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
	}
	?>

</main><!-- #main -->

<?php
get_footer();
