<?php

	$temp_post = $post; // Storing the object temporarily

	$args = array(
		'posts_per_page' => -1,
		'orderby'		=> 'date',
	);

	$sidebar_posts = new WP_Query($args);

	if($sidebar_posts->have_posts()) {
		while($sidebar_posts->have_posts()) {
			$sidebar_posts->the_post();
			get_template_part( 'content', 'teaser' );
		}
	} 
	else {
		get_template_part( 'message', 'noresults');
	}

	$post = $temp_post; // Restore the value of $post to the original
?>
