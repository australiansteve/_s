<?php
/**
 * Template Name: About Page
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

		if (has_post_thumbnail($post)) :
			the_post_thumbnail( 'hero-image' );
		endif;
		?>

		<div class="grid-container">
			<div class="page-content">
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				<div class="custom-content">
					<h2 class="page-title"><span><?php the_field('title_1');?></span></h2>
					<div class="grid-x medium-up-2 grid-margin-x" id="custom-content-1">

						<?php
						if( have_rows('partners') ):

							while( have_rows('partners') ) : the_row();

								$partnerImageId = get_sub_field('image');
								$partnerName = get_sub_field('name');
								$partnerTitle = get_sub_field('title');
								$partnerBio = get_sub_field('biography');
								?>
								<div class="cell ">
									<div class="container partner">
										<?php								
										if( $partnerImageId ) {
											echo wp_get_attachment_image( $partnerImageId, 'archive-image' );
										}
										?>
										<h3><?php echo $partnerName;?></h3>
										<div class="partner-title"><?php echo $partnerTitle;?></div>
										<div class="partner-bio"><?php echo $partnerBio;?></div>
										
									</div>
								</div>
								<?php

							endwhile;

						endif;
						?>
					</div>
				</div>
			</div>
		</div>


		<?php
	endwhile;
	?>

</main><!-- #main -->

<?php
get_footer();
