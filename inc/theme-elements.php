<?php
/**
* Objetos del tema || Theme objects
*
* Funciones complementarias para el marcado HTML.
* HTML Markup complementary functions.
*
* @package ekiline
*/


/**
* Reemplazar el marcado para el enlace de leer mas
* Custom read more link
*/
function override_read_more_link() {
	/* translators: screenread only %s is replaced with title */
	return '<a class="more-link" href="' . get_permalink() . '" aria-label="' . sprintf( esc_html__( 'Continue reading %s', 'ekiline' ), wp_strip_all_tags( get_the_title() ) ) . '">' . __( 'Read more', 'ekiline' ) . '</a>';
}
add_filter( 'the_content_more_link', 'override_read_more_link' );

/**
* Widgets en footer
* Footer widgets
*/

function ekiline_count_widgets( $widget_area ) {
	// agreagar un contenedor en caso de existir más de 2 widgets, util para usar columnas de bootstrap.
	if ( is_active_sidebar( $widget_area ) ) :

		$the_sidebars   = wp_get_sidebars_widgets();
		$count_sidebars = count( $the_sidebars[ $widget_area ] );

		if ( $count_sidebars >= '2' ) {
			echo '<div class="row">';
				dynamic_sidebar( $widget_area );
			echo '</div>';
		} else {
			dynamic_sidebar( $widget_area );
		}

	endif;
}


/**
* 1) Manipular el marcado en el thumbnail
* Custom thumbnail markup
* https://developer.wordpress.org/reference/functions/the_post_thumbnail/
**/
function ekiline_thumbnail() {
	if ( ! has_post_thumbnail() ) {
		return;
	}
	if ( is_singular() && get_header_image() ) {
		return;
	}
	// thumbnail size
	$thumb_size = ( is_search() ) ? 'thumbnail' : 'medium';
	// clase css varia por tipo de contenido
	$img_class  = 'img-fluid ';
	$img_class .= ( get_theme_mod( 'ekiline_Columns' ) === '4' ) ? 'card-img-top ' : 'img-thumbnail ';

	return the_post_thumbnail( $thumb_size, array( 'class' => $img_class ) );
}

/**
 * 2) Agregar enlace a todas las miniaturas.
 * Link all post thumbnails to the post permalink.
 */

function ekiline_link_thumbnail( $html, $post_id, $post_image_id ) {
	if ( is_single() ) {
		return $html;
	}
	// si es search, se agrega una clase
	$thumb_class = ( is_search() ) ? ' class="search-link"' : '';

	$html = '<a href="' . get_permalink( $post_id ) . '" title="' . wp_strip_all_tags( get_the_title( $post_id ) ) . '"' . $thumb_class . '>' . $html . '</a>';
	return $html;
}
add_filter( 'post_thumbnail_html', 'ekiline_link_thumbnail', 10, 3 );

/**
* Manipular el titulo de listados (archive) con filtros.
* Custom Title markup.
* https://developer.wordpress.org/reference/hooks/get_the_archive_title/
*/
function my_theme_archive_title( $title ) {

	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	}

	if ( is_home() ) {
		$title = get_bloginfo( 'name' );
	}

	return $title;

}
add_filter( 'get_the_archive_title', 'my_theme_archive_title' );


/**
* 1) Manipular el contenido con filtros
* Custom markup content.
* https://developer.wordpress.org/reference/hooks/the_content/
* https://developer.wordpress.org/reference/functions/the_excerpt/
* https://wordpress.stackexchange.com/questions/38030/is-there-a-has-more-tag-method-or-equivalent
*/

function ekiline_content_additions( $content ) {

	if ( is_singular() ) {
		return $content;
	}

	if ( is_home() || is_front_page() || is_archive() || is_search() ) {
		global $post;
		/* translators: screenread only %s is replaced with title */
		$link = '... <a class="more-link" href="' . get_permalink() . '" aria-label="' . sprintf( esc_html__( 'Continue reading %s', 'ekiline' ), wp_strip_all_tags( get_the_title() ) ) . '">' . __( 'Read more', 'ekiline' ) . '</a>';

		if ( strpos( $post->post_content, '<!--more-->' ) ) {
			$content = $content;
		} elseif ( '' !== $post->post_excerpt ) {
			$content = $post->post_excerpt . $link;
		} else {
			$content = wp_trim_words( $content, 55, $link );
		}
	}

	return $content;

}
add_filter( 'the_content', 'ekiline_content_additions' );

