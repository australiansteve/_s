<div class="breadcrumbs">
	<div class="grid-x align-center">
		<div class="cell text-center">
			<?php 
			$post_type_string = get_post_type($post);
			$post_type = get_post_type_object( $post_type_string ); 
			echo "<a class='button' href='".get_post_type_archive_link($post_type_string)."'>";
			echo get_post_type_labels($post_type)->all_items;
			echo "</a>";
			?>
		</div>
	</div>
</div>