<?php
/**
 * Template part for displaying paintings
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

$caption = wp_get_attachment_caption(get_post_thumbnail_id());
$contact_form_id = get_field('painting_inquiry_contact_form_id', 'options');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="grid-x grid-margin-x">
		<div class="cell medium-6">
			<a data-open="full-image"><?php echo the_post_thumbnail('full'); ?></a>
			<?php echo ($caption) ? "<figcaption class='caption'>".$caption."</figcaption>" : ""; ?>
		</div>

		<div class="cell medium-6">
			<h1 class="page-title"><?php the_title();?></h1>

			<?php the_content();?>

			<div class="austeve-paintings-meta">
				<?php 
				$year = get_field('year'); 
				if ($year) {
					?>
					<div class="year"><?php echo $year;?></div>
					<?php
				}

				$style = get_field('style'); 
				if ($style) {
					?>
					<div class="style"><?php echo $style;?></div>
					<?php
				}

				$size = get_field('size'); 
				if ($size) {
					?>
					<div class="size"><?php echo $size;?></div>
					<?php
				}

				$price = get_field('price'); 
				$is_available = has_term( 'available', 'painting-category' );
				if ($price && $is_available) {
					?>
					<div class="price"><span class="available"><?php _e('Available, ', 'hamburger-cat'); ?></span><?php echo $price;?></div>
					<?php
				}
				else {
					?>
					<div class="price"><span class="sold"><?php _e('Unavailable', 'hamburger-cat'); ?></span></div>
					<?php
				}

				?>
			</div>

			<?php
			if ($is_available) {
				?>
			<div class="purchase-inquiry">
				<button data-open="purchase-inquiry-dialog" class="button"><?php _e('Contact to purchase', 'hamburger-cat');?></button>
			</div>

			<?php
			}
				?>
		</div>
	</div>
	<footer class="entry-footer">

		<?php get_template_part( 'template-parts/breadcrumbs', get_post_type() ); ?>

	</footer><!-- .entry-footer -->


</article><!-- #post-<?php the_ID(); ?> -->

<div class="reveal text-center" id="full-image" data-reveal>
	<?php echo the_post_thumbnail('full'); ?>
	<?php echo ($caption) ? "<figcaption class='caption'>".$caption."</figcaption>" : ""; ?>

	<div>
		<button class="close button" data-close aria-label="Close modal" type="button">
			<?php _e('Close', 'hamburger-cat');?>
		</button>
	</div>
</div>

<div class="reveal text-left" id="purchase-inquiry-dialog" data-reveal>
	<?php echo $contact_form_id ? do_shortcode('[ninja_forms id="'.$contact_form_id.'"]') : __('No painting_inquiry_contact_form_id saved') ; ?>

	<div class="text-right">
		<button class="close button" data-close aria-label="Close modal" type="button">
			<?php _e('Close', 'hamburger-cat');?>
		</button>
	</div>
</div>