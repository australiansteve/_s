
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-container text-left">

		<?php the_post_thumbnail('featured-image'); ?>
		
		<h1 class="page-title"><?php the_title();?></h1>
		
		<?php if (get_field('price')) :?>
			<!-- Removed price
			<div class="price">
				<?php the_field('price');?>
			</div>-->
		<?php endif; ?>

		<?php include( locate_template( 'template-parts/content-austeve-courses-button.php', false, false ) );  ?>

		<?php the_content();?>
		
		<div class="grid-x grid-margin-x">
			<div class="cell text-center">
				<?php include( locate_template( 'template-parts/content-austeve-courses-button.php', false, false ) );  ?>
				<a href="/our-training?lang=<?php echo ICL_LANGUAGE_CODE;?>" class="button"><?php the_field('back_to_courses_button_text', 'options');?></a>
			</div>
		</div>

		<?php
		/* Form to be used for registering interest in a course or contacting for more information */
		if ( get_field('course_type') == 'buynow' || get_field('course_type') == 'contact' ) {
			?>
			<div class="reveal" id="contact-now-modal" data-reveal>
				<div class="modal-content">
					<?php echo do_shortcode("[ninja_forms id='".get_field('contact_for_information_form_id')."']");?>
				</div>
				<button class="close-button" data-close aria-label="Close modal" type="button">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php
		}
		if ( get_field('course_type') == 'webinar' && !get_field('registration_link') ) {
			?>
			<div class="reveal" id="registration-modal" data-reveal>
				<div class="modal-content">
					<?php echo do_shortcode("[ninja_forms id='".get_field('register_interest_form_id')."']");?>
				</div>
				<button class="close-button" data-close aria-label="Close modal" type="button">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php
		}

		?>
		<div class="entry-footer">
			<?php hamburger_cat_entry_footer(); ?>
		</div><!-- .entry-footer -->

	</div>
</article><!-- #post-<?php the_ID(); ?> -->
