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

			<?php ekiline_show_columns('open'); ?>

				<?php
					/** Loop https://developer.wordpress.org/themes/basics/the-loop/ **/
					if ( have_posts() ) { 
						while ( have_posts() ) : 
							the_post();

							$postFormat = ( !is_singular() && get_theme_mod('ekiline_Columns') == 4 ) ? 'card' : get_post_format() ;

							get_template_part( 'template-parts/content', $postFormat );	

						endwhile;	
					} else {
							get_template_part( 'template-parts/content', 'none' );	
					}	
				?>

			<?php ekiline_show_columns('close'); ?>

		<?php ekiline_pages_navigation();?>

		<?php dynamic_sidebar( 'content-w2' ); ?>		

		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( is_singular() && !is_front_page() ){
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			}
		?>

	</main><!-- #primary -->

	<?php get_sidebar(); ?>

	<?php get_sidebar('right'); ?>	

<?php ekiline_main_columns('close'); ?>

<?php get_footer(); ?>