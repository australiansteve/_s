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
			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$hamburger_cat_description = get_bloginfo( 'description', 'display' );
			if ( $hamburger_cat_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $hamburger_cat_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

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
					'theme_location'	=> 'menu-1',
					'menu_id'		=> 'primary-menu',
					'menu_class'	=> 'horizontal menu show-for-medium',
					'container'		=> false
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
