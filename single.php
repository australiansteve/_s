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

		$section = get_field('landing');
		if ($section) {
			include( locate_template( 'template-parts/section-header.php', false, false ) ); 
			?>	
			<div class="grid-container">
				<div class="grid-x">
					<div class="cell">
						
						<?php get_template_part( 'template-parts/content', get_post_type() ); ?>		
						<div class="grid-x navigation">
							<div class="cell small-6 text-right medium-5 medium-order-1">
								<?php echo get_previous_post_link(
									'%link',
									'<i class="fas fa-2x fa-chevron-left"></i> <span class="nav-title screen-reader-text">%title</span>'
								); ?>
							</div>
							<div class="cell small-6 text-left medium-5 medium-order-3">
								<?php echo get_next_post_link(
									'%link',
									'<i class="fas fa-2x fa-chevron-right"></i> <span class="nav-title screen-reader-text">%title</span>'
								); ?>
							</div>
							<div class="cell text-center medium-2 medium-order-2">
								<a class="button" href="<?php echo get_post_type_archive_link(get_post_type());?>"><?php echo get_post_type_object(get_post_type())->labels->all_items;?></a>
							</div>
						</div>

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
