<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme_of_the_Crop_Base_Theme
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php totcbase_posted_by(); ?>
				<?php totcbase_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php the_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
			if ( is_singular() ) {
				the_content();
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'totcbase' ),
					'after'  => '</div>',
				) );
			} else {
				the_excerpt();
				?>

				<a href="<?php echo esc_url( get_permalink() ); ?>" class="more">
					<?php
					    // Translators: 1 and 3 are an opening and closing <span> tag. 2 is the post title.
					    printf( esc_html__( 'Read More%1$s about %2$s%3$s', 'totcbase' ), '<span class="screen-reader-text">', get_the_title(), '</span>' );
					?>
				</a>

				<?php
			}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php totcbase_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
