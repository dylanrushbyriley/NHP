<?php
/**
 * Footer functions
 *
 * @package Ignis
 */

/**
 * Footer menu
 */
function ignis_footer_social_menu() {
	if ( has_nav_menu( 'social' ) ) : ?>
		<nav class="social-navigation clearfix">
			<?php wp_nav_menu( array( 'theme_location' => 'social', 'link_before' => '<span class="screen-reader-text">', 'link_after' => '</span>', 'container_class' => 'container', 'menu_class' => 'menu clearfix', 'fallback_cb' => false ) ); ?>
		</nav>
	<?php endif;
}
add_action('ignis_footer', 'ignis_footer_social_menu', 8);

/**
 * Footer credits
 */
function ignis_footer_credits() {
	?>
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'ignis' ) ); ?>" rel="nofollow"><?php printf( esc_html__( 'Proudly powered by %s', 'ignis' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %2$s by %1$s.', 'ignis' ), 'aThemes', '<a href="https://athemes.com/theme/ignis" rel="nofollow">Ignis</a>' ); ?>
		</div><!-- .site-info -->
	<?php
}
add_action('ignis_footer', 'ignis_footer_credits', 9);