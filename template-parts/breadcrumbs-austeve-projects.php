<div class="breadcrumbs">
	<?php 
	function austeve_term_crumb($term) {
		$crumb = " > "."<a href='".get_term_link($term->term_id)."'>".$term->name."</a>";
		return $crumb;
	}

	$crumbs = "";

	//Work backwards from the selected project category
	$terms = get_the_terms( $post, 'project-category' );
	if( $terms ) {
		$termId = $terms[0]->term_id;
		$crumbs = austeve_term_crumb($terms[0]);

		$parentTerm = get_term_by('id', $terms[0]->parent, 'project-category');
		while($parentTerm) {
			//echo "Parent: ".print_r($parentTerm, true);
			$crumbs = austeve_term_crumb($parentTerm).$crumbs;
			$parentTerm = get_term_by('id', $parentTerm->parent, 'project-category');
		}
	}

	//Finally put the link to the post type archive
	$post_type_string = get_post_type($post);
	$post_type = get_post_type_object( $post_type_string ); 
	$crumbs = "<a href='".get_post_type_archive_link($post_type_string)."'>".get_post_type_labels($post_type)->all_items."</a>".$crumbs;

	echo $crumbs;
	?>
</div>
