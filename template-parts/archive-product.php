<?php
$thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url($post, 'archive-image') : wp_get_attachment_image_src( get_field('default_placeholder_image', 'options'), 'archive-image')[0]; 

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	
		<img src='<?php echo $thumbnail; ?>' />
		<h3 class="page-title"><?php the_title();?></h3>

		<div class="grid-x grid padding-x">
			<div class="cell">
				<?php
				if ($args['wants'] - $args['has'] > 1) {
					?>
					<?php _e('Qty:', 'hamburger-cat');?> <select id="add-to-cart-qty-<?php echo get_the_ID();?>">
						<?php
						for ($i = 1; $i <= ($args['wants'] - $args['has']); $i++) {
							echo "<option value='".$i."'>".$i."</option>";
						}
					?>
					</select>
					<?php
				}
				else {
					?>
					<input type="hidden" id="add-to-cart-qty-<?php echo get_the_ID();?>" value="1"/>
					<?php
				}
				if ($args['wants'] - $args['has'] > 0) {
				?>
				<button class="button add-to-cart" onclick="return add_to_cart(jQuery(this), <?php echo get_the_ID();?>, null, getCookie('wishlist_id'));">
					<?php _e('Add to cart', 'hamburger-cat'); ?>
				</button>
				<?php
				}
				else {
					_e('No more needed!', 'hamburger-cat');
				}
				?>
			</div>
		
</article><!-- #post-<?php the_ID(); ?> -->
