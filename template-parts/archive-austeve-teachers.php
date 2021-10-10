<?php
$tschool = get_field('school');
$tgrade = get_field('grade');
$sgrades = get_field('grades', $tschool);
//echo "GRADES: ".print_r($sgrades, true);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<?php $austeve_gradehelper = new AUSteve_GradeHelper(); ?>
	<div class="grid-x grid-margin-x text-left wishlists-grid" >
		<div class="cell medium-4 xlarge-3">
			<h3 class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
			<?php 
			echo $sgrades[$tgrade]['grade']; 
			?>
		</div>
		<div class="cell medium-8 xlarge-9 text-right wishlist-buttons">

			<?php get_template_part( 'template-parts/wishlists', get_post_type() ); ?>

		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
