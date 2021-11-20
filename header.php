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

	<?php 
	$menuType = get_field('primary_menu_type', 'option');

	$customJS = get_field('custom_js', 'option');

	if( have_rows('custom_js', 'option') ):
		while( have_rows('custom_js', 'option') ) : the_row();
			error_log("custom_js");

	        // Loop over sub repeater rows.
			if( have_rows('js_script') ):
				while( have_rows('js_script') ) : the_row();

	                // Get sub values.
					$name = get_sub_field('name');
					$script = get_sub_field('script');
					$location = get_sub_field('display_in');

					if ($location == 'body') {
						echo $script;
					}

				endwhile;
			endif;
		endwhile;
	endif;
	?>

	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'hamburger-cat' ); ?></a>

		<?php
		$useStickyHeader = get_field('use_sticky_header', 'options');
		$stickyContainerData = $useStickyHeader ? 'data-sticky-container' : '';
		$stickyData = $useStickyHeader ? 'data-sticky data-margin-top="0"' : '';
		?>
		<div <?php echo $stickyContainerData;?> >

			<?php
			if ($menuType == 'off-canvas-top') {
				?>
				<div class="off-canvas-wrapper">
					<div class="off-canvas position-top" id="offCanvasTop" data-off-canvas>
						<div class="grid-container">
							<div class="off-canvas-container">
								<a class="close-off-canvas" aria-label="Close menu" type="button" data-close>
									<i class="fas fa-times fa-2x"></i>
								</a>

								<div class="grid-y align-center">
									<div class="cell text-center">
										<ul class="menu vertical nested">
											<?php
											wp_nav_menu(
												array(
													'theme_location'	=> 'primary-menu',
													'container'		=> false,
													'items_wrap' => '%3$s'
												)
											);
											?>
											<div class="social-wrapper">
												<?php
												wp_nav_menu(
													array(
														'theme_location'	=> 'social-menu',
														'container'		=> false,
														'items_wrap' => '%3$s'
													)
												);
												?>
											</div>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			} /* endif ($menuType == 'off-canvas-top') */
			?>

			<header id="masthead" class="site-header" <?php echo $stickyData;?>>
				<div class="grid-container">

					<?php 
					$headerLeftClasses = ($menuType == 'top-bar') ? 'small-12 text-center' : 'medium-5 large-4 text-center medium-text-left';
					$headerRightClasses = ($menuType == 'top-bar') ? 'small-12 text-center' : 'medium-7 large-8 medium-text-right';
					?>
					<div class="grid-x">
						<div class="cell <?php echo $headerLeftClasses;?> ">
							<?php
							$homeLink = apply_filters( 'wpml_home_url', get_option( 'home' ) );
							?>
							<a href="<?php echo $homeLink;?>">
								<?php 
								$image = get_field('header_logo', 'options');
								$size = 'header-logo';

								if( $image ) {
									echo wp_get_attachment_image( $image, $size );
								}
								else {
									echo "<h1 class='site-title'>".get_bloginfo( 'name' )."</h1>";
								}
								?>
							</a>

							<div id="small-language-menu" class="show-for-small-only">
								<?php
								if ( has_nav_menu( 'language-menu' ) ) :
									wp_nav_menu(
										array(
											'theme_location'	=> 'language-menu-small',
											'menu_id'		=> 'language-menu-small',
											'menu_class'	=> 'horizontal menu',
										)
									);
								endif;
								?>
							</div>
						</div>
						<div class="cell <?php echo $headerRightClasses;?>">

							<nav id="site-navigation" class="main-navigation">

								<?php
								if ($menuType == 'top-right' || $menuType == 'top-bar') {
									?>
									<ul class="vertical menu accordion-menu show-for-small-only" data-accordion-menu>
										<li>
											<a href="#"><span>Menu</span> <i class="fas fa-bars"></i><i class="fas fa-caret-up"></i></a>
											<ul class="menu vertical nested">
												<?php
												wp_nav_menu(
													array(
														'theme_location'	=> 'primary-menu',
														'container'		=> false,
														'items_wrap' => '%3$s'
													)
												);
												?>
												<div class="social-wrapper">
													<?php
													wp_nav_menu(
														array(
															'theme_location'	=> 'social-menu',
															'container'		=> false,
															'items_wrap' => '%3$s'
														)
													);
													?>
												</div>
											</ul>
										</li>

									</ul>
									<?php
								} elseif ($menuType == 'off-canvas-top') {
									?>
									<ul class="vertical menu accordion-menu show-for-small-only" data-accordion-menu>
										<li>
											<a href="" class="off-canvas-top"  data-open="offCanvasTop"><span>Menu</span> <i class="fas fa-bars"></i></a>
										</li>
									</ul>
									<?php
								}
								?>

								<div id="menus">
									<?php

									if ($menuType == 'top-right') {

										if ( has_nav_menu( 'language-menu' ) ) :
											wp_nav_menu(
												array(
													'theme_location'	=> 'language-menu',
													'menu_id'		=> 'language-menu',
													'menu_class'	=> 'vertical menu show-for-medium text-right',
													'items_wrap'        => '<ul class="%2$s horizontal menu" id="%1$s">%3$s</ul>',
													'container' 	=> false
												)
											);
										endif;

										wp_nav_menu(
											array(
												'theme_location'	=> 'primary-menu',
												'menu_id'		=> 'primary-menu',
												'menu_class'	=> 'horizontal menu show-for-medium text-right',
												'container'		=> false,
												'link_before'	=> '<span>',
												'link_after'	=> '</span>'
											)
										);

									} elseif ($menuType == 'off-canvas-top') {
										?>
										<a href="" class="off-canvas-top show-for-medium" data-open="offCanvasTop"><i class="fas fa-bars fa-2x"></i></a>
										<?php
									} elseif ($menuType == 'top-bar') {
										wp_nav_menu(
											array(
												'theme_location'	=> 'primary-menu',
												'menu_id'		=> 'primary-menu',
												'menu_class'	=> 'horizontal menu show-for-medium text-center',
												'container'		=> false
											)
										);
									}

									?>
								</div>
							</nav><!-- #site-navigation -->
						</div>
					</div>
				</div><!-- .grid-container -->
			</header><!-- #masthead -->
		</div>