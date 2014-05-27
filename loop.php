<?php
	$temp_post = $post; // Storing the object temporarily

	$args = array(
		'p'						=> get_the_ID(),
		'cat'					=> get_query_var('cat'),
		'paged'					=> $paged,
		'posts_per_page' 		=> 1,
		'ignore_sticky_posts' 	=> true,
		'post_status'      		=> 'publish',
		'orderby'				=> 'date',
	);

	$main_posts = new WP_Query($args);

	if($main_posts->have_posts()) {
		while($main_posts->have_posts()) {
			$main_posts->the_post();
			get_template_part( 'content', 'post' );				
		}
	}
	else {
		get_template_part( 'message', 'noresults');
	}
	$post = $temp_post; // Restore the value of $post to the original
?>

