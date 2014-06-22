		</div><!-- /.content -->

		<!-- jQuery -->
		<script src="<?php bloginfo('template_url'); ?>/js/jquery.js" type="text/javascript"></script>
		
		<script type="text/javascript">
			
		// AJAX Functions
		// ================
		// Ajax functions are written inline to take advantage of 
		// PHP functions to provide contextual data

			var	pageNumber = 1;
			var pageId = $('.main-entry:first').attr('data-id');
			
			// Get next Main Article
			function loadPost() {
				$('.main-spinner').show();

				// Start building the data passed to the ajax function
				var dataArray = {
					'action': 'infinite_scroll',
					'page_id': pageId
				};

				// Add some details

				// Search Query
				<?php if (is_search()): ?>
					// pageNumber++; // overwrite page start to compensate not being able to pass page id
					var searchQuery = "<?php echo get_search_query(); ?>";
					dataArray['search_query'] = searchQuery;
				// Page and Date
				<?php else: ?>
					var pageDate = <?php echo get_post_time('"c"', true, get_the_ID()); ?>;
					dataArray['page_date'] = pageDate;
				<?php endif; ?>
				// Category
				<?php if ( get_query_var('cat') != null ) : ?>
					var catId = <?php echo get_query_var('cat'); ?>;
					dataArray['cat_id'] = catId;
				<?php endif; ?>

				// Page number
				dataArray['page_no'] = pageNumber;

				// Make the call
				$.ajax({
						url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
						type:'POST',
						data: dataArray, 
						success: function(html){
							$('.main-spinner').hide();
							$(".main").append(html);
							if ($('.main').height() < $(window).height()) {
								loadPost(pageNumber);
								pageNumber++;
							}
						}
				});
			}

			// Get next Sidebar articles
			var	sidebarPageNumber = 2;
			function loadSidebar() {
				$('.sidebar-spinner').show();

				// Start building the data passed to the ajax function
				var dataArray = {
					'action': 'load_sidebar',
					'sidebar_no': sidebarPageNumber
				};

				// Make the call
				$.ajax({
						url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
						type:'POST',
						data: dataArray, 
						success: function(html){
							$('.sidebar-spinner').hide();
							$(".sidebar-list").append(html);
						}
				});
			}

		</script>
		<!-- Script -->
		<script src="<?php bloginfo('template_url'); ?>/js/script.js" type="text/javascript"></script>

		<?php wp_footer(); ?>
	</body>
</html>