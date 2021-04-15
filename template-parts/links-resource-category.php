<div id="resource-categories" class="grid-x grid-padding-x small-up-1 medium-up-4" data-equalizer data-equalize-on="medium">				
	<?php
		$taxonomy = 'resource-category';
		$terms = get_terms($taxonomy); // Get all terms of a taxonomy

		if ( $terms && !is_wp_error( $terms ) ) :
		
			foreach ( $terms as $term ) { 

				$termMeta = json_decode($term->description);
				error_log("Term Desc: ".$term->description);
				error_log("Term Meta: ".print_r($termMeta, true));
				$classes = 'resource-category';

				if (is_tax( $taxonomy, $term->slug ))
				{
					$classes .= ' active';
				}
				?>
		        	<div class='cell <?php echo $classes; ?>' style='background-image: url(<?php echo isset($termMeta->bgImage) ? $termMeta->bgImage : 'none'; ?>)''>
		        		
		            	<a href="<?php echo get_term_link($term->slug, $taxonomy); ?>">
		            		<img class='resource-category-icon' src="<?php echo isset($termMeta->iconImage) ? $termMeta->iconImage : '';?>"/>
		            		<h3 class='resource-category-title'><?php echo $term->name; ?></h3>
		            	</a>
		            </div>
		        <?php } 

		endif;?>

</div>