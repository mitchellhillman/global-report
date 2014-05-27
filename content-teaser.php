<div class="sidebar-entry">
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