/**
 * 1B) Obtener un fragmento del contenido fuera del loop
 * Get content fragment out the loop
 * https://wordpress.stackexchange.com/questions/38030/is-there-a-has-more-tag-method-or-equivalent
 * https://wordpress.stackexchange.com/questions/149099/only-show-content-before-more-tag
 */
function ekiline_content_out_the_loop() {
	global $post;
	$content = $post->post_content;
	$more    = strpos( $content, '<!--more-->' );
	$excerpt = $post->post_excerpt;

	if ( $more ) {
		$content_parts = get_extended( $content );
		$content       = $content_parts['main'];
	} elseif ( $excerpt ) {
		$content = $excerpt;
	} else {
		//toma el primer parrafo solo 24 palabras y cortar
		$content = wp_trim_words( $content, 24 );
		//Si existe un punto antes cortar
		$punto = strpos( $content, '.' );
		if ( $punto ) {
			$content = substr( $content, 0, strpos( $content, '.' ) ) . '.';
		}
	}

	return wp_strip_all_tags( $content );
}

/**
* 2) agregar paginado en publicaciones paginadas
* Add pagination to paginated content.
* https://developer.wordpress.org/reference/functions/wp_link_pages/
*/

function ekiline_link_pages() {

	if ( ! is_singular() ) {
		return;
	}

	$args = array(
		'before'         => '<p class="page-links border-bottom p-2 text-right"><i class="float-left">' . esc_html__( 'Continue reading:', 'ekiline' ) . '</i>',
		'after'          => '</p>',
		'link_before'    => '<span class="btn btn-sm btn-primary">',
		'link_after'     => '</span>',
		'next_or_number' => 'number',
	);

	wp_link_pages( $args );
}


/**
* Personalizar el formulario de busqueda.
* Override search form markup.
* https://developer.wordpress.org/reference/functions/locate_template/
**/

function ekiline_search_form() {
	return locate_template( get_template_part( 'template-parts/searchform' ) );
}
add_filter( 'get_search_form', 'ekiline_search_form' );

/**
	* 1) Personalizar el formulario de proteccion de lectura.
	* Override protected content form.
*/

