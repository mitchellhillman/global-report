<?php if (!is_single() || !is_page()): ?>
	<script type="text/javascript">
		var count = 2,
			total = <?php echo $wp_query->max_num_pages; ?>;
		$(window).scroll(function(){
			if  ($(window).scrollTop() == $(document).height() - $(window).height()){
				console.log('you made it to the bottom!!');
				if ( count < total ) {
					loadArticle(count);	
				}
				count++;
			}
		});

		function loadArticle(pageNumber) {
			$('.content').append('<div class="spinner"><strong>Loading ... </strong></div>')
			$.ajax({
					url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
					type:'POST',
					data: "action=infinite_scroll&page_no="+ pageNumber + '&loop_file=loop', 
					success: function(html){
						$('.spinner').destroy();
						$(".content").append(html);
					}
			});
			return false;
		}
	</script>
<?php endif; ?>