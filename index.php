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

<?php ekiline_main_columns( 'open' ); ?>

	<main id="primary" class="<?php orderCols( 'main' ); ?>">

		<?php dynamic_sidebar( 'content-w1' ); ?>

		<?php get_template_part( 'template-parts/content', 'archive' ); ?>

		<?php
			/** Loop https://developer.wordpress.org/themes/basics/the-loop/ **/
			if ( have_posts() ) {

				ekiline_show_columns( 'open' );

				while ( have_posts() ) :
					the_post();
					/*
					* repasar este tema
					* https://developer.wordpress.org/reference/functions/get_post_type/
					* https://cybmeta.com/como-utilizar-get_template_part
					* https://wordpress.stackexchange.com/questions/260998/get-template-part-based-on-get-post-type-for-a-custom-post-type-instead-of-g
					*/
					// en caso de ocupar 'cards'.
					$postType = ( ! is_singular() && get_theme_mod( 'ekiline_Columns' ) == 4 ) ? 'card' : get_post_type() ;
					get_template_part( 'template-parts/content', $postType );

				endwhile;

				ekiline_show_columns( 'close' );

			} else {
				get_template_part( 'template-parts/content', 'none' );
			}
		?>

		<?php ekiline_pagination(); ?>

		<?php dynamic_sidebar( 'content-w2' ); ?>

		<?php comments_template( '/template-parts/comments.php' ); ?>

	</main><!-- #primary -->

	<?php get_sidebar(); ?>

<?php ekiline_main_columns( 'close' ); ?>

<?php get_footer(); ?>
