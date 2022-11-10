<?php
/**
 * Template part for displaying wishlists
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

$wishlist_id = get_the_ID();
$user_can_add_to_wishlist = false;
$viewing_own_wishlist = false;

if ($wishlist_id && current_user_can('add_to_wishlists')) {
	//If current user is a teacher, double check that the wishlist_id belongs to them
	$wishlist_teacher = get_field('teacher', $wishlist_id);
	$user_can_add_to_wishlist = ($wishlist_teacher == get_field('teacher_id', 'user_'.get_current_user_id()));

	$viewing_own_wishlist = is_single() && $user_can_add_to_wishlist;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php
	if( have_rows('wishlist_items') ):
		global $post;
		?>
		<ul class="grid-x text-left products product-list">
			<?php
			while( have_rows('wishlist_items') ) : the_row();
				$product_id = get_sub_field('product');
				$product_needs = array( 'wants' =>  get_sub_field('wants'), 'has' => get_sub_field('has'), 'campaign_id' => get_field('campaign', $wishlist_id), 'wishlist_id' => $wishlist_id, 'can_add_to_wishlist' => $user_can_add_to_wishlist, 'viewing_own_wishlist' => $viewing_own_wishlist);
				?>
				<li class="cell" data-product-id="<?php echo $product_id;?>">
					<?php 
					$post = get_post($product_id);

    				setup_postdata($post);
					get_template_part('template-parts/archive', get_post_type(), $product_needs);
  					wp_reset_postdata();
					?>
				</li>
				<?php

			endwhile;
			?>
		</ul>
		<?php
	else :
		_e('Wishlist contains no products', 'hamburger-cat');
	endif;

	?>
	
	<script type="text/javascript">
		
		jQuery( document ).ready(function() {
			wishlist_id = <?php echo get_the_ID();?>;
			campaign_id = <?php echo get_field('campaign');?>;

			var wishlistCookie = getCookie('wishlist_id');

			if (wishlistCookie) {
				//Clear current cookie value
				document.cookie = "wishlist_id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
			}
			
			//Set new cookie values
			setCookie('wishlist_id', wishlist_id);
			setCookie('wishlist_url', '<?php the_permalink(get_the_ID());?>');
			setCookie('campaign_id', campaign_id);
		});
	</script>
</article><!-- #post-<?php the_ID(); ?> -->
