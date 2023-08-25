<div class="">
	<?php 
	$wishlist_id = get_the_ID();

	if ($wishlist_id && current_user_can('add_to_wishlists')) {
		//If current user is a teacher, double check that the wishlist_id belongs to them
		$wishlist_teacher = get_field('user_id', $wishlist_id);
		$user_can_add_to_wishlist = ($wishlist_teacher == get_current_user_id());

		if ($user_can_add_to_wishlist) {
			$campaign_id = get_field('campaign');

			echo "<a class='button' href='".get_permalink($campaign_id)."?wishlist_id=".get_the_ID()."'>";
			echo __('Select more books', 'austeve-hamburgercat');
			echo "</a>";
		}
	}
	?>
</div>