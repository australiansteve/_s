<div class="breadcrumbs">
	<div class="grid-x align-center grid-margin-x">
		<div class="cell medium-6 text-center medium-text-right" id="back-to-posts">
			<?php 
			$post_type_string = get_post_type($post);
			$post_type = get_post_type_object( $post_type_string ); 
			echo "<a class='button' href='".get_post_type_archive_link($post_type_string)."'>";
			echo get_post_type_labels($post_type)->all_items;
			echo "</a>";
			?>
		</div>
		<div class="cell medium-6 text-center medium-text-left" id="newsletter-signup">
			<?php 
			$post_type_string = get_post_type($post);
			$post_type = get_post_type_object( $post_type_string ); 
			echo "<a class='button' href='".get_post_type_archive_link($post_type_string)."'>";
			echo "Newsletter signup";
			echo "</a>";
			?>
		</div>
	</div>
</div>