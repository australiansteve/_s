<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Hamburger_Cat
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php

	$sectionId = 'project_landing';
	$section = get_field($sectionId, 'option');
	if ($section) {
		include( locate_template( 'template-parts/section-header.php', false, false ) ); 
		?>	
		<div id="projects">
			<div class="grid-container" >
				<div class="white-content-container">


					<div class="grid-x">
						<div class="cell text-center">
							<h1><?php the_archive_title();?></h1>

							<?php include( locate_template( 'template-parts/section-projects.php', false, false )); ?>
						</div>
					</div>

				</div>
			</div>
		</div>
		<?php
		include( locate_template( 'template-parts/section-footer.php', false, false ) ); 

	}

	?>

</main><!-- #main -->

<?php
get_footer();
