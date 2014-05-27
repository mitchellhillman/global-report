<div class="main-entry" data-id="<?php echo get_the_ID(); ?>">

	<div class="column">
		<ul class="post-categories">
		<?php
			$categories = get_the_category('' );
			foreach ($categories as $category) {
			echo '<li>'.$category->name.'</li>';
			}
		?>
		</ul>
		<h1><?php the_title(); ?></h1>

		<div class="meta">
			<?php 
				$email = get_the_author_meta('user_email');
				$size = 60;
				$alt = get_the_author_meta('first_name').' '.get_the_author_meta('last_name');
			
				if ( gr_validate_gravatar($email) ) {
					echo get_avatar( $email, $size, $alt );
				}
			?>
			<p>by <Strong><?php the_author_link(); ?></strong> on <strong><?php the_date(); ?></strong></p>
			<p class="author-description"><?php the_author_meta('description'); ?></p>
		</div>
	
	<?php if (has_post_thumbnail()): ?>
	</div><!-- /.column -->
	<div class="featured-image">
		<?php the_post_thumbnail() ?>
		<?php if( get_post(get_post_thumbnail_id(), ARRAY_A)['post_excerpt'] ) : ?>
		<div class="featured-image-caption">
			<p><?php echo get_post(get_post_thumbnail_id(), ARRAY_A)['post_excerpt']; ?></p>
		</div>
		<?php endif; ?>
	</div>
	<div class="column">
	<?php endif; ?>

		<?php if (has_excerpt()): ?>
			<div class="intro">
				<?php the_excerpt() ?>
			</div><!-- /.intro -->	
		<?php endif ?>
		<?php the_content(); ?>
	</div><!-- /.column -->

</div><!-- /.main-entry -->