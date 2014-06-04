$(document).ready(function() {

	$('body').addClass('js'); // Browser has JS test

// Search
// =====================================================
	$('.icon-search').click(function(e) {
		e.preventDefault();
		$('.icon-menu').removeClass('is-active');
		$('.menu').removeClass('is-open');
		$(this).toggleClass('is-active');
		$('.searchform').toggleClass('is-open');
		$('.searchform input[type="text"]').focus().val('');
	});

// Menu
// =====================================================

	$('.icon-menu').click(function(e) {
		e.preventDefault();
		$('.icon-search').removeClass('is-active');
		$('.searchform').removeClass('is-open');
		$(this).toggleClass('is-active');
		$('.menu').toggleClass('is-open');
	});
	
// Infinite Scroll
// =====================================================
	$('.main').append('<div class="spinner">Loading&hellip;</div>')
	
	loadPostAndCount();

	// Load Next Article
	function loadPostAndCount() {
		if ( !$('body').hasClass('page') ) {
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
		if ( !$('body').hasClass('page') ) {
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
			$('.searchform').removeClass('is-open');
			$('.tool-menu a').removeClass('is-active');
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

