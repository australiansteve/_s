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

	<div class="grid-container">
		<div class="page-content text-center">
			<div class="entry-content">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'hamburger-cat' ); ?></h1>  

				Try taking a look around - or head to the <a href="/">home page</a>, maybe?
			</div>
		</div>
	</div>

</main><!-- #main -->

<?php
get_footer();
