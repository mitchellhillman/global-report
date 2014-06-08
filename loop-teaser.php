<?php

	$temp_post = $post; // Storing the object temporarily

	$args = array(
		'orderby'			=> 'date',
		'post_status'      	=> 'publish',
		'posts_per_page'	=> 15,
	);

	$sidebar_posts = new WP_Query($args);

	if($sidebar_posts->have_posts()) {
		$first = 1;
		while($sidebar_posts->have_posts()) {
			$sidebar_posts->the_post();
			get_template_part( 'teaser' );
			$first++;
		}
	} 
	else {
		get_template_part( 'message', 'noresults');
	}

	$post = $temp_post; // Restore the value of $post to the original
?>
