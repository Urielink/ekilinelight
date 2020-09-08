<?php
/**
 * Plantilla de búsqueda
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

		<?php

		if ( have_posts() ) {
			?>

			<header class="entry-header">
				<h1 class="page-title">
					<?php
						/* translators: %s is replaced with search query */
						printf( esc_html__( 'Search Results for: %s', 'ekiline' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
				<p>
					<?php
						/* translators: %s is replaced with results */
						printf( esc_html__( '%s results found.', 'ekiline' ), esc_attr( $wp_query->found_posts ) );
					?>
				</p>
			</header><!-- .entry-header -->

			<?php

			get_search_form();

			ekiline_show_columns( 'open' );

			while ( have_posts() ) :
				the_post();
				// en caso de ocupar 'cards'.
				$post_style = ( ! is_singular() && get_theme_mod( 'ekiline_Columns' ) === '4' ) ? 'card' : get_post_type();
				get_template_part( 'template-parts/content', $post_style );

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
