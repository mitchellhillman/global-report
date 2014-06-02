$(document).ready(function() {

	$('body').addClass('js'); // Browser has JS test

// Drawer Toggles
// =====================================================
	
	$('.drawer-toggles a').click(function(e) {
		e.preventDefault();
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
	$('.main').append('<div class="spinner">Loading&hellip;</div>')
	
	loadPostAndCount();

	// Load Next Article
	function loadPostAndCount() {
		if (!$('body').hasClass('page') ) { // don't do this on pages
			var scrolledToBottom 		= $(window).scrollTop() + $(window).height() == $(document).height(),
				scrolledCloseToBottom	= $(window).scrollTop() + $(window).height() > $(document).height() - 100,
				pageTooShort			= $('.main').height() < $(window).height();

			if (scrolledCloseToBottom) {
				loadPost();
				pageNumber++;
			}
		}
	}

// Change URL
// =====================================================
	function changeUrl() {
		if (!$('body').hasClass('page') ) { // don't do this on pages  
			var newUrlPageId = $('.menu-entry:first').attr('data-id');
			$('.main-entry').each(function() {
				if ( $(this).offset().top < $(window).scrollTop() + 200 ) { 
					newUrlPageId = $(this).attr('data-id');
				}
			});
			pushState(newUrlPageId);
			highlightSidebar(newUrlPageId);
		}
	}

	function highlightSidebar(id) {
		$('.sidebar-entry').removeClass('active');
		$('.sidebar-entry#post-' + id).addClass('active'); // potentially a stupid feature. I may remove it. 
	}

// Scroll Event
// =====================================================
	$(window).scroll(function() {
		loadPostAndCount();
		changeUrl();
	});


// Keyboard Controls
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

