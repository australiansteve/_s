<?php
$identifier = substr(str_shuffle(MD5(microtime())), 0, 10);

if (isset($args['can_add_to_wishlist']) && $args['can_add_to_wishlist'] && isset($args['wishlist_id']) && !empty($args['wishlist_id'])) {

	if ($args['viewing_own_wishlist']) {
		/* Teacher looking at their own wishlist */
		?>
		<p class='qty-requested'><?php echo __('Quantity requested: ');?>
			<select id='qty-requested-<?php echo get_the_ID();?>' onchange="return update_wishlist(jQuery(this), <?php echo $args['wishlist_id'];?>, <?php echo get_the_ID();?>);">
				<?php for($q = 0; $q <= 10; $q++) {
					$selected_text = $q == $args['wants'] ? 'selected' : '';
					echo "<option value='$q' ".$selected_text.">$q</option>";
				}?>
			</select>
		</p>
		<p class='qty-purchased'><?php echo sprintf(__('Quantity purchased: <span>%s</span>'), $args['has']);?></p>
		<?php
	}
	else {
		/* On campaign page... */
		?>
		<select id='add-to-wishlist-qty-<?php echo get_the_ID(); ?>' class='add-to-wishlist-qty' onchange="return update_add_to_cart_qty('<?php echo get_the_ID(); ?>', '<?php echo $identifier;?>', jQuery(this).val());">
			<?php for($q = 1; $q <= 10; $q++) {
				echo "<option value='$q'>$q</option>";
			}?>
		</select>
		<button class="button add-to-cart" id="add-to-cart-<?php echo get_the_ID().'-'.$identifier;?>" onclick="return add_to_wishlist(jQuery(this), <?php echo get_the_ID();?>, null, <?php echo $args['wishlist_id'];?>);" data-qty="1">
			<?php _e('Add to wishlist', 'hamburger-cat'); ?>
		</button>
		<?php
	}
}
else {
	//wishlist_id should come from calling page-template, or will fall back to cookie value, which should be set, and if it's not the add to cart will just be generic (associated with no wishlist)

	?>
	<div class="grid-x grid-margin-x">
		<?php
		if (isset($args['wishlist_id']) && !empty($args['wishlist_id'])) {
			?>
			<div class="cell shrink">
				<button class="button add-to-cart" onclick="return add_to_cart(jQuery(this), <?php echo get_the_ID();?>, null, <?php echo $args['wishlist_id'];?>);">
			 		<?php _e('Buy for class', 'hamburger-cat'); ?>
				</button>
			</div>
			<?php
		}

		?>
		<div class="cell shrink">
			<button class="button add-to-cart" onclick="return add_to_cart(jQuery(this), <?php echo get_the_ID();?>, null, null);">
		 		<?php _e('Buy for home', 'hamburger-cat'); ?>
			</button>
		</div>
	</div>
	<?php
}
?>