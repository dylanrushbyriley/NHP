<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ignis
 */

$hide_meta = get_theme_mod( 'hide_meta_index' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if ( '' != get_the_post_thumbnail() ) : ?>
	<div class="post-thumbnail">
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( '720x0' ); ?></a>
	</div>
	<?php endif; ?>

	<div class="post-content">
		<header class="entry-header">
			<?php 
			if ( $hide_meta != 1 ) { 
				ignis_show_cats();
			} ?>
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<?php if ( 'post' === get_post_type() && $hide_meta != 1) : ?>
			<div class="entry-meta">
				<?php ignis_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>			
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->
		<footer class="entry-footer">
			<a class="post-read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo esc_html( get_theme_mod( 'read_more_text', __( 'Continue reading', 'ignis' ) ) ); ?></a>
		</footer>
	</div>
</article><!-- #post-## -->
