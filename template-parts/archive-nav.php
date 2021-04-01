<?php
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
?>
