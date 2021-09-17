<div class="breadcrumbs">
	<?php 
	$post_categories = wp_get_post_categories($post->ID);

	if(count($post_categories) > 0) {
		$category = $post_categories[0];

		echo "<a href='".get_category_link($category)."'>";
		echo __('All ', 'hamburger-cat').get_cat_name($category);
		echo "</a>";
	}
	?>
</div>