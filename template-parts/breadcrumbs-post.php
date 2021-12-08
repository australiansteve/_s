<?php 
$cat = get_the_category()[0];
error_log("Cat: ".print_r($cat, true));
error_log("def: ".print_r(get_option('default_category'), true));

if ($cat->term_id == get_option('default_category')) : 
?>
<div class="breadcrumb-navigation">
	<?php 
	$post_type_string = get_post_type($post);
	$post_type = get_post_type_object( $post_type_string ); 
	echo "<a class='button' href='".get_post_type_archive_link($post_type_string)."'>";
	echo __('Back to ').get_the_title(get_option('page_for_posts'));
	echo "</a>";
	?>
</div>
<?php 
else : 
?>
<div class="breadcrumb-navigation">
	<?php 
	echo "<a class='button' href='".get_category_link($cat)."'>";
	echo __('Back to ').$cat->name;
	echo "</a>";
	?>
</div>
<?php 
endif;
?>