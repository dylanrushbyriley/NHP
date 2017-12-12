<?php
/**
 * @package Ignis
 */


//Dynamic styles
function ignis_custom_styles($custom) {

	$custom = '';

	if ( is_page_template( 'post-templates/post_nosidebar_featured.php' ) ) {
		$featured_image = get_the_post_thumbnail_url();
	    $custom .= ".ignis-hero-area { background-image: url(" . esc_url( $featured_image ) . "); }"."\n";
	}

	//Typography
	$body_fonts 	= get_theme_mod('body_font_family', 'Nunito');
	$headings_fonts = get_theme_mod('headings_font_family', 'Poppins');
	$body_fonts  	= str_replace('+', ' ', $body_fonts);
	$headings_fonts  = str_replace('+', ' ', $headings_fonts);	
	$custom 		.= "body {font-family:" . wp_kses_post($body_fonts) . "}"."\n";
	$custom 		.= "h1, h2, h3, h4, h5, h6, .site-title {font-family:" . wp_kses_post($headings_fonts) . "}"."\n";	

    $site_title_size 		= get_theme_mod( 'site_title_size', '36' );
    $site_desc_size 		= get_theme_mod( 'site_desc_size', '18' );
    $menu_items 			= get_theme_mod( 'menu_items', '13' );
    $body_size 				= get_theme_mod( 'body_size', '18' );
    $hero_size 				= get_theme_mod( 'hero_text_size', '94' );
    $index_post_title 		= get_theme_mod( 'index_post_title', '22' );
    $single_post_title 		= get_theme_mod( 'single_post_title', '56' );
    $sidebar_widgets_title 	= get_theme_mod( 'sidebar_widgets_title', '18' );	

    $custom .= ".site-title { font-size:" . intval( $site_title_size ) . "px; }"."\n";
    $custom .= ".site-description { font-size:" . intval( $site_desc_size ) . "px; }"."\n";
    $custom .= "body { font-size:" . intval( $body_size ) . "px; }"."\n";
    $custom .= ".main-navigation li { font-size:" . intval( $menu_items ) . "px; }"."\n";
    $custom .= ".entry-header .entry-title { font-size:" . intval( $index_post_title ) . "px; }"."\n";
    $custom .= ".header-text h1, .header-text h2, .header-text .entry-title { font-size:" . intval( $single_post_title ) . "px; }"."\n";
    $custom .= ".widget-area .widget-title { font-size:" . intval( $sidebar_widgets_title ) . "px; }"."\n";    
    $custom .= ".home .header-text h2 { font-size:" . intval( $hero_size ) . "px; }"."\n";

	$custom .= "@media only screen and (max-width: 1199px) {
					.home .header-text h2 { font-size: 56px;}
				}"."\n";
	$custom .= "@media only screen and (max-width: 1199px) {
					.home .header-text h2 { font-size: 36px;}
					.header-text h1, .header-text h2, .header-text .entry-title { font-size: 36px;}
				}"."\n";
	$custom .= "@media only screen and (max-width: 991px) {
					body { font-size: 16px;}
				}"."\n";
	$custom .= "@media only screen and (max-width: 767px) {
					.home .header-text h2 { font-size: 22px;}
					.header-text h1, .header-text h2, .header-text .entry-title { font-size: 22px;}
					.site-title { font-size: 26px;}
				}"."\n";								
	$custom .= "@media only screen and (max-width: 400px) {
					.entry-header .entry-title { font-size: 18px;}
				}"."\n";

	//Post nav thumbs
    if ( is_single() ) {
	    $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	    $next     = get_adjacent_post( false, '', false );

	    if ( is_attachment() && 'attachment' == $previous->post_type ) {
	        return;
	    }

	    if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
	        $prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
	        $custom .= '
	            .post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
	        ';
	    }

	    if ( $next && has_post_thumbnail( $next->ID ) ) {
	        $nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
	        $custom .= '
	            .post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); }
	        ';
	    }
	}

	//Colors
	$primary_color = get_theme_mod( 'primary_color', '#ff6b7e' );
	$custom .= ".woocommerce a.remove,.main-navigation a:hover,a,a:hover,.color-primary { color:" . esc_attr($primary_color) . "}"."\n";
	$custom .= ".woocommerce input.button.alt,.woocommerce input.button.alt:hover,.woocommerce span.onsale,.portfolio-thumbnail::after,.social-navigation a:hover,.post-template-post_nosidebar_featured .ignis-hero-area::after,.jetpack-portfolio-template-post_nosidebar_featured .ignis-hero-area::after,.main-navigation .menu-icon a:hover,.woocommerce div.product form.cart .button,.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,.button,button,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"],.woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,.woocommerce div.product form.cart .button:hover,.button:hover,button:hover,input[type=\"button\"]:hover,input[type=\"reset\"]:hover,input[type=\"submit\"]:hover { background-color:" . esc_attr($primary_color) . "}"."\n";
	$secondary_color = get_theme_mod( 'secondary_color', '#37c9df' );
	$custom .= ".typed-cursor,.typed-element,.portfolio-entry-meta a:hover,.cat-links a:hover,.woocommerce-message::before { color:" . esc_attr($secondary_color) . "}"."\n";
	$custom .= ".woocommerce-message,.portfolio-entry-meta a:hover,.cat-links a:hover,.portfolio-entry-meta a,.cat-links a { border-color:" . esc_attr($secondary_color) . "}"."\n";
	$custom .= ".portfolio-entry-meta a,.cat-links a { background-color:" . esc_attr($secondary_color) . "}"."\n";
	$body_text = get_theme_mod( 'body_text_color', '#4a4a4a' );
	$custom .= "body, .widget-area .widget, .widget-area .widget a, .site-footer, .site-footer a { color:" . esc_attr($body_text) . "}"."\n";

	$site_title = get_theme_mod( 'site_title_color', '#000000' );
	$custom .= ".site-title a,.site-title a:hover { color:" . esc_attr($site_title) . "}"."\n";
	$site_desc = get_theme_mod( 'site_desc_color', '#b2b5bb' );
	$custom .= ".site-description { color:" . esc_attr($site_desc) . "}"."\n";

	$home_hero_text = get_theme_mod( 'home_hero_color', '#ffffff' );
	$custom .= ".home .header-text h2 { color:" . esc_attr($home_hero_text) . "}"."\n";
	$home_hero_subtext = get_theme_mod( 'home_hero_subtext_color', '#686d73' );
	$custom .= ".header-text p { color:" . esc_attr($home_hero_subtext) . "}"."\n";
	$banner_titles = get_theme_mod( 'banner_titles_color', '#000000' );
	$custom .= ".header-text h1, .header-text h2, .header-text .entry-title { color:" . esc_attr($banner_titles) . "}"."\n";

	$menu_items_color = get_theme_mod( 'menu_items_color', '#4a4a4a' );
	$custom .= ".main-navigation a { color:" . esc_attr($menu_items_color) . "}"."\n";
	$mobile_btn_color = get_theme_mod( 'mobile_btn_color', '#000000' );
	$custom .= ".btn-menu { color:" . esc_attr($mobile_btn_color) . "}"."\n";
	$mobile_menu_bg = get_theme_mod( 'mobile_menu_bg', '#202529' );
	$custom .= "#mainnav-mobi { background-color:" . esc_attr($mobile_menu_bg) . "}"."\n";
	$mobile_menu_items = get_theme_mod( 'mobile_menu_items', '#ffffff' );
	$custom .= "#mainnav-mobi a { color:" . esc_attr($mobile_menu_items) . "}"."\n";

	//Output all the styles
	wp_add_inline_style( 'ignis-style', $custom );	
}
add_action( 'wp_enqueue_scripts', 'ignis_custom_styles' );