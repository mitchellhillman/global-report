$(document).ready(function() {

	$('body').addClass('js'); // Browser has JS test

// Drawer Toggles
// =====================================================
	
	$('.drawer-toggles a').click(function() {
		var $this = $(this),
			$toggles = $('.drawer-toggles a'),
			$drawers = $('.drawer'),
			$target = $('.' + $this.attr('data-target'));

		// Toggle the drawers
		if ($this.hasClass('is-active')) {
			$toggles.removeClass('is-active');
			$drawers.removeClass('is-open');
		} else {
			$toggles.removeClass('is-active');
			$drawers.removeClass('is-open');
			$this.addClass('is-active');
			$target.addClass('is-open');
		}

		// Clear search value
		$('.searchform input[type="text"]').val('');

		// Focus the search area
		if ($this.hasClass('search')) {
			$('.searchform input[type="text"]').focus().val('');
		} 
	});

// Infinite Scroll
// =====================================================

	// Load Next Article
	// Shitty hack to fix the too short article issue
	if ( $('.main').height() < $(window).height() ) {
		loadArticle(pageNumber);
		pageNumber++;
	}
	if( $(window).scrollTop() + $(window).height() > $(document).height() - 100) {
		loadArticle(pageNumber);
		pageNumber++;
	}
	$(window).scroll(function() { 
	 	if( $(window).scrollTop() + $(window).height() > $(document).height() - 100) {
			loadArticle(pageNumber);
			pageNumber++;
		}
	});

// Kayboard Controls
// =====================================================
	$('body').keyup(function(e){
		// ESC : Close Menus
		if (e.keyCode == 27) {
			e.preventDefault();
			$('.drawer').removeClass('is-open');
			$('.drawer-toggles a').removeClass('is-active');
		}
		// Arrown Down : Load Article
		if (e.keyCode == 40) {
			e.preventDefault();
			$(window).load(function() {
				$("html, body").animate({ scrollTop: $(document).height() }, 1000);
			});
			loadArticle(pageNumber);
			pageNumber++;
		}
	});

});

