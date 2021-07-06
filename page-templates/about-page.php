<?php
/**
 * Template Name: About Page Template
 * 
 * This is the template that displays the About page.
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

		<div class="grid-container">
			<div class="page-content">
				<div class="entry-content">					
					<?php the_title('<h2 class="page-title"><span>', '</span></h2>');?>  
					
					<?php the_content(); ?>
				</div>
				<div class="custom-content">
					<h2 class="page-title"><span><?php the_field('title_1');?></span></h2>
					<div class="grid-x medium-up-2 grid-margin-x" id="custom-content-1">

						<?php
						if( have_rows('team_members') ):

							while( have_rows('team_members') ) : the_row();

								$teamMemberImageId = get_sub_field('image');
								$teamMemberName = get_sub_field('name');
								$teamMemberTitle = get_sub_field('title');
								$teamMemberBio = get_sub_field('biography');
								?>
								<div class="cell ">
									<div class="container team-member">
										<?php								
										if( $teamMemberImageId ) {
											echo "<div class='bling container'>";
											echo wp_get_attachment_image( $teamMemberImageId, 'archive-image' );
											echo "</div>";
										}
										?>
										<h3><?php echo $teamMemberName;?></h3>
										<div class="team-member-title"><?php echo $teamMemberTitle;?></div>
										<div class="team-member-bio"><?php echo $teamMemberBio;?></div>
										
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
