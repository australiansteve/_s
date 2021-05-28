<div class="breadcrumbs">
	<?php 
	$post_type_string = get_post_type($post);
	//echo $post_type_string;
	$post_type = get_post_type_object( $post_type_string ); 
	$link = get_post_type_archive_link($post_type_string);
	if ($link) {
		echo "<a href='".$link."'>";
		echo get_post_type_labels($post_type)->all_items;
		echo "</a>";
	}
	?>
</div>