/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	//Header text
	wp.customize( 'header_title', function( value ) {
		value.bind( function( to ) {
			$( '.header-text h2' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	//Font sizes
	wp.customize( 'site_title_size', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).css('font-size', to + 'px');
		} );
	} );
	wp.customize( 'site_desc_size', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).css('font-size', to + 'px');
		} );
	} );
	wp.customize( 'hero_text_size', function( value ) {
		value.bind( function( to ) {
			$( '.home .header-text h2' ).css('font-size', to + 'px');
		} );
	} );
	wp.customize( 'menu_items', function( value ) {
		value.bind( function( to ) {
			$( '.main-navigation li' ).css('font-size', to + 'px');
		} );
	} );
	wp.customize( 'body_size', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css('font-size', to + 'px');
		} );
	} );
	wp.customize( 'index_post_title', function( value ) {
		value.bind( function( to ) {
			$( '.entry-header .entry-title' ).css('font-size', to + 'px');
		} );
	} );
	wp.customize( 'single_post_title', function( value ) {
		value.bind( function( to ) {
			$( '.header-text h1, .header-text h2, .header-text .entry-title' ).css('font-size', to + 'px');
		} );
	} );
	wp.customize( 'sidebar_widgets_title', function( value ) {
		value.bind( function( to ) {
			$( '.widget-title' ).css('font-size', to + 'px');
		} );
	} );

	//Colors

	wp.customize( 'site_title_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).css('color', to );
		} );
	} );
	wp.customize( 'site_desc_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).css('color', to );
		} );
	} );
	wp.customize( 'body_text_color', function( value ) {
		value.bind( function( to ) {
			$( 'body, .widget-area .widget, .widget-area .widget a, .site-footer, .site-footer a' ).css('color', to );
		} );
	} );
	wp.customize( 'home_hero_color', function( value ) {
		value.bind( function( to ) {
			$( '.home .header-text h2' ).css('color', to );
		} );
	} );
	wp.customize( 'home_hero_subtext_color', function( value ) {
		value.bind( function( to ) {
			$( '.header-text p' ).css('color', to );
		} );
	} );
	wp.customize( 'banner_titles_color', function( value ) {
		value.bind( function( to ) {
			$( 'body:not(.home) .header-text h1,body:not(.home) .header-text h2,body:not(.home) .header-text .entry-title' ).css('color', to );
		} );
	} );
	wp.customize( 'menu_items_color', function( value ) {
		value.bind( function( to ) {
			$( '.main-navigation a' ).css('color', to );
		} );
	} );
	wp.customize( 'mobile_btn_color', function( value ) {
		value.bind( function( to ) {
			$( '.btn-menu' ).css('color', to );
		} );
	} );
	wp.customize( 'mobile_menu_bg', function( value ) {
		value.bind( function( to ) {
			$( '#mainnav-mobi' ).css('background-color', to );
		} );
	} );
	wp.customize( 'mobile_menu_items', function( value ) {
		value.bind( function( to ) {
			$( '#mainnav-mobi a' ).css('color', to );
		} );
	} );

} )( jQuery );
