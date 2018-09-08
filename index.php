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

<main>
<?php //Loop https://developer.wordpress.org/themes/basics/the-loop/
	if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<article <?php post_class();?>>
        <?php 
        the_title('<h1>','</h1>');
        the_content(); 
        ?>
    </article>
<?php		
    endwhile;
    else :
        _e( 'Sorry, no posts matched your criteria.', 'textdomain' );
    endif;
?>
</main>

<?php // get_template_part(); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>