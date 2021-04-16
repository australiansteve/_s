<?php
/**
 * The template for displaying the blog page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

get_header();

$pageBackground = get_field('blog_page_custom_page_background', 'options') ? get_field('blog_page_custom_page_background', 'options') : get_field('default_page_background', 'options');
$contentBackground = get_field('blog_page_custom_content_background', 'options') ? get_field('blog_page_custom_content_background', 'options') :get_field('default_content_background', 'options');
?>

<main id="primary" class="site-main" style="background: <?php echo $pageBackground;?>">

	<div class="page-content">

		<div class="grid-container">

			<h2 class="page-title"><span>
			<?php
			echo get_the_title( get_option( 'page_for_posts' ) );
			?>
			</span></h2>

			<div class="entry-content">
				<div class="grid-x grid-padding-x small-up-1">
					<?php
					while ( have_posts() ) :
						the_post();

						?>

						<div class="cell">
							<?php get_template_part( 'template-parts/archive', get_post_type() ); ?>
						</div>


						<?php
					endwhile;
					?>
				</div>

				<?php get_template_part( 'template-parts/archive', 'nav' ); ?>
			</div>
		</div>
	</div>

</main><!-- #main -->

<?php
get_footer();
