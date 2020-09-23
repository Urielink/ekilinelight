<?php
/**
 * Search template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package ekiline
 */

get_header();
?>

<?php ekiline_main_columns( 'open' ); ?>

	<main id="primary" class="<?php ekiline_sort_cols( 'main' ); ?>">

		<?php dynamic_sidebar( 'content-w1' ); ?>

		<?php get_template_part( 'template-parts/content', 'headline' ); ?>

		<?php

		if ( have_posts() ) {
			// Ejemplo: en caso de personalizar los indices.
			ekiline_show_columns( 'open', 'd-flex flex-column mx-0' );

			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile;

			ekiline_show_columns( 'close' );

		} else {
			get_template_part( 'template-parts/content', 'none' );
		}

		?>

		<?php ekiline_pagination(); ?>

		<?php dynamic_sidebar( 'content-w2' ); ?>

	</main><!-- #primary -->

	<?php get_sidebar(); ?>

<?php ekiline_main_columns( 'close' ); ?>

<?php get_footer(); ?>
