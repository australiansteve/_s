<?php
$wteacher = get_field('user_id');
$tschool = get_field('school', 'user_'.$wteacher);
$tgrade = get_field('grade', 'user_'.$wteacher);
$sgrades = get_field('grades', $tschool);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<?php $austeve_gradehelper = new AUSteve_GradeHelper(); ?>
	<div class="grid-x grid-margin-x text-left wishlists-grid" >
		<div class="cell medium-5 xlarge-4">
			<h3 class="post-title"><a href="<?php the_permalink();?>"><?php echo get_userdata($wteacher)->display_name;?></a></h3>
			<?php 
			echo $sgrades[$tgrade]['grade']; 
			?>
		</div>
		<div class="cell medium-7 xlarge-8 text-right wishlist-buttons">

			<a class="button" href="<?php echo get_the_permalink();?>" onclick="return view_wishlist(<?php echo get_the_ID();?>)"><?php echo sprintf(__('View Wishlist', 'hamburger-cat')); ?></a>

			<a class="button" data-wishlist-id="<?php echo get_the_ID(); ?>" data-open="donateModal" onclick="setup_donation(event)"><?php _e('Buy a Gift Card', 'hamburger-cat'); ?></a>

		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
