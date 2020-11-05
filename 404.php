<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Hamburger_Cat
 */

get_header();
?>
<main id="primary" class="site-main">

		<?php
		$sectionId = 'other_landing';
		$section = get_field($sectionId, 'options');
		if ($section) {
			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			?>
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'hamburger-cat' ); ?></h1>
			</header><!-- .page-header -->
			<?php
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
		}


		$sectionId = 'other_body';
		$section = get_field($sectionId, 'options');
		if ($section) {
			include( locate_template( 'template-parts/section-header.php', false, false ) ); 

				?>
				<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'hamburger-cat' ); ?></p>

					<?php
					get_search_form();

					?>

			</div><!-- .page-content -->
			<?php

			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
		}

	?>

</main><!-- #main -->

<?php
get_footer();
