<?php
/**
 * Plantilla compatible de Woocommerce.
 * Woocommerce compatibility page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 * @link https://docs.woocommerce.com/document/woocommerce-theme-developer-handbook/
 *
 * @package ekiline
 */

get_header();
?>

<?php ekiline_main_columns( 'open' ); ?>

	<?php
	/**
	 * Hacer coincidir el scroll infinito con jetpack.
	 * Necesary for jetpack infinite scroll.
	 */
	$wrapper = 'primary';
	if ( is_shop() ){
		$wrapper = ( get_theme_mod( 'ekiline_Columns' ) > '0' ) ? 'viewcolumns' : 'primary';
	}
	?>

	<main id="<?php esc_attr_e( $wrapper ); ?>" class="<?php ekiline_sort_cols( 'main' ); ?>">

	<?php dynamic_sidebar( 'content-w1' ); ?>

	<?php woocommerce_content(); ?>

	<?php dynamic_sidebar( 'content-w2' ); ?>

	</main><!-- #primary/viewcolumns -->

	<?php get_sidebar(); ?>

<?php ekiline_main_columns( 'close' ); ?>

<?php get_footer(); ?>
