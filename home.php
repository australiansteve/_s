<?php
/**
 * The template for displaying the blog page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	get_template_part( 'template-parts/hero-image', get_post_type() );
	?>

	<div class="grid-container">

		<div class="page-content">
			<div class="entry-content">
				<h2 class="page-title"><span>
					<?php
					echo get_the_title( get_option( 'page_for_posts' ) );
					?>
				</span>
			</h2>
			<?php
			the_field( 'intro_text', get_option( 'page_for_posts' )); 
			?>
		</div>

		<div class="grid-x grid-padding-x small-up-1 medium-up-2">
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

</main><!-- #main -->

<?php
get_footer();
