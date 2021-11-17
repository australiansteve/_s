<?php
	$current_post_type = get_post_type();

?>

<div class="archive-filter austeve-paintings">
<?php 
	$terms = get_terms( 
		array (
		    'taxonomy' => 'painting-category',
		    'hide_empty' => true,
		) 
	);
	
	$has_active_term = false;

	foreach($terms as $term) {
		$active_class = is_tax('painting-category', $term) ? 'active' : 'not-active';
		$has_active_term = $has_active_term || ($active_class == 'active');
		if (!is_tax('painting-category', $term)) {
			echo "<a href='".get_term_link($term, 'painting-category')."' class='button ".$active_class."'>".sprintf(__('View %s Paintings', 'hamburger-cat'), $term->name)."</a>";
		}
	}
	if ($has_active_term) {
		echo "<a href='".get_post_type_archive_link($current_post_type)."' class='button ".($has_active_term ? 'not-active' : 'active')."'>".__('View All Paintings', 'hamburger-cat')."</a>";
	}
?>
</div>