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

			</script>

			<?php get_template_part('template-parts/donation-setup'); ?>

		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
