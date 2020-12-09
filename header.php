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
				<div class="grid-x">
					<div class="cell medium-4 text-center medium-text-left" id="logo">
						<div class="grid-y align-center" style="height: 100%">
							<div class="cell">
								<a href="/?lang=<?php echo ICL_LANGUAGE_CODE;?>" title="<?php echo get_the_title(get_option('page_on_front')); ?>">
									<?php 
									$image = get_field('logo', 'options');
									$size = 'header-logo';
									
									if( $image ) {
										echo wp_get_attachment_image( $image, $size );
									}
									?>
								</a>
							</div>
						</div>
					</div>
					<div class="cell medium-8">
						<div class="medium-text-right">
							<nav id="site-navigation" class="main-navigation">
								<ul class="vertical menu accordion-menu show-for-small-only" data-accordion-menu>
									<li>
										<a href="#"><span><?php the_field('header_menu_text', 'options');?></span> <i class="fas fa-bars"></i><i class="fas fa-caret-up"></i></a>
										<ul class="menu vertical nested">
											<?php
											wp_nav_menu(
												array(
													'theme_location'	=> 'primary-menu',
													'container'		=> false,
													'items_wrap' => '%3$s'
												)
											);

											wp_nav_menu(
												array(
													'theme_location'	=> 'social-menu',
													'container'		=> false,
													'items_wrap' => '%3$s',
													'add_li_class'  => 'social-menu-item'
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
										'menu_class'	=> 'horizontal menu show-for-medium text-right',
										'container'		=> false
									)
								);
								?>
							</nav><!-- #site-navigation -->

							<div class="language show-for-medium">
								<?php 
								wp_nav_menu(
									array(
										'theme_location'	=> 'language-menu',
										'menu_id'		=> 'language-menu',
										'menu_class'	=> 'horizontal menu show-for-medium text-right',
										'container'		=> false
									)
								);
								?>
							</div>

							<div class="social">
								<?php 
								wp_nav_menu(
									array(
										'theme_location'	=> 'social-menu',
										'menu_id'		=> 'social-menu',
										'menu_class'	=> 'horizontal menu show-for-medium text-right',
										'container'		=> false
									)
								);
								?>
							</div>
						</div>
					</div>
				</div>
			</div><!-- .grid-container -->
		</header><!-- #masthead -->
