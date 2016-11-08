<?php
/**
 * Logo or title text template file
 *
 * @brief Includes the logo or, if no logo exists, the title of this site.
 *
 * @package Theme_of_the_Crop_Base_Theme
 */
$brand_element = is_front_page() ? 'h1' : 'div';
?>

<<?php echo $brand_element; ?> class="brand">
	<a class="home-link" href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
		<?php if ( !get_theme_mod( 'site_logo' ) ) : ?>
			<?php echo get_bloginfo( 'name', 'display' ); ?>
		<?php else : ?>
			<?php totcbase_print_logo(); ?>
		<?php endif; ?>
	</a>
</<?php echo $brand_element; ?>>
