<?php
/**
 * Woocommerce Setup
 *
 * @link https://docs.woocommerce.com/document/woocommerce-theme-developer-handbook/
 *
 * @package ekiline
 */

function ekiline_add_woocommerce_support() {

	$ekiline_woocommerce = array(
        'thumbnail_image_width' => 150,
        'single_image_width'    => 300,
        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 5,
        ),
    );
    // add_theme_support( 'woocommerce', $ekiline_woocommerce );

    add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

}

add_action( 'after_setup_theme', 'ekiline_add_woocommerce_support' );


/**
 * Woocommerce markup hooks.
 *
 * read: https://docs.woocommerce.com/document/introduction-to-hooks-actions-and-filters/
 * read: https://woocommerce.github.io/code-reference/hooks/hooks.html
 * read: https://www.businessbloomer.com/woocommerce-visual-hook-guide-archiveshopcat-page/
 */

// function ekiline_show_columns_open() {
// 	// dynamic_sidebar( 'content-w1' );
// 	// ekiline_show_columns( 'open' );
// }
// // add_action( 'woocommerce_before_shop_loop', 'ekiline_show_columns_open', 100 );

// function ekiline_show_columns_close() {
// 	ekiline_show_columns( 'open' );
// 	ekiline_show_columns( 'close' );
// 	// dynamic_sidebar( 'content-w2' );
// }
// // add_action( 'woocommerce_after_shop_loop', 'ekiline_show_columns_close', 100 );

/**
 * Shop page, loop container.
 * ref: https://github.com/woocommerce/woocommerce/issues/5197
 */
function woocommerce_product_loop_start() {
	// ekiline_show_columns( 'open' );
	$colcontain = ( '4' === get_theme_mod( 'ekiline_Columns' ) ) ? 'card-columns' : 'row';
	echo '<ul id="viewcolumns" class="m-0 p-0 w-100 ' . $colcontain . '">';
}

function woocommerce_product_loop_end() {
	// ekiline_show_columns( 'close' );
	echo '</ul>';
}

/**
 * Shop page, item.
 */
function ekiline_card_item_open() {
	if ( '4' === get_theme_mod( 'ekiline_Columns' ) ) {
		echo '<div class="card-body p-1 text-center">';
	}
}
add_action( 'woocommerce_before_shop_loop_item', 'ekiline_card_item_open', 0 );

function ekiline_card_item_close() {
	if ( '4' === get_theme_mod( 'ekiline_Columns' ) ) {
		echo '</div><!--card-body-->';
	}
}
add_action( 'woocommerce_after_shop_loop_item', 'ekiline_card_item_close', 100 );
