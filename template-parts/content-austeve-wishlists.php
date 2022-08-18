<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

$categories = get_the_terms($post->ID, 'wishlist-category');
$category_name = is_array($categories) && count($categories) > 0 ? $categories[0]->name : "";

$ajax_nonce = wp_create_nonce( "add-to-cart" );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php
	if( have_rows('wishlist_items') ):
		global $post;
		?>
		<div class="grid-x grid-margin-x align-center small-up-2 medium-up-3 xlarge-up-4">
			<?php
			while( have_rows('wishlist_items') ) : the_row();
				$product_id = get_sub_field('product');
				$product_needs = array( 'wants' =>  get_sub_field('wants'), 'has' => get_sub_field('has'));
				?>
				<div class="cell" data-product-id="<?php echo $product_id;?>">
					<?php 
					$post = get_post($product_id);
    				setup_postdata($post);
					get_template_part('template-parts/archive', get_post_type(), $product_needs);
  					wp_reset_postdata();
					?>
				</div>
				<?php

			endwhile;
			?>
		</div>
		<?php
	else :
		_e('Wishlist contains no products', 'hamburger-cat');
	endif;
	?>
	<footer class="entry-footer">
		<?php hamburger_cat_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	
</article><!-- #post-<?php the_ID(); ?> -->

<?php get_template_part('template-parts/js');?>

<script type="text/javascript">
	function add_to_cart(target, product_id, variation_id, wishlist_id) {

		jQuery('header span.header-cart-count').html("<i class='fas fa-circle-notch fa-spin'></i>");
		target.append("<i class='fas fa-circle-notch fa-spin button-spinner'></i>");

		var quantity = jQuery('#add-to-cart-qty-'+product_id).val();

		jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url('admin-ajax.php');?>',
            dataType: "html",  
            data: { 
                action : 'austeve_add_to_cart', 
                security: '<?php echo $ajax_nonce; ?>',
                product_id: product_id,
                variation_id: variation_id,
                wishlist_id: wishlist_id,
                quantity: quantity
            },
            error: function (xhr, status, error) {
                console.log("Error: " + error);
            	target.find('.button-spinner').remove();
            },
            success: function( response ) {
                if (response) {
                	console.log('austeve_add_to_cart response: ' + response);
            		target.find('.button-spinner').remove();
            		target.after("<div class='message'><?php _e('Added to cart.', 'hamburger-cat'); ?><br/><?php echo sprintf(__('<a href=\'%s\'><strong>View Cart</strong>.</a>', 'hamburger-cat'), wc_get_cart_url()); ?></div>");
                    setTimeout(function() {
                    	jQuery('header span.header-cart-count').html(response);
                    }, 1500);                    
                }
                else {
            		target.find('.button-spinner').remove();
                    console.log("No response!");
                }
            }
        });

	}
</script>