function ekiline_password_form() {
	global $post;
	$label   = 'pwbox-' . ( empty( $post->ID ) ? wp_rand() : $post->ID );
	$output  = '<form action="' . esc_url( home_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form form-inline col-sm-8 p-4 mx-auto text-center" method="post">';
	$output .= '<p>' . __( 'This content is password protected. To view it please enter your password below:', 'ekiline' ) . '</p>';
	$output .= '<div class="form-inline mx-auto"><label for="' . $label . '">' . __( 'Password:', 'ekiline' ) . ' </label>';
	$output .= '<div class="input-group pl-md-5"><input class="form-control" name="post_password" id="' . $label . '" type="password" size="20" />';
	$output .= '<span class="input-group-append"><input class="btn btn-dark" type="submit" name="Submit" value="' . esc_attr_x( 'Enter', 'post password form', 'ekiline' ) . '" /></span></div></div></form>';
	return $output;
}
add_filter( 'the_password_form', 'ekiline_password_form' );

/*
* 2) Expirar la sesion que permite leer un contenido protegido
* Expire post password
* https://developer.wordpress.org/reference/hooks/post_password_expires/
*/

function ekiline_expire_cookie( $time ) {
	// return time() + 600 ;  // 10 mn
	// for 5 minutes :
	// return time() + 300;  in this case 60 * 5
	// return 0; set cookie to expire at the end of the session
	return 0;
}
add_filter( 'post_password_expires', 'ekiline_expire_cookie' );


/**
* Paginacion para page & single & archive
* https://codex.wordpress.org/Next_and_Previous_Links
**/

function ekiline_pagination() {

	if ( is_front_page() && ! is_home() ) {
		return;
	}

	// en caso de woocommerce no aplica
	if ( class_exists( 'WooCommerce' ) ) {
		if ( is_cart() || is_checkout() || is_account_page() ) {
			return;
		}
	}

	$the_pages = '';
	$prev_link = '';
	$next_link = '';

	if ( is_page() ) {

		$pagelist = get_pages( 'sort_column=menu_order&sort_order=asc' );
		$pages    = array();

		foreach ( $pagelist as $page ) {
			$pages[] += $page->ID;
		}

		$current = array_search( get_the_ID(), $pages, true );
		$prev_id = ( isset( $pages[ $current - 1 ] ) ) ? $pages[ $current - 1 ] : '';
		$nexr_id = ( isset( $pages[ $current + 1 ] ) ) ? $pages[ $current + 1 ] : '';

		if ( ! empty( $prev_id ) ) {
			$prev_link .= '<li class="page-item page-link"><a href="' . get_permalink( $prev_id ) . '" title="' . get_the_title( $prev_id ) . '"><span>&leftarrow;</span> ' . get_the_title( $prev_id ) . '</a></li>';
		}
		if ( ! empty( $nexr_id ) ) {
			$next_link .= '<li class="page-item page-link"><a href="' . get_permalink( $nexr_id ) . '" title="' . get_the_title( $nexr_id ) . '">' . get_the_title( $nexr_id ) . ' <span>&rightarrow;</span></a></li>';
		}
	}

	if ( is_single() ) {
		$prev_link = get_previous_post_link( '<li class="page-item page-link">%link</li>', '<span>&leftarrow;</span> %title', true );
		$next_link = get_next_post_link( '<li class="page-item page-link">%link</li>', '%title <span>&rightarrow;</span>', true );
	}

	/* Paginacion para listados: https://codex.wordpress.org/Function_Reference/paginate_links */

	if ( is_archive() || is_home() || is_search() ) {

		global $wp_query;
		$big = 999999999;

		$pages = paginate_links(
			array(
				'base'      => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
				'format'    => '?page=%#%',
				'current'   => max( 1, get_query_var( 'paged' ) ),
				'total'     => $wp_query->max_num_pages,
				'type'      => 'array',
				'prev_next' => true,
				'prev_text' => __( '&larr; Previous', 'ekiline' ),
				'next_text' => __( 'Next &rarr;', 'ekiline' ),
			)
		);

		if ( is_array( $pages ) ) {

			$current_page = ( get_query_var( 'paged' ) === 0 ) ? 1 : get_query_var( 'paged' );

			foreach ( $pages as $i => $page ) {

				$page = str_replace( 'page-numbers', 'page-link', $page );

				if ( 1 === $current_page && 0 === $i ) {
					$prev_link .= "<li class='page-item active'>$page</li>";
				} else {
					if ( 1 !== $current_page && $i === $current_page ) {
						$prev_link .= "<li class='page-item active'>$page</li>";
					} else {
						$prev_link .= "<li class='page-item'>$page</li>";
					}
				}
			}
		}
	}

	$the_pages .= '<nav id="page-navigation" class="d-flex justify-content-center w-100" aria-label="Page navigation">';
	$the_pages .= '<ul class="pagination justify-content-between">';
	$the_pages .= $prev_link;
	$the_pages .= $next_link;
	$the_pages .= '</ul>';
	$the_pages .= '</nav>';

	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo $the_pages;
}



/**
	* Obtener categorias para pagina 404
	*/
function ekiline_categorized_blog() {
	$all_categories = get_transient( 'ekiline_categories' );
	if ( false === $all_categories ) {
		// Create an array of all the categories that are attached to posts.
		$all_categories = get_categories(
			array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$all_categories = count( $all_categories );

		set_transient( 'ekiline_categories', $all_categories );
	}

	if ( $all_categories > 1 ) {
		// This blog has more than 1 category so ekiline_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so ekiline_categorized_blog should return false.
		return false;
	}
}

/**
	* Flush out the transients used in ekiline_categorized_blog.
	*/
function ekiline_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'ekiline_categories' );
}
add_action( 'edit_category', 'ekiline_category_transient_flusher' );
add_action( 'save_post', 'ekiline_category_transient_flusher' );
