<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme_of_the_Crop_Base_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( is_home() ) : ?>
			<header>
				<h1 class="page-title">
					<?php single_post_title(); ?>
				</h1>
			</header>
		<?php endif;

		if ( have_posts() ) :

			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile;

			totcbase_the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
