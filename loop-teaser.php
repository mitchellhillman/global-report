<?php

	$temp_post = $post; // Storing the object temporarily

	$args = array(
		'posts_per_page' => -1,
		'orderby'		=> 'date',
	);

	$sidebar_posts = new WP_Query($args);

	if($sidebar_posts->have_posts()) {
		$flag = 1;
		while($sidebar_posts->have_posts()) {
			$sidebar_posts->the_post(); ?>

			
<div class="sidebar-entry" data-id="<?php echo get_the_ID(); ?>" id="post-<?php echo get_the_ID();; ?>">
	<?php if ($flag == 1): ?>
		<?php the_post_thumbnail(); ?>
	<?php endif ?>
	<div class="entry-content">
		<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
		<ul class="post-categories">
		<?php
			$categories = get_the_category('' );
			foreach ($categories as $category) {
				echo '<li>'.$category->name.'</li>';
			}
		?>
		</ul>
		<h3><?php the_title(); ?></h3>
		<?php the_excerpt(); ?>
		</a>
	</div><!-- /.entry-content -->
</div><!-- .sidebar-entry -->


			<?php $flag++;
		}
	} 
	else {
		get_template_part( 'message', 'noresults');
	}

	$post = $temp_post; // Restore the value of $post to the original
?>
