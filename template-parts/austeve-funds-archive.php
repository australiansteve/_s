<?php
global $post;
global $categoryBgColors;

$terms = get_the_terms($post, 'austeve-funds-category' );

$bgColor = get_field('default_fund_background_color', 'option'); //Default color
if ($terms)
{
	foreach($terms as $term)
	{
		//Don't color according to 'featured' post category
		if ($term->slug != 'featured')
		{
			if (array_key_exists($term->term_id, $categoryBgColors))
			{
				$bgColor = $categoryBgColors[$term->term_id];
			}
		}
	}
}

?>
<div class="cell fund">
	<div class="container">
		<div class="bg-image" style="background-image:url(<?php the_post_thumbnail_url();?>)"></div>
		<div class="bg-color" style="background-color:<?php echo $bgColor; ?>"></div>

		<div class="grid-x archive-content">
			<div class="cell" data-equalizer-watch="fund">
				<?php the_title('<h4>', '</h3>'); ?>
			</div>
			<div class="cell">
				<div class="action">		
					<a class="button" href="<?php the_permalink();?>"><?php the_field('funds_button_text', 'option');?></a>
				</div>
			</div>
		</div>

	</div>
</div>
