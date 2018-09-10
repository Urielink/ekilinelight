<?php
/**
 * Plantilla principal del Frontend.
 * 
 * Esta es la vista principal de un sitio, aqui se mostraran cada una de sus partes.
 * El consejo es que no ocupes caracteres especiales.
 * Y organices bien tus archivos.
 * Ekiline esta hecho para tener control sobre elementos de diseno.
 * 
 * @link https://developer.wordpress.org/themes/basics/template-files/
 * 
 * @package ekiline
 * 
 */ 
//Variables index.
function mainCols($tag){
	if( is_active_sidebar( 'sidebar-1') || is_active_sidebar( 'sidebar-2') ){
		if ($tag == 'open'){
			echo '<div id="maincolumns" class="'.orderCols('row').'">';
		} elseif ($tag == 'close'){
			echo '</div><!-- #mainContainer -->';
		}	
	}	 
}
function orderCols($css){
// orden de columnas.	
	$cssRow = 'row m-0';
	$cssMain = 'col-md-8 order-md-2';
	$cssLeft = ' col-md-2 order-md-1';
	$cssRight = ' col-md-2 order-md-3';	
// aparicion de columnas
if( is_active_sidebar( 'sidebar-1') && !is_active_sidebar( 'sidebar-2') ){
	$cssMain = 'col-md-9 order-md-2';
	$cssLeft = ' col-md-3 order-md-1';
}
if( !is_active_sidebar( 'sidebar-1') && is_active_sidebar( 'sidebar-2') ){
	$cssMain = 'col-md-9';
	$cssRight = ' col-md-3';	
}
if( !is_active_sidebar( 'sidebar-1') && !is_active_sidebar( 'sidebar-2') ){
	$cssMain = 'no-sidebars';
}
// imprimir
	if ($css == 'row') return $cssRow;
	if ($css == 'main') echo $cssMain;
	if ($css == 'left') echo $cssLeft;
	if ($css == 'right') echo $cssRight;
}

get_header(); ?>

<?php dynamic_sidebar( 'toppage-w1' );?>				

<?php mainCols('open'); ?>

<main id="primary" class="<?php orderCols('main');?>">

<?php dynamic_sidebar( 'content-w1' );?>				

<?php
	/** Loop https://developer.wordpress.org/themes/basics/the-loop/ **/
	if ( have_posts() ) { 
		while ( have_posts() ) : 
			the_post();
			get_template_part( 'template-parts/content', get_post_format() );	
		endwhile;	
    } else {
			get_template_part( 'template-parts/content', 'none' );	
    }	
?>

<?php ekiline_archive_pagination(); ?>

<?php dynamic_sidebar( 'content-w2' ); ?>		

<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if ( is_single() || is_page() && !is_front_page() ){
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	}
?>


</main><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_sidebar('right'); ?>	

<?php mainCols('close'); ?>

<?php get_footer(); ?>