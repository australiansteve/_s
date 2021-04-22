<?php
$bgColor = get_field('background_color');
if(!$bgColor)
{
	$bgColor = '#bc5298';
}

?>
<div class="cell small-12 medium-6 featured-fund">
	<div class="container">
		<div class="bg-image" style="background-image:url(<?php the_post_thumbnail_url();?>)"></div>
		<div class="bg-color" style="background-color:<?php echo $bgColor; ?>"></div>

		<div class="grid-x align-middle featured-fund" data-equalizer-watch="box">
			<div class="cell small-12">

				<?php the_title('<h3>', '</h3>'); ?>
				
				<div class="description">
					<?php the_field('short_description'); ?>
				</div>

				<div class="action">		
					<a class="button" href="<?php the_permalink();?>"><?php the_field('funds_button_text', 'option');?></a>
				</div>

			</div>
		</div>
	</div>
</div>
