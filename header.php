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
	<div id="page-container" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'hamburger-cat' ); ?></a>

		<header id="masthead" class="site-header">
			<div class="grid-x grid-x-margin" id="header">
				<div class="cell small-12">
					<div id="header-image">
						<?php
						$image = get_field('header_image', 'option');
						$size = 'header-image-size'; // (thumbnail, medium, large, full or custom size)

						if( $image ) {

							$headerImage = wp_get_attachment_image( $image, $size );
							error_log("Front page image: ".print_r($image, true));

							?>
							<img src="<?php echo $image['sizes']['header-image-size'];?>" width="<?php echo $image['sizes']['header-image-size-width'];?>" height="<?php echo $image['sizes']['header-image-size-height'];?>"/>
							<?php

						}
						?>
					</div>
				</div>
			</div>
		</header><!-- #masthead -->

	<div id="page" class="site">
