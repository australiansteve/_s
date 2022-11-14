<?php
$ajax_nonce_setup = wp_create_nonce( "setup-donation" );
$ajax_nonce = wp_create_nonce( "add-to-cart" );
?>
<div class="reveal make-donation-modal wishlist" id="donateModal" data-reveal data-options="animationIn:slide-in-up; animationOut:slide-out-down;">

	<div class="modal-container">

		<h3 class='modal-title'><?php _e('Gift card', 'hamburger-cat'); ?></h3>

		<?php the_field('teacher_gift_card_description', 'options'); ?>

		<div class="donation-html">
			<div class="text-center"><i class="fas fa-circle-notch fa-spin"></i></div>
		</div>

		<button class="close-button" data-close aria-label="Close modal" type="button">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

</div>

<div class="reveal make-donation-modal campaign" id="campaignDonateModal" data-reveal data-options="animationIn:slide-in-up; animationOut:slide-out-down;">

	<div class="modal-container">

		<h3 class='modal-title'><?php _e('Gift card', 'hamburger-cat'); ?></h3>

		<?php the_field('school_gift_card_description', 'options'); ?>

		<div class="donation-html">
			<div class="text-center"><i class="fas fa-circle-notch fa-spin"></i></div>
		</div>

		<button class="close-button" data-close aria-label="Close modal" type="button">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

</div>


<script type="text/javascript">

	function setup_donation(e) {
		e.preventDefault();
		jQuery('.make-donation-modal .donation-html').html("<div class='text-center'><i class='fas fa-circle-notch fa-spin'></i></div>");

		var wishlist_id = jQuery(e.target).data('wishlist-id');
		var campaign_id = jQuery(e.target).data('campaign-id');
		var class_name = wishlist_id === undefined ? 'campaign' : 'wishlist';

		jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url('admin-ajax.php');?>',
            dataType: "html",  
            data: { 
                action : 'austeve_setup_donation', 
                security: '<?php echo $ajax_nonce_setup; ?>',
                wishlist_id: wishlist_id,
                campaign_id: campaign_id
            },
            error: function (xhr, status, error) {
                console.log("Error: " + error);
                
            },
            success: function( response ) {
                if (response) {
                    jQuery('.make-donation-modal.'+class_name+' .donation-html').html(response);
                    jQuery('.make-donation-modal.'+class_name+' #variation_id').select2({
                      	minimumResultsForSearch: -1
                      }
                    );
                }
                else {
                    console.log("No response!");
                }
            }
        });

	}

	function add_donation_to_cart(e) {
		e.preventDefault();

		var target = jQuery(e.target);
		var product_id = jQuery('.make-donation-modal input[name=product_id]').val();
		var variation_id = jQuery('.make-donation-modal select[name=variation_id]').val();
		var wishlist_id = jQuery('.make-donation-modal input[name=wishlist_id]').val();
		var campaign_id = jQuery('.make-donation-modal input[name=campaign_id]').val();

		jQuery('header span.header-cart-count').html("<i class='fas fa-circle-notch fa-spin'></i>");
		target.append("<i class='fas fa-circle-notch fa-spin button-spinner'></i>");

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
                campaign_id: campaign_id
            },
            error: function (xhr, status, error) {
                console.log("Error: " + error);
            	target.find('.button-spinner').remove();
            },
            success: function( response ) {
                if (response) {
            		target.find('.button-spinner').remove();
            		target.after("<div class='message add-to-cart-response'><?php _e('Added to cart.', 'hamburger-cat'); ?><br/><?php echo sprintf(__('<a href=\'%s\'><strong>View Cart</strong>.</a>', 'hamburger-cat'), wc_get_cart_url()); ?></div>");
                    setTimeout(function() {
                    	jQuery('header span.header-cart-count').html(response);
                    }, 1500);
                    setTimeout(function() {
                    	jQuery("#donateModal .close-button").trigger('click');
                    }, 3000);
                    
                }
                else {
            		target.find('.button-spinner').remove();
                    console.log("No response!");
                }
            }
        });

	}
</script>