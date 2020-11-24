<?php
/**
 * Home page
 *
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	$sectionId = 'landing';
	$section = get_field($sectionId);
	if ($section) {
		include( locate_template( 'template-parts/section-header.php', false, false ) ); 
		?>
		<div class="container">
			<h1 class="page-title"><?php echo $section['title'];?></h1>
			<div class="text">
				<?php echo $section['intro']; ?>
			</div>
			<div class="buttons">
				<a class="button" href="<?php echo $section['button_1_link']; ?>"><?php echo $section['button_1_text']; ?></a> <a class="button" href="<?php echo $section['button_2_link']; ?>"><?php echo $section['button_2_text']; ?></a>
			</div>
		</div>
		<?php
		include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
	}

	$sectionId = 'call_to_action';
	$section = get_field($sectionId);
	if ($section) {
		include( locate_template( 'template-parts/section-header.php', false, false ) ); 
		?>
		<div class="container">
			<div class="blue-box">
				<h2><?php echo $section['title'];?></h2>
				<?php echo $section['text']; ?>
			</div>
			<div class="buttons">
				<a class="button" href="<?php echo $section['button_link_1']; ?>"><?php echo $section['button_1_text']; ?></a> <a class="button" href="<?php echo $section['button_link_2']; ?>"><?php echo $section['button_2_text']; ?></a>
			</div>
		</div>
		<?php
		include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
	}

	$sectionId = 'testimonials';
	$section = get_field($sectionId);
	if ($section) {
		include( locate_template( 'template-parts/section-header.php', false, false ) ); 
		?>
		<h2><?php echo $section['title'];?></h2>
		<div class="light-blue-box">
			<div class="testimonials-container">
				<?php
				$counter = 1;
				$testimonials = $section['testimonials'];
				foreach($testimonials as $testimonial) {
					?>
					<div class="testimonial" data-testimonial="<?php echo $counter++;?>">
						<blockquote>
							<?php echo $testimonial['text'];?>
							<cite class="name"><?php echo $testimonial['name_title'];?></cite>
						</blockquote>
					</div>
					<?php
				}
				?>
			</div>
			<div class="testimonials-controls">
				<?php
				$counter = 1;
				foreach($testimonials as $testimonial) {
					?>
					<i class="fas fa-circle testimonial-control <?php echo $counter == 1 ? 'active' : '';?>" data-control="<?php echo $counter++;?>"></i>
					<?php
				}
				?>
			</div>

			<script type="text/javascript">
				function changeTestimonial(e) {
					var newActiveTestimonial = jQuery(e.target).data('control');
					console.log(newActiveTestimonial);
					jQuery('.testimonial').each(function() {
						if (jQuery(this).data('testimonial') < newActiveTestimonial) {
							jQuery(this).addClass('left');
						}
						else {
							jQuery(this).removeClass('left');
						}
					});

					jQuery('.testimonial-control').removeClass('active');
					jQuery(e.target).addClass('active');

				}
				jQuery(document).on('click', '.testimonial-control', changeTestimonial);
			</script>
		</div>
		<?php
		include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
	}

	$sectionId = 'courses';
	$section = get_field($sectionId);
	if ($section) {
		include( locate_template( 'template-parts/section-header.php', false, false ) ); 
		?>
		<h2><?php echo $section['title'];?></h2>
		<div class="text">
			<?php echo $section['introductory_text']; ?>
		</div>
		
		<div id="post-grid" class="grid-x grid-margin-x small-up-1 medium-up-3 austeve-courses" data-equalizer data-equalize-by-row="true">
			<?php
			$args = array(
				'post_type'			=> array( 'austeve-courses' ),
				'post_status'		=> array( 'publish' ),
				'posts_per_page'	=> 3,
				'tax_query'			=> array(
					array(
						'taxonomy'         => 'course-tags',
						'terms'            => 'featured',
						'field'            => 'slug',
						'operator'         => 'IN',
					),
				),
			);
			$postsquery = new WP_Query( $args );
			if ( $postsquery->have_posts() ) {
				while ( $postsquery->have_posts() ) {
					$postsquery->the_post();

					include( locate_template( 'template-parts/archive-austeve-courses.php', false, false ) ); 

				}
			}
			wp_reset_postdata();
			?>
		</div>
		<?php
		include( locate_template( 'template-parts/section-footer.php', false, false ) ); 
	}

	?>
</main><!-- #main -->

<?php
get_footer();
