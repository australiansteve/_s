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
		$stickyBgColor = get_field('sticky_header_background_color', 'options');
		?>
		<div <?php echo $stickyContainerData;?> >
		<header id="masthead" class="site-header" <?php echo $stickyData;?> style="color:<?php echo $stickyBgColor;?>">
			<div class="grid-container">
				
				<div class="grid-x">
					<div class="cell medium-4 large-3 text-center medium-text-left" id="header-left">
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

						<div id="small-language-menu" class="show-for-small-only no-print">
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
					<div class="cell medium-8 large-9 no-print" id="header-right">

						<div class="grid-x align-right" id="quick-actions">

							<div class="cell auto show-for-medium">
								<?php get_search_form( true ); ?>
							</div>

							<div class="cell auto text-center medium-text-right medium-shrink">
								<a href="/funds" class="button donate-now">Donate Now</a>
							</div>

						</div>

					</div>
				</div>

				<div class="grid-x">
					<div class="cell medium-text-right">
						<nav id="site-navigation" class="main-navigation medium-text-right">
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

							<div id="menus">
								<?php
								wp_nav_menu(
									array(
										'theme_location'	=> 'primary-menu',
										'menu_id'		=> 'primary-menu',
										'menu_class'	=> 'horizontal menu show-for-medium text-right',
										'container'		=> false
									)
								);

								if ( has_nav_menu( 'language-menu' ) ) :
									wp_nav_menu(
										array(
											'theme_location'	=> 'language-menu',
											'menu_id'		=> 'language-menu',
											'menu_class'	=> 'vertical menu accordion-menu show-for-medium text-right',
											'items_wrap'        => '<ul class="%2$s vertical menu accordion-menu" data-accordion-menu id="%1$s">%3$s</ul>',
											'container' 	=> false
										)
									);
								endif;

								?>
							</div>
						</nav><!-- #site-navigation -->
					</div>
				</div>

			</div><!-- .grid-container -->
		</header><!-- #masthead -->
	</div>