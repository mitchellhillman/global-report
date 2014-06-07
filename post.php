<div class="main-entry" data-id="<?php echo get_the_ID(); ?>" id="post-<?php echo get_the_ID();; ?>">

	<div class="column">
		<ul class="post-categories">
		<?php
			$categories = get_the_category('' );
			foreach ($categories as $category) {
			echo '<li>'.$category->name.'</li>';
			}
		?>
		</ul>
		<h1 class="post-title"><?php the_title(); ?></h1>

		<ul class="share">
			<li><span class="icon-share"><span class="screen-reader-text">Share: </span></span></li>
			<li><a class="icon-facebook" href="https://www.facebook.com/sharer/sharer.php?<?php the_permalink(); ?>"><span class="screen-reader-text">Share on Facebook</span></a></li>
			<li><a class="icon-twitter" href="https://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink() ?>"><span class="screen-reader-text">Share on Twitter</span></a></li>
			<li><a class="icon-googleplus" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><span class="screen-reader-text">Share on Google+</span></a></li>
		</ul>

		<?php 
			$email = get_the_author_meta('user_email');
			$size = 120;
			$alt = get_the_author_meta('first_name').' '.get_the_author_meta('last_name');
		?>
		<div class="meta <?php if ( globalreport_validate_gravatar($email) ) { echo 'has-image'; } ?>">
			<?php if ( globalreport_validate_gravatar($email) ): ?>
				<div class="author-gravatar">
					<?php echo get_avatar( $email, $size, $alt ); ?>
				</div><!-- /.author-gravatar -->
			<?php endif; ?>

			<p>by <Strong><?php the_author_link(); ?></strong> on <strong><?php the_date(); ?></strong></p>
			<p class="author-description"><?php the_author_meta('description'); ?></p>
		</div><!-- /.meta -->
	
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
		<div class="entry-content">
			<?php if (has_excerpt()): ?>
				<div class="intro">
					<?php the_excerpt() ?>
				</div><!-- /.intro -->	
			<?php endif ?>
			<?php the_content(' more &hellip;'); ?>
		</div><!-- /.post-content --> 
	</div><!-- /.column -->
</div><!-- /.main-entry -->
