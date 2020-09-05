<?php
/**
 * Jetpack Compatibility.
 *
 * @link https://themeshaper.com/2016/01/29/jetpack-dependency-script/
 * @link https://jetpack.com/support/jetpack-for-developers/
 *
 * @package ekiline
 */

/**
 * Jetpack setup.
 */
function ekiline_jetpack_setup() {

	// Scroll infinito.
	$args_infinite_scroll = array(
		'container' => ekiline_infinite_scroll_wrapper(),
		'render'    => 'ekiline_infinite_scroll_render',
		'footer'    => 'page',
		'wrapper'   => false,
	);
	add_theme_support( 'infinite-scroll', $args_infinite_scroll );

}
add_action( 'after_setup_theme', 'ekiline_jetpack_setup' );

/**
 * Change template part.
 */
function ekiline_infinite_scroll_wrapper() {
	$wrapper = ( get_theme_mod( 'ekiline_Columns' ) > '0' ) ? 'viewcolumns' : 'primary';
	return $wrapper;
}

/**
 * Custom render function for Infinite Scroll.
 */
function ekiline_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		$post_style = ( get_theme_mod( 'ekiline_Columns' ) === '4' ) ? 'card' : get_post_format();
		get_template_part( 'template-parts/content', $post_style );
	}
}
