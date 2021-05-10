<div class="breadcrumbs">
	<?php 
	$post_type_string = get_post_type($post);
	echo "<a href='".get_post_type_archive_link($post_type_string)."'>";
	echo get_field('back_to_news_text', 'option');
	echo "</a>";
	?>
</div>