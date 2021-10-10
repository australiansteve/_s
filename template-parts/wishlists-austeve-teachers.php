
<?php
$teacher_id = get_the_ID();
$args = array(
	'post_type'              => array( 'austeve-wishlists' ),
	'post_status'            => array( 'publish' ),
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
		$categories = get_the_terms($post->ID, 'wishlist-category');
		$category_name = is_array($categories) && count($categories) > 0 ? $categories[0]->name : "";
		?>
		<a class="button" data-teacher-id="<?php echo $teacher_id; ?>" data-wishlist-id="<?php echo get_the_ID(); ?>" data-open="wishlistModal" onclick="view_wishlist(event)" href="<?php the_field('wishlist_url');?>" target="_blank" ><?php echo sprintf(__('View %s Wishlist', 'hamburger-cat'), $category_name); ?></a>
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
