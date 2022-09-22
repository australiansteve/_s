<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

$user_can_add_to_wishlist = false;
$wishlist_id = get_query_var('wishlist_id');

if ($wishlist_id && current_user_can('add_to_wishlists')) {
	//If current user is a teacher, double check that the wishlist_id belongs to them
	$wishlist_teacher = get_field('teacher', $wishlist_id);
	$user_can_add_to_wishlist = ($wishlist_teacher == get_field('teacher_id', 'user_'.get_current_user_id()));
}

$ajax_nonce_product =  wp_create_nonce( "quick-view-product" );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php
	if( have_rows('products') ):
		global $post;
		?>
		<ul class="grid-x grid-margin-x small-up-2 medium-up-3 xlarge-up-4 products product-grid">
			<?php
			while( have_rows('products') ) : the_row();
				$product_id = get_sub_field('product');
				$product_needs = array( 'wishlist_id' => $wishlist_id, 'can_add_to_wishlist' => $user_can_add_to_wishlist);
				error_log("PRODUCT NEEDS: ".print_r($product_needs, true));
				?>
				<li class="cell" data-product-id="<?php echo $product_id;?>">
					<?php 
					$post = get_post($product_id);

    				setup_postdata($post);
					get_template_part('template-parts/archive-grid', get_post_type(), $product_needs);
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

	<div class="reveal quick-view-product campaign" id="quickViewModal" data-reveal data-options="animationIn:slide-in-up; animationOut:slide-out-down;">
		<div class="modal-container">
			<div class="product-html">
			</div>
			<button class="close-button" data-close aria-label="Close modal" type="button">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<script type="text/javascript">
			function update_add_to_cart_qty(product_id, identifier, quantity) {
				console.log("qty changed: "+ product_id + ", "+ identifier);
				jQuery('#add-to-cart-'+product_id+'-'+identifier).data('qty', quantity);
			}
		</script>
	</div>


	<script type="text/javascript">

		function quick_view_product(e, product_id) {
			//e.preventDefault();
			jQuery('.quick-view-product .product-html').html("<div class='text-center'><i class='fas fa-circle-notch fa-spin'></i></div>");

			jQuery.ajax({
                type: 'POST',
                url: '<?php echo admin_url('admin-ajax.php');?>',
                dataType: "html",  
                data: { 
                    action : 'quick_view_product', 
                    security: '<?php echo $ajax_nonce_product; ?>',
                    product_id: product_id,
                    campaign_id: <?php echo get_the_ID(); ?>,
                    wishlist_id: <?php echo $user_can_add_to_wishlist ? $wishlist_id: 'false'; ?>
                },
                error: function (xhr, status, error) {
                    console.log("Error: " + error);
                },
                success: function( response ) {
                    if (response) {
                        jQuery('.quick-view-product .product-html').html(response);

                        //get select box styled in selet2 style if present
                        jQuery('.quick-view-product #qty').select2();
                    }
                    else {
                        console.log("No response!");
                    }
                }
            });

		}

	</script>

	<script type="text/javascript">
		
		jQuery( document ).ready(function() {

			var wishlist_id = <?php echo $wishlist_id ? $wishlist_id : 'false'; ?>;
			
			if (wishlist_id) {
				var wishlistCookie = getCookie('wishlist_id');

				if (wishlistCookie) {
					//Clear current cookie value
					document.cookie = "wishlist_id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
				}
				
				//Set new cookie value
				setCookie('wishlist_id', wishlist_id);
			}
		});
	</script>

	<footer class="entry-footer">
		<?php hamburger_cat_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	
</article><!-- #post-<?php the_ID(); ?> -->
