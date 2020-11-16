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

	<?php if ( have_posts() ) { ?>

		<?php
		$sectionId = 'other_landing';
		$section = get_field($sectionId, 'options');
		if ($section) {
			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			?>
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			?>
			<div class="page-content">
				<?php the_content();?>
			</div>
			<?php
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
		}
	}
	else {

		get_template_part( 'template-parts/content', 'none' );

	}
	?>

</main><!-- #main -->

<?php
get_footer();
