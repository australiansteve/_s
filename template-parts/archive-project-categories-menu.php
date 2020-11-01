<?php
$categories = get_terms([
	'taxonomy' => 'project-category',
	'hide_empty' => false,
]);
?>
<div class="grid-x small-up-2 medium-up-<?php echo count($categories);?> text-center" id="project-category-grid">
	<?php
	foreach($categories as $category) {
		$cat = get_term($category->term_id, 'project-category');
		echo "<div class='cell'><a href='#project-category-".$cat->slug."' data-project-category='".$cat->slug."'>". $cat->name ."</a></div>";
	}
	?>
</div>