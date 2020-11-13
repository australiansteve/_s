<?php
/**
 * Template Name: Contact Page
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
		<h1 class="page-title"><?php the_title();?></h1>
		<?php
		include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
	}
	?>

</main><!-- #main -->

<?php
get_footer();
