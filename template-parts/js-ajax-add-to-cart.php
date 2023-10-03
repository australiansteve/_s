<?php
$ajax_nonce = wp_create_nonce( "add-to-cart" );
$ajax_nonce_wishlist = wp_create_nonce( "add-to-wishlist" );
$ajax_nonce_wishlist_update = wp_create_nonce( "update-wishlist" );
?>
<script type="text/javascript">
	function add_to_cart(target, product_id, variation_id, campaign_id, wishlist_id) {
        var initial_cart_count = jQuery('header span.header-cart-count').html();

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
                campaign_id: campaign_id,
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
                    if (response == 'wishlist-item-already-purchased') {
                        target.after("<div class='message add-to-cart-response'><?php _e('Wishlist item already purchased or found in cart', 'hamburger-cat'); ?></div>");
                        jQuery('header span.header-cart-count').html(initial_cart_count);

                    }
                    else {
                		target.after("<div class='message add-to-cart-response'><?php _e('Added to cart.', 'hamburger-cat'); ?><br/><?php echo sprintf(__('<a href=\'%s\'><strong>View Cart</strong>.</a>', 'hamburger-cat'), wc_get_cart_url()); ?></div>");
                        setTimeout(function() {
                        	jQuery('header span.header-cart-count').html(response);
                        }, 1500);
                    }
                }
                else {
            		target.find('.button-spinner').remove();
                    console.log("No response!");
                }
            }
        });

	}

    function add_to_wishlist(target, product_id, variation_id, wishlist_id) {
        target.append("<i class='fas fa-circle-notch fa-spin button-spinner'></i>");
        jQuery(".message").remove();
        quantity = jQuery(target).data('qty');
        console.log("Add "+quantity+" to wishlist");
        
        jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url('admin-ajax.php');?>',
            dataType: "html",  
            data: { 
                action : 'austeve_add_to_wishlist', 
                security: '<?php echo $ajax_nonce_wishlist; ?>',
                product_id: product_id,
                wishlist_id: wishlist_id,
                quantity: quantity
            },
            error: function (xhr, status, error) {
                console.log("Error: " + error);
                target.find('.button-spinner').remove();
            },
            success: function( response ) {
                if (response) {
                    console.log("response! " + response);
                    target.find('.button-spinner').remove();
                    target.after("<div class='message'>"+response+"</div>");                                            
                }
                else {
                    target.find('.button-spinner').remove();
                    target.after("<div class='message'>Failed to add to wishlist. Contact support.</div>");
                }
            }
        });

    }

    function update_wishlist(target, wishlist_id, product_id ) {
        jQuery('.update-state').remove();

        target.after("<i class='fas fa-circle-notch fa-spin update-state button-spinner'></i>");
        
        quantity = jQuery(target).val();
        console.log("Update wishlist " + wishlist_id + " with "+quantity+" for product "+ product_id);
        
        jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url('admin-ajax.php');?>',
            dataType: "html",  
            data: { 
                action : 'austeve_update_wishlist', 
                security: '<?php echo $ajax_nonce_wishlist_update; ?>',
                product_id: product_id,
                wishlist_id: wishlist_id,
                quantity: quantity
            },
            error: function (xhr, status, error) {
                console.log("Error: " + error);
                jQuery('.update-state').remove();
            },
            success: function( response ) {
                if (response) {
                    console.log("response! " + response);
                    jQuery('.update-state').remove();
                    if (response != quantity) {
                        console.log('response does not match quantity specified!');
                        target.after("<i class='fas fa-exclamation-circle update-state update-alert'></i>");
                    }
                    else if (response === '0') {
                        console.log('Remove from list, or refresh!');
                        target.after("<i class='fas fa-check update-state update-success'></i>");
                        setTimeout(function() {
                            jQuery('.product-list li[data-product-id='+product_id+']').remove();
                        }, 1500);
                    }
                    else {
                        //all good
                        target.after("<i class='fas fa-check update-state update-success'></i>");
                    }
                }
                else {
                    jQuery('.update-state').remove();
                    target.after("!");
                }
            }
        });

    }

</script>