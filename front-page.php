<?php
/**
 * The template for displaying the front page
 *
 * It will show the selected front page or the blog index if no static front
 * page is selected.
 *
 * @package Theme_of_the_Crop_Base_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				if ( is_home() ) : ?>

					<header>
						<h1 class="page-title">
							<?php single_post_title(); ?>
						</h1>
					</header>

					<?php

					get_template_part( 'template-parts/content', get_post_type() );

					augustan_the_posts_navigation();

				elseif ( function_exists( 'totclcInit' ) ) :

					totcbase_totclc_the_content();

				else :

					the_content();

				endif;
			endwhile;
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
if ( is_home() ) {
	get_sidebar();
}
get_footer();
