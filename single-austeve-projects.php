<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Hamburger_Cat
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();

		$sectionId = 'landing';
		$section = get_field($sectionId);
		if ($section) {
			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			?>	
			<div class="grid-container">
				<div class="grid-x">
					<div class="cell">
						
						<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
						
						<div class="hide-overflow">
							<table>
								<tbody style="border:none">
									<tr id="project-scroll">
										<?php 
										$images = get_field('images');
										$size = 'full';
										if( $images ): ?>
											<?php foreach( $images as $image_id ): ?>
												<td class="project">
													<?php echo wp_get_attachment_image( $image_id, $size ); ?>
												</td>
											<?php endforeach; ?>
										<?php endif; ?>
									</tr>
									<div class="project-nav next"><i class="fas fa-2x fa-chevron-circle-right"></i></div><div class="project-nav previous"><i class="fas fa-2x fa-chevron-circle-left"></i></div>
								</tbody>
							</table>
						</div>

						<?php get_template_part( 'template-parts/javascript-single', get_post_type() ); ?>	

						<?php get_template_part( 'template-parts/nav', get_post_type() ); ?>		

					</div>
				</div>
			</div>
			<?php
			include( locate_template( 'template-parts/section-footer.php', false, false ) ); 

		}

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	<?php
	get_footer();
