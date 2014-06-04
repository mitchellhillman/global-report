<?php get_header(); ?>

<?php
// Start the Loop.
while ( have_posts() ) : the_post(); ?>

	<div class="page-content">
		<div class="column">
			<?php the_category() ?>
			<h1><?php the_title(); ?></h1>
		
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

			<?php the_content(); ?>
		</div><!-- /.column -->

	</div><!-- /.page-content -->

<?php 
// End the Loop.
endwhile; ?>

		<div class="column">
			<div class="footer">
				<p class="copyright">Copyright <?php bloginfo( $name ); ?> &copy; <?php echo date('Y'); ?></p>
			</div><!-- /.footer -->
		</div>
		
<?php get_footer();
