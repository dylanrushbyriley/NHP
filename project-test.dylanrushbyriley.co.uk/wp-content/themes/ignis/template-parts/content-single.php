<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ignis
 */

$hide_meta = get_theme_mod( 'hide_featured_singles' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( !is_page_template( 'post-templates/post_nosidebar_featured.php' ) ) : ?>
		<?php if ( ( '' != get_the_post_thumbnail() ) && ( $hide_meta != 1 ) ) : ?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail( '820x0' ); ?>
		</div>
		<?php endif; ?>
	<?php endif; ?>

	<header class="entry-header">
		<?php
		if ( 'post' === get_post_type() && get_theme_mod( 'hide_meta_singles' ) != 1) : ?>
		<div class="entry-meta">
			<?php ignis_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->	

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'ignis' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ignis' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( $hide_meta != 1 ) : ?>
	<footer class="entry-footer">
		<?php ignis_show_cats(); ?>
		<?php ignis_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
