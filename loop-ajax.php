<?php

	$paged 			= $_POST['page_no'];
	$page_id		= $_POST['page_id'];
	$page_date		= $_POST['page_date'];
	$cat_id 		= $_POST['cat_id'];
	$search_query 	= $_POST['search_query'];

	echo $post_date;

	$temp_post = $post; // Storing the object temporarily

	$args = array(
		'post__not_in'			=> array($page_id), // Exclude current post
		'date_query'			=> array(
			'before' => $page_date, // affter current article date
		),
		'cat'					=> $cat_id, // show certain category
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
			get_template_part( 'post' );
			get_sidebar();
		}
	}

	$post = $temp_post; // Restore the value of $post to the original
?>