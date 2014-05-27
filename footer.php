		</div><!-- /.content -->

		<!-- jQuery -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		
		<?php 
		// Infinite Scroll
		// ================
		// Script is written inline for PHP values that need to come
		// from the database. All other scripts relating to this feature
		// are located in scripts.js
		if (!is_page()): ?>
			<script type="text/javascript">
				$('.main').append('<div class="spinner">Loading&hellip;</div>')
				var	pageNumber = 1;

				function loadArticle(pageNumber) {
					$('.spinner').show();

					var dataArray = {
						'action': 'infinite_scroll',
					};

					// Search Query
					<?php if (is_search()): ?>
						pageNumber = pageNumber + 1; // overwrite page start to compensate not being able to pass page id
						var searchQuery = "<?php echo get_search_query(); ?>";
						dataArray['search_query'] = searchQuery;
					// Page and Date
					<?php else: ?>
						var pageId 		= <?php echo get_the_ID(); ?>;
						var pageDate 	= <?php echo get_post_time('"M d, Y"', true, get_the_ID()); ?>;
						dataArray['page_id'] = pageId;
						dataArray['page_date'] = pageDate;
					<?php endif; ?>
					// Category
					<?php if ( get_query_var('cat') != null ) : ?>
						var catId = <?php echo get_query_var('cat'); ?>;
						dataArray['cat_id'] = catId;
					<?php endif; ?>

					dataArray['page_no'] = pageNumber;

					$.ajax({
							url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
							type:'POST',
							data: dataArray, 
							success: function(html){
								$('.spinner').hide();
								$(".main").append(html);
							}
					});

					return false;
				}

				function changeUrl() {
					$('.main-entry').each(function() {
						if ( $(this).offset().top < $(window).scrollTop() + 100 ) { // this is x pixels from the top
							// Visual reality check
							$('.main-entry').css('background', 'white');
							$(this).css('background', 'pink');

							// The History API trickery
							var newUrlPageId = $(this).attr('data-id');
							var dataArray = {
								'action': 'get_permalink',
								'new_url_page_id': newUrlPageId
							};
							console.log('newUrlPageId ' + newUrlPageId);
							$.ajax({
								url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
								type: 'POST',
								data: dataArray,
								success: function(permalink) {
									// console.log('ajax return value: ' + permalink);
									window.history.pushState(null, null, permalink);
								}
							});
						}  
					});
				}

				$(window).scroll(function() { 
					changeUrl();
				});
			</script>
		<?php endif; ?>
		<!-- Script -->
		<script src="<?php bloginfo('template_url'); ?>/js/script.js" type="text/javascript"></script>

		<?php wp_footer(); ?>
	</body>
</html>