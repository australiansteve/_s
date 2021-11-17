<?php
/**
 * Template Name: About Page
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

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="ignore-grid-container-padding-left ignore-grid-container-padding-right">
						<div class="grid-x">
							<div class="cell large-5 show-for-large">
								<?php			
								get_template_part( 'template-parts/hero-image-portrait', get_post_type() );
								?>
							</div>

							<div class="cell hide-for-large">
								<?php		
								get_template_part( 'template-parts/hero-image', get_post_type() );
								?>
							</div>

							<div class="cell large-7">

								<div class="entry-content">
									
									<h1 class="page-title"><?php the_title();?></h1>

									<?php the_content();?>

									<?php
									$cv_button_text = get_field('cv_button_text');
									$cv_link = get_field('cv_link');

									if ($cv_button_text && $cv_link) {
										?>
										<a href="<?php echo $cv_link;?>" target="_blank" class="button"><?php echo $cv_button_text; ?></a>
										<?php
									}
									?>
								</div>
							</div>
						</div>

					</div>
					<div class="grid-x cell">
						<div class="artist-statement text-container">
							<?php the_field('artist_statement');?>
						</div>
					</div>
				</article><!-- #post-<?php the_ID(); ?> -->
			</div> 
		</div>

		<?php

	endwhile; 
	?>

</main><!-- #main -->

<?php
get_footer();
