<?php
// function to display number of posts.
function getPostViews($postID){
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return '0 View';
	}
	return $count.' Views';
}

// function to count views.
function setPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	}else{
		$count  ;
		update_post_meta($postID, $count_key, $count);
	}
}

// Add it to a column in WP-Admin - (Optional)
add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
function posts_column_views($defaults){
	$defaults['post_views'] = __('Views', 'semifolio');
	return $defaults;
}
function posts_custom_column_views($column_name, $id){
	if($column_name === 'post_views'){
		echo getPostViews(get_the_ID());
	}
}
 
// Popular post
if ( ! function_exists( 'semifolio_popular_post' ) ) :
function semifolio_popular_post() {
$query_posts = new WP_Query('meta_key=post_views_count&orderby=meta_value_num&order=DESC&posts_per_page=1');
	if ( $query_posts -> have_posts() ) : while ( $query_posts -> have_posts() ) : $query_posts -> the_post(); ?>
	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<?php the_content(); ?>
	<?php
	endwhile; endif;
	wp_reset_query();
}
endif;
add_action( 'display_popular_post', 'semifolio_popular_post' );
?>
