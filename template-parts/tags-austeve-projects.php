<div class="tags">
	<?php 
	$terms = get_the_terms($post, 'project-tags');
	$termStrings = array();
	foreach($terms as $term) {
		$termStrings[] = "<a href='".get_term_link($term, 'project-tags')."'><i>".$term->name."</i></a>";
	}
	echo implode(', ', $termStrings); ?>
</div>