<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme_of_the_Crop_Base_Theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'totcbase' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<div class="site-branding">
			<<?php echo is_front_page() ? 'h1' : 'div'; ?> class="brand">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<?php echo get_bloginfo( 'name', 'display' ); ?>
				<?php endif; ?>
			</<?php echo is_front_page() ? 'h1' : 'div'; ?>>
			<?php if ( get_bloginfo( 'description' ) ) : ?>
				<span class="site-tagline">
					<?php echo get_bloginfo( 'description', 'display' ); ?>
				</span>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php get_template_part( 'template-parts/menu-primary' ); ?>
			</nav><!-- #site-navigation -->
		<?php endif; ?>

		<?php get_template_part( 'template-parts/menu', 'social' ); ?>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
