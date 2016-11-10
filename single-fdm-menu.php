<?php
/**
 * The template for displaying single menus
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Theme_of_the_Crop_Base_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', get_post_type() );

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		endwhile;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
if ( !totcbase_menu_has_two_cols() ) {
	get_sidebar();
}
get_footer();
