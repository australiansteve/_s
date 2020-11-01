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
	$sectionId = 'error_404_landing';
	$section = get_field($sectionId, 'option');
	if ($section) {
		include( locate_template( 'template-parts/section-header.php', false, false ) ); 
		?>	
		<div class="grid-container">
			<div class="white-content-container">

				<div class="grid-x">
					<div class="cell">
						<div class="page-content">
							<h1>Page Not Found</h1>
							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'hamburger-cat' ); ?></p>

							<form role="search" method="get" class="search-form" action="/">
								<label>
									<span class="screen-reader-text">Search for:</span>
									<input type="search" class="search-field" placeholder="Search …" value="" name="s">
								</label>
								<input type="submit" class="button search-submit" value="Search">
							</form>

						</div><!-- .page-content -->
					</div>
				</div>
			</div>
		</div>
		<?php
		include( locate_template( 'template-parts/section-footer.php', false, false ) ); 

	}
	?>

</main><!-- #main -->

<?php
get_footer();
