<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ekiline
 */

?>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>

<aside id="secondary" class="widget-area<?php ekiline_sort_cols( 'left' ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->

<?php } ?>


<?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>

<aside id="third" class="widget-area<?php ekiline_sort_cols( 'right' ); ?>">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</aside><!-- #third -->

<?php } ?>
