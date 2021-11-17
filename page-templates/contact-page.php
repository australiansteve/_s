<?php
/**
 * Template Name: Contact Page
 *
 * @package Hamburger_Cat
 */
get_header();
?>

<main id="primary" class="site-main">

	<?php

	while ( have_posts() ) :
		the_post();
		?>

		<div class="grid-container">
			<div class="page-content">		

				<div class="teal-background ignore-grid-container-padding-left ignore-grid-container-padding-right">

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<div class="grid-x">
							<div class="cell xlarge-5 xlarge-order-2 show-for-xlarge">
								<?php		
								get_template_part( 'template-parts/hero-image-portrait', get_post_type() );
								?>
							</div>

							<div class="cell hide-for-xlarge">
								<?php		
								get_template_part( 'template-parts/hero-image', get_post_type() );
								?>
							</div>

							<div class="cell xlarge-7 xlarge-ordr-1">

								<div class="entry-content">
									
									<h1 class="page-title"><?php the_title();?></h1>

									<?php the_content();?>

								</div>
							</div>
						</div>

					</article><!-- #post-<?php the_ID(); ?> -->
				</div>
			</div> 
		</div>

		<?php

	endwhile; 
	?>

</main><!-- #main -->

<?php
get_footer();
