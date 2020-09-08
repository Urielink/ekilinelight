<?php
/**
 * Woocommerce Setup
 *
 * @link https://docs.woocommerce.com/document/woocommerce-theme-developer-handbook/
 *
 * References: Woocommerce markup hooks. ekiline column container
 * read: https://docs.woocommerce.com/document/introduction-to-hooks-actions-and-filters/
 * read: https://woocommerce.github.io/code-reference/hooks/hooks.html
 * read: https://www.businessbloomer.com/woocommerce-visual-hook-guide-archiveshopcat-page/
 *
 * @package ekiline
 */

/**
 * Habilitar opciones de compatibilidad woocommerce.
 */
function ekiline_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'ekiline_add_woocommerce_support' );

/**
 * Si se ocupa el formato de tarjetas en customizer agregar un contenedor al item.
 * If use card layout from customizer.
 * Open div.
 */
function ekiline_card_item_open() {
	$class = ( is_product() ) ? 'card ' : '' ;
	if ( '4' === get_theme_mod( 'ekiline_Columns' ) ) {
		echo '<div class="'. $class .'card-body text-center">';
	}
}
add_action( 'woocommerce_before_shop_loop_item', 'ekiline_card_item_open', 0 );

/**
 * Shop page, item.
 * Close div.
 */
function ekiline_card_item_close() {
	if ( '4' === get_theme_mod( 'ekiline_Columns' ) ) {
		echo '</div><!--card-body-->';
	}
}
add_action( 'woocommerce_after_shop_loop_item', 'ekiline_card_item_close', 100 );
