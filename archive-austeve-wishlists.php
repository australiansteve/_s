<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

get_header();

$ajax_nonce_get_wishlist = wp_create_nonce( "get-wishlist" );
$ajax_nonce_setup = wp_create_nonce( "setup-donation" );
$ajax_nonce = wp_create_nonce( "add-to-cart" );
?>

<main id="primary" class="site-main">

	<div class="grid-container">

		<div class="page-content text-center">

			<div class="entry-content">

				<?php
				$campaign_id = intval(get_query_var('campaign_id'), 10);
				if($campaign_id) :
					echo '<h1 class="page-title">'.get_the_title($campaign_id).'</h1>';
					?>
					<a class="button" data-campaign-id="<?php echo $campaign_id; ?>" data-open="campaignDonateModal" onclick="setup_donation(event)"><?php _e('Buy Gift Card for school', 'hamburger-cat'); ?></a>

					<?php
				else: 
					the_archive_title( '<h1 class="page-title">', '</h1>' );
				endif;

				get_template_part('template-parts/campaign-search');
				?>

				<div class="grid-x grid-padding-x small-up-1 archive-grid-<?php echo get_queried_object()->name; ?>" >
					<?php
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							?>

							<div class="cell">
								<?php get_template_part( 'template-parts/archive', get_post_type() ); ?>
							</div>

							<?php
						endwhile;
					else :?>

						<div class="cell">
							<?php get_template_part( 'template-parts/empty-archive', get_queried_object()->name ); ?>
						</div>
						<?php
					endif;
					?>
				</div>

				<?php get_template_part( 'template-parts/archive', 'nav' ); ?>
				
			</div>

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

			<?php get_template_part('template-parts/js'); ?>

			<script type="text/javascript">

				function view_wishlist(wishlist_id) {
					
					console.log("view_wishlist " + wishlist_id);

					var wishlistCookie = getCookie('wishlist_id');

					if (wishlistCookie) {
						//Clear current cookie value
						document.cookie = "wishlist_id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
					}
					
					//Set new cookie value
					setCookie('wishlist_id', wishlist_id);
				}

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

		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
