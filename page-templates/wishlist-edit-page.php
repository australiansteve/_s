<?php
/**
 * Template Name: Edit Wishlist page
 * 
 * The template for editing of wishlists by teachers
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
			<div class="page-content text-center">
				<div class="entry-content">
					<?php the_title('<h1 class="page-title">', '</h1>');?>  
					<?php

					if (current_user_can( 'add_to_wishlists')) {

						//assumes current user - will need to be updated if School Admin can perform this function
						$teacher_user_id = get_current_user_id();
						do_shortcode(sprintf("[edit_wishlist teacher_user_id='%s']", $teacher_user_id));

					}
					else {
						?>
						You are not authorized to view this page.
						<?php
					}
					?>
				</div>
			</div>
		</div>

		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	<?php
	get_footer();
