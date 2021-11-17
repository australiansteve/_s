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

	<div class="page-content">

		<div class="grid-container">

			<h1 class="page-title"><span>
			<?php
			echo get_the_title( get_option( 'page_for_posts' ) );
			?>
			</span></h1>

			<div class="grid-x" id="home-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					?>

					<div class="cell">
						<?php get_template_part( 'template-parts/archive', get_post_type() ); ?>
					</div>

					<?php
				endwhile;

				$nav_type = get_field('archive_navigation_type', 'options');
				if ($nav_type == 'infinite-scroll'):
					echo '<span class="next-page" data-page="2"/>';
				endif;
				?>
				<span class="next-page" data-page="2"/>
			</div>

			<?php get_template_part( 'template-parts/archive', 'nav' ); ?>

			<div class="newsletter-signup">
				<?php 
				$newsletter_signup_form_id = get_field('newsletter_signup_form_id', get_option('page_for_posts'));
				error_log('newsletter_signup_form_id: '.$newsletter_signup_form_id );
				if ($newsletter_signup_form_id ) :
					echo do_shortcode('[mc4wp_form id='.$newsletter_signup_form_id .']');
				endif;
				?>
			</div>

		</div>
	</div>

</main><!-- #main -->

<?php
get_footer();
