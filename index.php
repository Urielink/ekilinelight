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

<?php ekiline_main_columns('open'); ?>

	<main id="primary" class="<?php orderCols('main');?>">

		<?php dynamic_sidebar( 'content-w1' );?>

		<?php if ( !is_singular() ) : the_archive_title('<h1>','</h1>'); endif; ?>

		<?php
			/** Loop https://developer.wordpress.org/themes/basics/the-loop/ **/
			if ( have_posts() ) {

				ekiline_show_columns('open');

				while ( have_posts() ) : 
					the_post();
					// en caso de ocupar 'cards'.
					// $postFormat = ( !is_singular() && get_theme_mod('ekiline_Columns') == 4 ) ? 'card' : get_post_format() ;
					// get_template_part( 'template-parts/content', $postFormat );	
					get_template_part( 'template-parts/content' );	

				endwhile;

				ekiline_show_columns('close');

			} else {
				get_template_part( 'template-parts/content', 'none' );	
			}	
		?>

		<?php ekiline_pages_navigation();?>

		<?php dynamic_sidebar( 'content-w2' ); ?>		

		<?php comments_template('/template-parts/comments.php'); ?>

	</main><!-- #primary -->

	<?php get_sidebar(); ?>

<?php ekiline_main_columns('close'); ?>

<?php get_footer(); ?>