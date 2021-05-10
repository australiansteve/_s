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

	<div class="grid-container">

		<div class="page-content">

			<div class="entry-content">

				<h2 class="page-title"><span>
				<?php
				echo get_the_title( get_option( 'page_for_posts' ) );
				?>
				</span></h2>

				<?php
				while ( have_posts() ) :
					the_post();
					?>
						<?php get_template_part( 'template-parts/archive', get_post_type() ); ?>
					<?php
				endwhile;
				?>

				<?php get_template_part( 'template-parts/archive', 'nav' ); ?>

			</div>
		</div>
	</div>

</main><!-- #main -->

<?php
get_footer();
