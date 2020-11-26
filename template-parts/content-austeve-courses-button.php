<?php 
if (get_field('course_type') == 'buynow') {
	?>
	<div class="buttons">
		<?php
		echo do_shortcode("[add_to_cart id='".get_field('product')."' show_price='false' style='']"); 
		?>
		<a class="button contact-for-information" data-course-id="<?php echo get_the_ID();?>" data-open="contact-now-modal"><?php the_field('contact_for_information_button_text_buynow', 'options');?></a>
	</div>
	<?php
}
else if (get_field('course_type') == 'contact') {
	?>
	<a class="button contact-for-information" data-course-id="<?php echo get_the_ID();?>" data-open="contact-now-modal"><?php the_field('contact_for_information_button_text', 'options');?></a>
	<?php
}
else if (get_field('course_type') == 'webinar') {
	if (get_field('registration_link')) {
		?>
		<a href="<?php the_field('registration_link');?>" target="_blank" class="button"><?php the_field('register_now_button_text', 'options');?></a>
		<?php
	}
	else {
		?>
		<a class="button register-interest" data-course-id="<?php echo get_the_ID();?>" data-open="registration-modal"><?php the_field('register_interest_button_text', 'options');?></a>
		<?php
	}
}
else {
	echo "Invalid Course Type!";
}
?>