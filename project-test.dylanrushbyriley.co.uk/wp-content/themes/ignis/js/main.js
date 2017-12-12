/* Isotope */
(function($) {
	var $grid = $('.portfolio-wrapper, .content-area.masonry .posts-loop, .content-area.masonry-fullwidth .posts-loop').isotope({
		layoutMode: 'masonry',
		itemSelector: '.hentry',
		cellsByRow: {
  			columnWidth: '.hentry',
		}
	});
	$grid.imagesLoaded().progress( function() {
		$grid.isotope('layout');
	});
})( jQuery );

/* Wow */
(function($) {
	var wow = new WOW( {
		    mobile:       true,
		    callback:     function(box) {
		    	$(box).addClass('project-visible');
		    },
		}
	);
wow.init();
})( jQuery );

/* Typed */
(function($) {
	    $('.typed-element').typed({
	        typeSpeed: 75,
	        loop: true,
	        backDelay: 2000,
	        stringsElement: $('.typed-strings')
	    });
})( jQuery );

/* Header search */
(function($) {
	    $('.header-search a').on('click', function(event) {
	    	event.preventDefault();
	    	$('.header-search-form').slideToggle();
	    });
})( jQuery );

/* Sticky menu */
(function($) {

	function stickyHeader() {
		if ( matchMedia( 'only screen and (min-width: 1024px)' ).matches ) {
			$('.sticky-header .site-header').sticky({
				topSpacing:0,
				responsiveWidth: true
			});

			var headerHeight = $('.site-header').outerHeight();
			$('#masthead-sticky-wrapper').css('min-height', headerHeight);
		} else {
			$('.sticky-header .site-header').unstick();
		}
	}
	$(document).ready( stickyHeader );
	$(window).on('resize', stickyHeader );

})( jQuery );

/* Social links in new window */
(function($) {
     $('.social-navigation li a').attr( 'target','_blank' );
})( jQuery );

/* Mobile menu */
(function($) {
		var	menuType = 'desktop';

		$(window).on('load resize', function() {
			var currMenuType = 'desktop';

			if ( matchMedia( 'only screen and (max-width: 1199px)' ).matches ) {
				currMenuType = 'mobile';
			}

			if ( currMenuType !== menuType ) {
				menuType = currMenuType;

				if ( currMenuType === 'mobile' ) {
					var $mobileMenu = $('#site-navigation').attr('id', 'mainnav-mobi').hide();
					var hasChildMenu = $('#mainnav-mobi').find('li:has(ul)');

					hasChildMenu.children('ul').hide();
					hasChildMenu.children('a').after('<span class="btn-submenu"></span>');
					$('.btn-menu .icon-menu').removeClass('active');
				} else {
					var $desktopMenu = $('#mainnav-mobi').attr('id', 'site-navigation').removeAttr('style');

					$desktopMenu.find('.submenu').removeAttr('style');
					$('.btn-submenu').remove();
				}
			}
		});

		$('.btn-menu .icon-menu, .btn-close-menu').on('click', function() {
			$('#mainnav-mobi').slideToggle(300);
			$(this).toggleClass('active');
		});

		$(document).on('click', '#mainnav-mobi li .btn-submenu', function(e) {
			$(this).toggleClass('active').next('ul').slideToggle(300);
			e.stopImmediatePropagation()
		});	
})( jQuery );


//Fitvids
jQuery(function($) {
	$(window).on('ready load', function () {
		$('body').fitVids();
	});
});