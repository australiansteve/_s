<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hamburger_Cat
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'hamburger-cat' ); ?></a>

		<header id="masthead" class="site-header">
			<div class="grid-container">
				
				<nav id="site-navigation" class="main-navigation">
					<ul class="vertical menu accordion-menu show-for-small-only" data-accordion-menu>
						<li>
							<a href="#"><span>Menu</span> <i class="fas fa-bars"></i><i class="fas fa-caret-up"></i></a>
							<ul class="menu vertical nested">
								<?php
								wp_nav_menu(
									array(
										'theme_location'	=> 'menu-1',
										'container'		=> false,
										'items_wrap' => '%3$s'
									)
								);

								wp_nav_menu(
									array(
										'theme_location'	=> 'menu-2',
										'container'		=> false,
										'items_wrap' => '%3$s'
									)
								);
								?>
							</ul>
						</li>

					</ul>

					<?php
					wp_nav_menu(
						array(
							'theme_location'	=> 'primary-menu',
							'menu_id'		=> 'primary-menu',
							'menu_class'	=> 'horizontal menu show-for-medium text-center',
							'container'		=> false
						)
					);
					?>
				</nav><!-- #site-navigation -->
			</div><!-- .grid-container -->
		</header><!-- #masthead -->
