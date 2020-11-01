<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
							<header class="page-header">
								<?php
								the_archive_title( '<h1 class="page-title">', '</h1>' );
								?>
							</header><!-- .page-header -->


							<?php if ( have_posts() ) : ?>
								<div class="grid-x grid-margin-x small-up-2 align-center" id="archive-grid">
								<?php
								/* Start the Loop */
								while ( have_posts() ) :
									the_post();

									/*
									 * Include the Post-Type-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
									 */
									get_template_part( 'template-parts/content-archive', get_post_type() );

								endwhile;
								?>
								</div>
								<?php
								the_posts_navigation();

							else :

								get_template_part( 'template-parts/content', 'none' );

							endif;
							?>
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
