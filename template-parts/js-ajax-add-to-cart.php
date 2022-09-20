<?php
$ajax_nonce = wp_create_nonce( "add-to-cart" );
?>
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