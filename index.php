<?php get_header(); ?>

<div class="scroller">
	<div class="sidebar">
		<div class="sidebar-scroll-wrapper">
			<div class="sidebar-scroll">
				<?php get_template_part( 'loop', 'teaser' );   ?>
			</div><!-- /.sidebar-scroll --> 
		</div><!-- /.sidebar-scroll-wrapper -->
	</div><!-- /.sidebar -->

	<div class="main">
		<?php get_template_part( 'loop' ); ?>
		<?php get_sidebar(); ?>
	</div><!-- /.main -->
</div><!-- /.scroller -->

<?php get_footer(); ?>
