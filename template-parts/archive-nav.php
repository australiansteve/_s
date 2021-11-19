<?php
$nav_type = get_field('archive_navigation_type', 'options');

if ( $nav_type == "paged" ) {
	global $wp_query;
	$currentPage = get_query_var('paged') ? get_query_var('paged') : '1';
	$numPages = $wp_query->max_num_pages;;

	if ($numPages > 1) :
		?>

		<div class="grid-x navigation">
			<div class="cell small-6 medium-5 text-left medium-text-right">
				<?php echo get_previous_posts_link( ' <i class="fas fa-chevron-left"></i> <span class="nav-title screen-reader-text">Previous Page</span>' ); ?>
			</div>
			<div class="cell small-6 medium-5 text-right medium-order-3 medium-text-left">
				<?php echo get_next_posts_link( '<span class="nav-title screen-reader-text">Next Page</span> <i class="fas  fa-chevron-right"></i>' ); ?>
			</div>
			<div class="cell medium-order-2 medium-2 text-center">
				Page <?php echo $currentPage;?> of <?php echo $numPages;?>
			</div>
		</div>

		<?php

	endif;
}
else if( $nav_type == "infinite-scroll" ) {

	error_log(print_r(get_queried_object(), true)." get_queried_object()");

	$queried_object = get_queried_object();

	if (is_a($queried_object, 'WP_Term')) {
		$term_id = $queried_object->term_id;
		$taxonomy = get_term( $term_id )->taxonomy;
		$post_type = get_taxonomy( $taxonomy )->object_type[0];
	}
	else {
		$post_type = get_post_type();
		$term_id = -1;
	}

	?>
	<div class="text-center">
		<a class="button load-more"><?php _e('Load More', 'hamburger-cat');?></a>
	</div>
	<script type="text/javascript">

		function loadMore() {
			//console.log("loadMore");
			var next_page_placeholder = jQuery('.next-page').first();
			var page = parseInt(jQuery(next_page_placeholder).attr('data-page'), 10);
			var origText = jQuery('.load-more').html();

			jQuery('.load-more').addClass('disabled');
			jQuery('.load-more').append("<i style='margin-left: 0.75em' class='fas fa-spinner fa-spin'></i>");

			next_page_placeholder.attr('data-page', page + 1);

			jQuery.ajax({
				type: 'POST',
				url: '<?php echo admin_url('admin-ajax.php');?>',
				dataType: "html",  
				data: { 
					action : 'austeve_get_more_archive', 
					security: '<?php echo wp_create_nonce( "get-more"); ?>',
					post_type: '<?php echo $post_type;?>',
					term_id: '<?php echo $term_id;?>',
					page: page
				},
				error: function (xhr, status, error) {
					console.log("Error: " + error);
					next_page_placeholder.attr('data-page', page);
				},
				success: function( response ) {
					//console.log(response);
					if (response == "") {
						jQuery('.load-more').hide();
						next_page_placeholder.attr('data-page', page);
					}
					else {
						next_page_placeholder.before(response);
						jQuery('.load-more').removeClass('disabled');
						jQuery('.load-more').html(origText);
					}

				}
			});
		}	

		jQuery(document).ready(function() {
			jQuery(window).on('scroll', _.debounce(function() {

				if (!jQuery('.load-more').hasClass('disabled') && jQuery('.load-more').is(":visible")) {
					loadMore();
				}

			}, 1000, {'leading' : false,  'trailing' : true }));
		});

		jQuery(document).on('click', '.button.load-more', function() {
			if (!jQuery(this).hasClass('disabled')) {
				loadMore();
			}
		});

	</script>
	<?php
}
?>
