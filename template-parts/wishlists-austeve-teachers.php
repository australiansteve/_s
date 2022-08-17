
<?php

/** This will display a 'View Wishlist' button for every wishlist a teacher has.
 *  In future we may want to narrow this down to a single active wishlist, perhaps related to a 
 *  Schools active Campaign 
 */

$teacher_id = get_the_ID();
$args = array(
	'post_type'              => array( 'austeve-wishlists' ),
	'post_status'            => array( 'publish' ),
	'order'   => 'ASC',
	'meta_query'              => array(
		array(
			'key'     => 'teacher',
			'value'   => $teacher_id,
			'compare' => '=',
		),
	),
);

$postsquery = new WP_Query( $args );

if ( $postsquery->have_posts() ) {
	while ( $postsquery->have_posts() ) {
		$postsquery->the_post();
		?>
		<a class="button" href="<?php echo get_post_permalink($wishlist_id);?>" target="_blank" onclick="return view_wishlist(<?php echo get_the_ID();?>)"><?php echo sprintf(__('View Wishlist', 'hamburger-cat')); ?></a>
		<?php
	}

} else {
}
wp_reset_postdata();
?>
	<a class="button" data-teacher-id="<?php echo get_the_ID(); ?>" data-open="donateModal" onclick="setup_donation(event)"><?php _e('Buy a Gift Card', 'hamburger-cat'); ?></a>

<?php
wp_reset_postdata();
?>
