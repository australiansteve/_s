<div class="breadcrumbs">
	<?php 
	$post_type_string = get_post_type($post);
	$post_type = get_post_type_object( $post_type_string ); 
	$link = get_the_permalink(get_field('programs_page', 'options'));
	if ($link) {
		echo "<a href='".$link."'>";
		echo get_post_type_labels($post_type)->all_items;
		echo "</a>";
	}
	?>
</div>