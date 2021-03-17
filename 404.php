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

	<div class="page-content">
		<div class="grid-container">
			<h2 class="page-title"><span><?php esc_html_e( get_field('404_page_title', 'options'), 'hamburger-cat' ); ?></span></h2>  
			<div class="entry-content">
				<?php the_field('404_page_content', 'options'); ?>
			</div>
		</div>
	</div>

</main><!-- #main -->

<?php
get_footer();
