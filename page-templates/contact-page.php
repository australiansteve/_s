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

		<div class="page-content">
			<div class="text">
				<?php echo $section['text'];?>
			</div>
			<div class="ninja-form">
				<?php echo do_shortcode("[ninja_form id='".$section['ninja_form_id']."']"); ?>
			</div>
			<div class="blue-box">
				<div class="after-form">
					<?php echo $section['text_below_form'];?>
				</div>
				<div class="byline">
					<?php echo $section['footer_byline'];?>
					<ul>
						<?php
						wp_nav_menu(
							array(
								'theme_location'	=> 'social-menu',
								'menu_id'		=> 'social-menu',
								'menu_class'	=> 'horizontal menu text-left',
								'container'		=> false
							)
						);
						?>
						
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
