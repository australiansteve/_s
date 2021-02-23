<?php
$defaultCategory = get_field('projects_default_category', 'options');
$terms = get_terms( 'project-category');
$termStrings = array();

if (count($terms) > 0) :
	?>
	<div class="entry-content">
		<div class="grid-x medium-up-2" id="archive-tab-grid">
			<?php
			foreach($terms as $term) :
				$activeClass = is_tax( 'project-category', $term->term_id ) ? 
						'active' : 
						(is_post_type_archive('austeve-projects') && $term->term_id == $defaultCategory  ? 'active': '');
				?>
				<div class="cell">
					<div class="container project-category link <?php echo $activeClass;?>">
						<h4><a href="<?php echo get_term_link($term->term_id, 'project-category');?>"><?php echo $term->name;?></a></h4>
					</div>
				</div>
				<?php
			endforeach;
			?>
		</div>
	</div>
	<?php
endif;
?>