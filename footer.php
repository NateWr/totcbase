<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme_of_the_Crop_Base_Theme
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-footer-container">
			<div class="identity">

				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php echo get_bloginfo( 'name', 'display' ); ?>
					</a>
				<?php endif; ?>

				<?php if ( get_bloginfo( 'description' ) ) : ?>
					<span class="site-tagline">
						<?php echo get_bloginfo( 'description', 'display' ); ?>
					</span>
				<?php endif; ?>

				<?php get_template_part( 'template-parts/menu', 'social' ); ?>

				<?php if ( get_theme_mod( 'copyright' ) ) : ?>
					<div class="copyright">
						<?php echo esc_html( get_theme_mod( 'copyright' ) ); ?>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
