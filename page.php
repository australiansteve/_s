<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
			<h1 class="page-title"><?php the_title();?></h1>
			<div class="page-content">
				<?php the_content();?>
			</div>
			<?php
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
		}

	endwhile; 
	?>

</main><!-- #main -->

<?php
get_footer();
