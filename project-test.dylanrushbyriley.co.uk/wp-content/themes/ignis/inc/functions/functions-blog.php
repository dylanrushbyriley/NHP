<?php
/**
 * @package Talon
 */


/**
 * Excerpt length
 */
function ignis_excerpt_length( $length ) {
    if ( is_admin() ) {
        return $length;
    }

    $excerpt = get_theme_mod('exc_length', '20');
    return intval( $excerpt );
}
add_filter( 'excerpt_length', 'ignis_excerpt_length', 999 );

/**
 * Single posts
 */
function ignis_fullwidth_singles($classes) {

    $layout = ignis_blog_layout();

	$classes[] = 'clearfix';

	if ( is_page_template( 'page-templates/template_portfolio.php' ) || is_archive( 'jetpack-portfolio' ) ) {
		$classes[] = 'wow fadeInUp';
	}

    if ( ( 'post' === get_post_type() ) && ( is_home() || is_archive() || is_search() ) && ( $layout == 'masonry' || $layout == 'masonry-fullwidth' ) ) {
        $classes[] = 'col-md-6 col-sm-6';
    }

	return $classes;
}
add_filter( 'post_class', 'ignis_fullwidth_singles' );

/**
 * Blog layout
 */
function ignis_blog_layout() {
	$layout = get_theme_mod( 'blog_layout', 'masonry-fullwidth' );
	return $layout;
}

/**
 * Archive titles
 */
function ignis_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }
  
    return $title;
}
 
add_filter( 'get_the_archive_title', 'ignis_archive_title' );