<div class="breadcrumb-navigation">
	<?php 
	$post_type_string = get_post_type($post);
	$post_type = get_post_type_object( $post_type_string ); 
	echo "<a class='button' href='".get_post_type_archive_link($post_type_string)."'>";
	echo __('Back to ').get_the_title(get_option('page_for_posts'));
	echo "</a>";
	?>
</div>