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
 * 1) Container open tag.
 * Hacer coincidir el scroll infinito con jetpack.
 * Necesary for jetpack infinite scroll.
 */
function ekiline_contanier_open() {
	ekiline_show_columns( 'open' );
}
add_action( 'woocommerce_before_shop_loop', 'ekiline_contanier_open', 100 );

/**
 * 2) Container close tag.
 */
function ekiline_contanier_close() {
	ekiline_show_columns( 'close' );
}
add_action( 'woocommerce_after_shop_loop', 'ekiline_contanier_close', 100 );


/**
 * Si se ocupa el formato de tarjetas en customizer agregar un contenedor al item.
 * If use card layout from customizer.
 * Open div.
 */
function ekiline_card_item_open() {
	$class = ( is_product() ) ? 'card ' : '';
	if ( '4' === get_theme_mod( 'ekiline_Columns' ) ) {
		echo '<div class="' . esc_attr( $class ) . 'card-body text-center">';
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


/**
 * Adiciones en Woocommerce.
 * Organizacion A1: Crear opcion de orden aleatorio a la presentacion de los productos.
 *
 * @link https://docs.woocommerce.com/document/custom-sorting-options-ascdesc/
 *
 * @param array $args parametros de opcion.
 */
function ekiline_wc_get_catalog_ordering_args( $args ) {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$orderby_value = isset( $_GET['orderby'] ) ? sanitize_text_field( wp_unslash( $_GET['orderby'] ) ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
	if ( 'random_list' === $orderby_value ) {
		$args['orderby']  = 'rand';
		$args['order']    = '';
		$args['meta_key'] = '';
	}
	return $args;
}
add_filter( 'woocommerce_get_catalog_ordering_args', 'ekiline_wc_get_catalog_ordering_args' );

/**
 * Organizacion A2: Agregar opcion en herramintas de selección (customizer).
 * Si se desea la opcion para que el usuario lo establezca ocupar:
 * add_filter( 'woocommerce_catalog_orderby', 'ekiline_wc_catalog_orderby' );
 *
 * @link https://docs.woocommerce.com/document/custom-sorting-options-ascdesc/
 *
 * @param array $sortby regresa un campo de opcion en el control de customizer.
 */
function ekiline_wc_catalog_orderby( $sortby ) {
	$sortby['random_list'] = 'Random';
	return $sortby;
}
add_filter( 'woocommerce_default_catalog_orderby_options', 'ekiline_wc_catalog_orderby' );

/**
 * Sobreescribir objetos, se agrega una acción con una función.
 * https://businessbloomer.com/woocommerce-visual-hook-guide-single-product-page/
 */
function ekiline_wc_add_category_shop_items() {
	global $post;
	$terms   = get_the_terms( $post->ID, 'product_cat' );
	$getcats = '';
	// Obtener categorias a las que el producto pertenece.
	if ( $terms && ! is_wp_error( $terms ) ) {
		$cat_links = array();
		foreach ( $terms as $term ) {
			$cat_links[] = '<small><a href="' . get_site_url() . '/?product_cat=' . $term->slug . '" title="' . $term->name . '">' . $term->name . '</a></small>';
		}
		$getcats = join( ',', $cat_links );
	}
	$allowed_html = array(
		'a'     => array(
			'href'  => array(),
			'title' => array(),
		),
		'small' => array(),
	);
	echo wp_kses( $getcats, $allowed_html );
}
add_action( 'woocommerce_before_shop_loop_item_title', 'ekiline_wc_add_category_shop_items', 20 );
