<?php
/**
 * Blog page
 *
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	$blogPageId = get_option('page_for_posts');
	$sectionId = 'landing';
	$section = get_field($sectionId, $blogPageId);
	if ($section) {
		include( locate_template( 'template-parts/section-header.php', false, false ) ); 
		?>
		<h1 class="page-title"><?php echo get_the_title($blogPageId);?></h1>
		<?php
		include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
	}

	$sectionId = 'intro';
	$section = get_field($sectionId, $blogPageId);
	if ($section) {
		include( locate_template( 'template-parts/section-header.php', false, false ) ); 
		?>
		<div class="intro-box">
			<?php echo $section['text']; ?>
		</div>
		<?php
		include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
	}

	$sectionId = 'body';
	$section = get_field($sectionId, $blogPageId);
	if ($section) {
		include( locate_template( 'template-parts/section-header.php', false, false ) ); 
		
		?>
		<div class="grid-x grid-margin-x">
			<div class="cell medium-7 large-8" id="blog-posts">
				<?php
				if ( have_posts() ) {

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
						
						include( locate_template( 'template-parts/blog-post.php', false, false ) ); 
					
					endwhile;

					include( locate_template( 'template-parts/archive-nav.php', false, false ) ); 
				}

				?>
			</div>
			<div class="cell medium-5 large-4" id="sidebar">
				<?php
				include( locate_template( 'template-parts/sidebar.php', false, false ) ); 
				?>
			</div>
		</div>

		<?php
		include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
	}

	?>
</main><!-- #main -->

<?php
get_footer();
