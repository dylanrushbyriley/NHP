<?php
/**
 * Header functions
 *
 * @package Ignis
 */


/**
 * Body classes
 */
function ignis_sticky_header($classes) {

	$sticky = get_theme_mod('sticky_menu', 'sticky-header');

	$classes[] = esc_attr( $sticky );

	return $classes;
}
add_filter( 'body_class', 'ignis_sticky_header' );

/**
 * Site title, logo and menu bar
 */
function ignis_header_bar() {
?>
	<header id="masthead" class="site-header clearfix" role="banner">
			<div class="site-branding col-md-4 col-sm-6 col-xs-12">
				<?php

				if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
					the_custom_logo();
				}
				?>
				<div class="branding-inner">
				<?php
				if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php
				endif; ?>
				</div>
			</div><!-- .site-branding -->
			<div class="btn-menu col-md-8 col-sm-6 col-xs-12"><i class="icon-menu"></i></div>
			<nav id="site-navigation" class="main-navigation col-md-8" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
				<div class="btn-close-menu">&times;</div>
			</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
<?php
}
add_action( 'ignis_header', 'ignis_header_bar', 9);	

/**
 * Header text typer
 */
function ignis_typed_strings() {
		$typed_strings 	= get_theme_mod( 'typed_strings', '^developer' . "\n" . '^entrepreneur' );
		$typed_strings 	= preg_replace( "/\^+(.*)?/i", "<div class='typed-strings'><p>$1</p></div>", $typed_strings );
		$typed_strings 	= preg_replace( "/(\<\/div\>\n(.*)\<div class='typed-strings'\>*)+/", "", $typed_strings );

		return $typed_strings;
}

/**
 * Check if header media is active
 */
function ignis_media_check() {
	if ( is_front_page() && has_custom_header() ) {
		return 'has-media';
	}
}

/**
 * Header text
 */
function ignis_header_hero() {
	$header_title 		= get_theme_mod( 'header_title', __( 'My name is Joe<span class="color-primary">.</span><br> I\'m a ', 'ignis') );
	$header_animated 	= ignis_typed_strings();
	$header_subtitle	= get_theme_mod( 'header_subtitle', __( 'Scroll down to begin your adventure', 'ignis') );
	$header_media		= ignis_media_check();
	?>

	<div class="ignis-hero-area <?php echo $header_media; ?>">
		<?php 
		if ( $header_media == 'has-media' ) {
			the_custom_header_markup();
		}
		?>
		<div class="header-text clearfix">
		<?php if ( is_front_page() ) : ?>
			<h2><?php echo wp_kses_post( $header_title ); ?> <span class="typed-element"><?php echo wp_kses_post( $header_animated ); ?></span></h2>
			<p><?php echo wp_kses_post( $header_subtitle ); ?></p>
		<?php elseif ( is_single() ) : ?>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php elseif ( class_exists( 'Woocommerce') && is_woocommerce() ) : ?>
			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
		<?php elseif ( is_archive() ) : ?>
			<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
		<?php elseif ( is_search() ) : ?>
			<h1 class="entry-title"><?php printf( esc_html__( 'Search Results for: %s', 'ignis' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		<?php elseif ( is_404() ) : ?>	
			<h1 class="entry-title"><?php echo esc_html__( '404', 'ignis' ); ?></h1>
		<?php else : ?>
			<h1 class="entry-title"><?php single_post_title(); ?></h1>
		<?php endif; ?>
		</div>
	</div>
	<?php
}
add_action( 'ignis_after_header', 'ignis_header_hero', 9);