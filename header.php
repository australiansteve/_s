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
				<?php
				$columns_small = 7;
				$columns_large = 9;
				?>
				<header id="masthead" class="site-header" <?php echo $stickyData;?>>

					<ul class="grid-x small-up-1 medium-up-<?php echo $columns_small;?> large-up-<?php echo $columns_large;?> text-center menu" id="umbrella-grid">
						<?php
						$primary_menu = wp_get_nav_menu_object( get_nav_menu_locations()['primary-menu'] );
						$primary_menu_count = $primary_menu->count;
						?>
						<li class="cell">
							<a href="<?php echo home_url();?>" title="<?php _e('Home', 'hamburger-cat'); ?>" class="home-link">
								<?php 
								$image = get_field('header_logo', 'options');
								$size = 'header-logo';

								if( $image ) {
									echo wp_get_attachment_image( $image, $size );
								}
								?>
							</a>
						</li>
						<?php
						for($i = 1; $i <= $columns_large - $columns_small; $i++) {
							?>
							<li class="cell show-for-large">
							</li>
							<?php
						}
						for($i = 1; $i < $columns_small - $primary_menu_count; $i++) {
							?>
							<li class="cell show-for-medium">
							</li>
							<?php
						}

						wp_nav_menu(
							array(
								'theme_location'	=> 'primary-menu',
								'container'		=> false,
								'items_wrap' => '%3$s',
								'add_li_class'  => 'cell show-for-medium'
							)
						);
						?>
					</ul>

					<div class="show-for-small-only text-center" id="small-menu-parent">
						<ul class="vertical menu show-for-small-only" id="primary-menu-accordion">
							<li>
								<a href="#" class="menu-header"><span>Menu</span> <i class="fas fa-caret-down"></i></a>
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
					</div>

					<div id="umbrella-decoration" class="grid-x small-up-<?php echo $columns_small;?> large-up-<?php echo $columns_large;?>">
						<?php
						for($i = 1; $i <= $columns_small; $i++) {
							?>
							<div class="cell">
							</div>
							<?php
						}
						for($i = 1; $i <= $columns_large - $columns_small; $i++) {
							?>
							<div class="cell show-for-large">
							</div>
							<?php
						}

						?>
					</div>

				</header><!-- #masthead -->

			</div>