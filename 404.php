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
		<div class="single-container">
			<h1 class="page-title"><?php the_field('404_page_title', 'options');?></h1>
				<p><?php the_field('404_page_text', 'options'); ?></p>

				<form role="search" method="get" class="search-form" action="/">
					<label>
						<span class="screen-reader-text"><?php echo get_field('sidebar_search_title', 'options');?>:</span>
						<input type="search" class="search-field" placeholder="Search …" value="" name="s">
					</label>
					<input type="submit" class="search-submit button" value="Search">
					<input type="hidden" name="lang" value="<?php echo ICL_LANGUAGE_CODE;?>">
				</form>
		</div>

		<?php
		include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
	}

	?>

</main><!-- #main -->

<?php
get_footer();
