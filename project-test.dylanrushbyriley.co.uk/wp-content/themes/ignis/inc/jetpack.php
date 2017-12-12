<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Ignis
 */

/**
 * Jetpack setup function.
 */
function ignis_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'ignis_infinite_scroll_render',
		'footer'    => 'page',
	) );

	add_theme_support( 'jetpack-portfolio' );
}
add_action( 'after_setup_theme', 'ignis_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function ignis_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}
