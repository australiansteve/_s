<?php
/**
 * Template Name: Contact Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/hero-image', get_post_type() );
		?>
		<div class="page-content">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="grid-container">

					<div class="grid-x">
						<div class="cell medium-6 aqua-background">
							<?php the_title('<h1 class="page-title">', '</h1>');?>  
						</div>
					</div>

					<div class="grid-x grid-margin-x">
						<div class="cell medium-6 aqua-background">
							<?php
							$ninja_form_id = get_field('ninja_form_id');
							if($ninja_form_id) :
								echo do_shortcode('[ninja_form id="'.$ninja_form_id.'"]');
							endif;
							?>
						</div>
						<div class="cell medium-6">
							<div class="entry-content">
								<?php the_content(); ?>
							</div>
						</div>
					</div>

				</div>
			</article><!-- #post-<?php the_ID(); ?> -->
		</div>

		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	<?php
	get_footer();
