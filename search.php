<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Theme_of_the_Crop_Base_Theme
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="entry-header">
				<h1 class="entry-title">
					<?php printf( esc_html__( 'Search Results for: %s', 'totcbase' ), '<span>' . get_search_query() . '</span>' ); ?>
				</h1>
			</header><!-- .entry-header -->

			<?php
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', 'search' );
			endwhile;

			totcbase_the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
