<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme_of_the_Crop_Base_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile;

			if ( is_post_type_archive( 'event' ) || is_tax( 'event-category' ) || is_tax( 'event-tag' ) ) {
				totcbase_eo_the_posts_navigation();
			} else {
				totcbase_the_posts_navigation();
			}

		else :
			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
