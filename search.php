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
get_header(); ?>

<?php mainCols('open'); ?>

<main id="primary" class="<?php orderCols('main');?>">

<?php dynamic_sidebar( 'content-w1' );?>				

<?php
	/** Loop https://developer.wordpress.org/themes/basics/the-loop/ **/
	if ( have_posts() ) { 
?>
	<header class="entry-header">
		<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'ekiline' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		<p><?php printf( esc_html__( '%s results found.', 'ekiline' ), $wp_query->found_posts ); ?></p>
	</header><!-- .entry-header -->

<?php get_search_form(); ?>

<?php		
		while ( have_posts() ) : 
			the_post();
			get_template_part( 'template-parts/content', get_post_format() );	
		endwhile;	
		
		ekiline_pages_navigation();

    } else {
			get_template_part( 'template-parts/content', 'none' );	
    }	
?>

<?php dynamic_sidebar( 'content-w2' ); ?>		


</main><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_sidebar('right'); ?>	

<?php mainCols('close'); ?>

<?php get_footer(); ?>