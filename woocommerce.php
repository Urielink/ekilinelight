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

	<main id="primary" class="<?php ekiline_sort_cols( 'main' ); ?>">

	<?php dynamic_sidebar( 'content-w1' ); ?>

	<?php woocommerce_content(); ?>

	<?php dynamic_sidebar( 'content-w2' ); ?>

	</main><!-- #primary/viewcolumns -->

	<?php get_sidebar(); ?>

<?php ekiline_main_columns( 'close' ); ?>

<?php get_footer(); ?>
