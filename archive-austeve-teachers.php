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
				$school_id = intval(get_query_var('school'), 10);
				if($school_id) :
					echo '<h2 class="page-title">'.get_the_title($school_id).'</h2>';
					?>
					<a class="button" data-school-id="<?php echo $school_id; ?>" data-open="schoolDonateModal" onclick="setup_donation(event)"><?php _e('Buy Gift Card for school', 'hamburger-cat'); ?></a>

					<?php
				else: 
					the_archive_title( '<h2 class="page-title">', '</h2>' );
				endif;

				get_template_part('template-parts/school-search');
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

			<div class="reveal make-donation-modal teacher" id="donateModal" data-reveal data-options="animationIn:slide-in-up; animationOut:slide-out-down;">

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

			<div class="reveal make-donation-modal school" id="schoolDonateModal" data-reveal data-options="animationIn:slide-in-up; animationOut:slide-out-down;">

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

			<div class="reveal view-wishlist-modal" id="wishlistModal" data-reveal data-options="animationIn:slide-in-up; animationOut:slide-out-down;">
				<div class="modal-container">
					<div class="modal-html">
						<div class="text-center"><i class="fas fa-circle-notch fa-spin"></i></div>
					</div>

					<button class="close-button" data-close aria-label="Close modal" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

			</div>

			<script type="text/javascript">

				function clear_view_viewlist() {
					jQuery('.view-wishlist-modal .modal-html').html("<div class='text-center'><i class='fas fa-circle-notch fa-spin'></i></div>");
				}

				function view_wishlist(e) {
					e.preventDefault();

					clear_view_viewlist();

					var teacher_id = jQuery(e.target).data('teacher-id');
					var wishlist_id = jQuery(e.target).data('wishlist-id');

					jQuery.ajax({
		                type: 'POST',
		                url: '<?php echo admin_url('admin-ajax.php');?>',
		                dataType: "html",  
		                data: { 
		                    action : 'austeve_get_view_wishlist', 
		                    security: '<?php echo $ajax_nonce_get_wishlist; ?>',
		                    teacher_id: teacher_id,
		                    wishlist_id: wishlist_id
		                },
		                error: function (xhr, status, error) {
		                    console.log("Error: " + error);
		                    
		                },
		                success: function( response ) {
		                    if (response) {
		                        jQuery('.view-wishlist-modal .modal-html').html(response);
		                    }
		                    else {
		                        console.log("No response!");
		                    }
		                }
		            });

				}

				function setup_donation(e) {
					e.preventDefault();
					jQuery('.make-donation-modal .donation-html').html("<div class='text-center'><i class='fas fa-circle-notch fa-spin'></i></div>");

					var teacher_id = jQuery(e.target).data('teacher-id');
					var school_id = jQuery(e.target).data('school-id');
					var class_name = teacher_id === undefined ? 'school' : 'teacher';

					jQuery.ajax({
		                type: 'POST',
		                url: '<?php echo admin_url('admin-ajax.php');?>',
		                dataType: "html",  
		                data: { 
		                    action : 'austeve_setup_donation', 
		                    security: '<?php echo $ajax_nonce_setup; ?>',
		                    teacher_id: teacher_id,
		                    school_id: school_id
		                },
		                error: function (xhr, status, error) {
		                    console.log("Error: " + error);
		                    
		                },
		                success: function( response ) {
		                    if (response) {
		                        jQuery('.make-donation-modal .donation-html').html(response);


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
					var teacher_id = jQuery('.make-donation-modal input[name=teacher_id]').val();
					var school_id = jQuery('.make-donation-modal input[name=school_id]').val();

					jQuery('header span.header-cart-count').html("<i class='fas fa-circle-notch fa-spin'></i>");
					target.append("<i class='fas fa-circle-notch fa-spin button-spinner'></i>");

					jQuery.ajax({
		                type: 'POST',
		                url: '<?php echo admin_url('admin-ajax.php');?>',
		                dataType: "html",  
		                data: { 
		                    action : 'austeve_add_to_cart', 
		                    security: '<?php echo $ajax_nonce; ?>',
		                    product_id: variation_id,
		                    variation_id: variation_id,
		                    teacher_id: teacher_id,
		                    school_id: school_id
		                },
		                error: function (xhr, status, error) {
		                    console.log("Error: " + error);
                        	target.find('.button-spinner').remove();
		                },
		                success: function( response ) {
		                    if (response) {
                        		target.find('.button-spinner').remove();
                        		target.after("<div class='message'><?php _e('Added to cart.', 'hamburger-cat'); ?><br/><?php echo sprintf(__('<a href=\'%s\'><strong>View Cart</strong>.</a>', 'hamburger-cat'), wc_get_cart_url()); ?></div>");
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

				jQuery(document).ready(function() {

					jQuery.ajax({
					    type: 'POST',
					    url: '<?php echo admin_url('admin-ajax.php');?>',
					    dataType: "html",  
					    data: { 
					        action : 'austeve_get_cart_count', 
					        security: '<?php echo wp_create_nonce( "get-cart-count" ); ?>'
					    },
					    error: function (xhr, status, error) {
					        console.log("Error: " + error);
					        
					    },
					    success: function( response ) {
					        if (response) {
					            jQuery('header .fa-shopping-cart').after("<span class='header-cart-count'>"+response+"</span>");
					        }
					        else {
					            console.log("No response!");
					        }
					    }
					});
				});
			</script>

		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
