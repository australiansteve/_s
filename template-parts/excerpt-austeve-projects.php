<?php
/**
 * Template part for displaying excerpts on project archives
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hamburger_Cat
 */

?>
<div class="excerpt"><?php 
	$terms = get_the_terms($post, 'project-tags');
	$termStrings = array();
	foreach($terms as $term) {
		$termStrings[] = $term->name;
	}
	echo implode(', ', $termStrings); ?></div>