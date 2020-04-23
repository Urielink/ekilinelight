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
 * Directorio de textos, agregar textos que sean necesarios para el tema invocar con funciones.
 * Custom text lines, use this to add custom texts in theme, and call it with functions.
 **/
 
function ekiline_notes($text = null) {
	$item = ''; 	
	switch ($text) {
		case 'copyright':
			$item = sprintf( esc_html__( '&copy; Copyright %1$s.', 'ekiline' ), esc_attr( date('Y') . ' ' . get_bloginfo( 'name', 'display' ) ) );
			$item .= '&nbsp;';
			$item .= sprintf( esc_html__( 'Proudly powered by %1$s and %2$s.', 'ekiline' ),'<a href="'.__('https://wordpress.org/','ekiline').'" target="_blank">WordPress</a>','<a href="'.__('http://ekiline.com','ekiline').'" target="_blank">Ekiline</a>' );
			break;

		case 'published':
			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>' . __(' Updated on ', 'ekiline') . '<time class="updated" datetime="%3$s">%4$s</time>';
			}
		
			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);
			
			//ekiline, mejor elazamos al mes
			$archive_year  = get_the_time('Y');
			$archive_month = get_the_time('m');
			$timelink = get_month_link( $archive_year, $archive_month ); //era get_permalink() 
		
			$item = sprintf(
				esc_html_x( 'Posted on %s', 'post date', 'ekiline' ), 
				'<a href="' . esc_url( $timelink ) . '" rel="bookmark">' . $time_string . '</a>'
			);		
			break;
		case 'author':
			// https://developer.wordpress.org/reference/functions/get_the_author_meta/
			global $post;
			$author_id = $post->post_author;
			$item = sprintf(
				esc_html_x( 'Written by %s', 'post authors', 'ekiline' ), 
				// '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
				'<span class="author vcard"><a class="url" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID'  ), get_the_author_meta('user_nicename', $author_id) ) ) . '">' . esc_html( get_the_author_meta('display_name', $author_id) ) . '</a></span>'
			);			
			break;
		case 'categories':
			if( is_page() ) return;
				global $post;
				$cats = get_the_category( $post->ID );
				foreach ( $cats as $cat ) {
					$item .= ' <a href="' . get_category_link( $cat->term_id ) . '">' .  $cat->name  .'</a>,';
				}
				$item = __('Categories:', 'ekiline') . $item;
			break;
		case 'tags':
			$tags_list = get_the_tag_list( '', esc_html__( ',  ', 'ekiline' ) );
			if ( $tags_list ) {
				$item = sprintf( esc_html__( 'Tags: %1$s', 'ekiline' ) , '<span class="tags-links">' . $tags_list . '</span> ' ) ;
			}	
			break;
		case 'addcomment':
			if ( ! is_single() && ! is_front_page() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) return;			
			if ( comments_open() ) {
				$item = '<span class="comments-link">';
				$item .= comments_popup_link( esc_html__( 'Leave a comment', 'ekiline' ), esc_html__( '1 Comment', 'ekiline' ), esc_html__( '% Comments', 'ekiline' ) );
				$item .= '</span> ';
			} else {
				$item = esc_html__( 'Comments are closed.', 'ekiline' );
			}
			break;			
	}	
    return $item;
}

/**
 * Obtener un id, agregar al marcado (content.php).
 * Get id each post.
 **/
function ekiline_post_id(){
	$itemId = get_post_type() . '-' . get_the_ID();	
	echo $itemId;
}

/**
 * Reemplazar el marcado para el enlace de leer mas 
 * Custom read more link
 */
function overrideReadMoreLink(){
	return '<a class="more-link" href="' . get_permalink() . '" aria-label="' . sprintf( esc_html__( 'Continue reading %s', 'ekiline' ), wp_strip_all_tags( get_the_title() ) ) . '">'. __( 'Read more', 'ekiline') .'</a>';
}
add_filter( 'the_content_more_link', 'overrideReadMoreLink' );

/**
 * Widgets en footer
 * Footer widgets
 */

function ekiline_countWidgets( $widgetZone ){
	// agreagar un contenedor en caso de existir más de 2 widgets, util para usar columnas de bootstrap.
	if ( is_active_sidebar($widgetZone) ) :
		
		$the_sidebars = wp_get_sidebars_widgets();
		$count_sidebars = count( $the_sidebars[$widgetZone] );  

		if ($count_sidebars >= '2'){
			echo '<div class="row justify-content-between">';
				dynamic_sidebar($widgetZone);    
			echo '</div>';
		} else {
			dynamic_sidebar($widgetZone);
		}

	endif;
}


/**
 * 1) Manipular el marcado en el thumbnail
 * Custom thumbnail markup
 * https://developer.wordpress.org/reference/functions/the_post_thumbnail/
 **/
function ekiline_thumbnail(){
	if ( !has_post_thumbnail() ) return;
	if ( is_single() || is_page() ) return;
	// thumbnail size
	$thumbSize = ( is_search() ) ? 'thumbnail' : 'medium' ;
	// clase css varia por tipo de contenido
	$imgClass = ( get_theme_mod('ekiline_Columns') == 4 ) ? 'card-img-top' : 'img-thumbnail' ;

	return the_post_thumbnail( $thumbSize, array( 'class' => $imgClass ) );
}

	/**
	 * 2) Agregar enlace a todas las miniaturas. 
	 * Link all post thumbnails to the post permalink.
	 */

	function ekiline_link_thumbnail( $html, $post_id, $post_image_id ) {
		if ( is_single() ) return $html;
		// si es search, se agrega una clase 
		$thumbClass = ( is_search() ) ? ' class="float-md-left pr-2"' : '' ;

		$html = '<a href="' . get_permalink( $post_id ) . '" title="' . wp_strip_all_tags( get_the_title( $post_id ) ) . '"' . $thumbClass . '>' . $html . '</a>';	
		return $html;
	}
	add_filter( 'post_thumbnail_html', 'ekiline_link_thumbnail', 10, 3 );



/**
 * Manipular el titulo con filtros.
 * Custom Title markup.
 * https://developer.wordpress.org/reference/functions/the_title_attribute/
 */

function ekiline_link_title( $title ) {

	$tagClass = ( get_theme_mod('ekiline_Columns') == 4 && !is_singular() ) ? 'entry-title card-title' : 'entry-title' ;

	if ( in_the_loop() ){
		if ( is_single() || is_page() ){
			$title = '<h1 class="'. $tagClass .'">' . $title . '</h1>';
		} else {	
			$title = '<h2 class="'. $tagClass .'"><a href="'. get_the_permalink() .'" title="'. $title .'">' . $title . '</a></h2>';
		}
	}
	return $title;
}	
add_filter( 'the_title', 'ekiline_link_title' );


/**
 * 1) Manipular el contenido con filtros
 * Custom markup content.
 * https://developer.wordpress.org/reference/hooks/the_content/
 * https://developer.wordpress.org/reference/functions/the_excerpt/
 */

function ekiline_content_additions( $content ) {

	if( is_singular() ) return $content;
	
	if ( is_home() || is_front_page() || is_archive() || is_search() ) {

		global $post;
		if( strpos( $post->post_content, '<!--more-->' ) ) {
			$content = $content;
		} else {
			$link = '... <a class="more-link" href="' . get_permalink() . '" aria-label="' . sprintf( esc_html__( 'Continue reading %s', 'ekiline' ), wp_strip_all_tags( get_the_title() ) ) . '">'. __( 'Read more', 'ekiline') .'</a>';
			$content = wp_trim_words( $content, 55, $link);
		}
		
	}	

	return $content;

}	
add_filter( 'the_content', 'ekiline_content_additions');

/**
 * 2) agregar paginado en publicaciones paginadas
 * Add pagination to paginated content.
 */

function ekiline_link_pages(){

	if ( !is_singular() ) return;

	$linktag = array(
		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ekiline' ),
		'after'  => '</div>',
	);
	
	wp_link_pages($linktag);
}


/**
 * Personalizar el formulario de busqueda.
 * Override search form markup.
 **/
 
function ekiline_search_form( $form ) {
    
    $form = '<form role="search" method="get" id="searchform" class="searchform my-2" action="' . home_url( '/' ) . '" >
                <label class="screen-reader-text" for="s">' . esc_html__( 'Search Results for: %s', 'ekiline' ) . '</label>
                <div class="input-group">
                    <input class="form-control" type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_html__( 'Search Results for:', 'ekiline' ) . '"/>
                    <span class="input-group-append"><button class="btn btn-secondary" type="submit" id="searchsubmit"><span>&orarr;</span> '. esc_attr__( 'Search', 'ekiline' ) .'</button></span>
                </div>
            </form>';

    return $form;
}
add_filter( 'get_search_form', 'ekiline_search_form' );


/**
 * 1) Personalizar el formulario de proteccion de lectura. 
 * Override protected content form.
*/

function ekiline_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form form-inline col-sm-8 p-4 mx-auto text-center" method="post">';
    $output .= '<p>' . __( 'This content is password protected. To view it please enter your password below:','ekiline' ) . '</p>';
	$output .= '<div class="form-inline mx-auto"><label for="' . $label . '">' . __( 'Password:','ekiline' ) . ' </label>';
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

function ekiline_expirCookie( $time ) { 
	// return time() + 600 ;  // 10 mn
	// for 5 minutes :  
	// return time() + 300;  in this case 60 * 5 
	// return 0; set cookie to expire at the end of the session
	return 0;
  }
  add_filter('post_password_expires', 'ekiline_expirCookie' );


/**
 * Paginacion para page & single & archive
 * https://codex.wordpress.org/Next_and_Previous_Links
 **/

function ekiline_pages_navigation(){

	if ( is_front_page() ) return;	

	// en caso de woocommerce no aplica
	if ( class_exists( 'WooCommerce' ) ) {
		if ( is_cart() || is_checkout() || is_account_page() ) return;
	}

	$thePages = '';
	$PreviusLink = '';
	$NextLink = '';
	
	if ( is_page() ){
			
		$pagelist = get_pages('sort_column=menu_order&sort_order=asc');
		$pages = array();
		
		foreach ($pagelist as $page) {
			$pages[] += $page->ID;
		}

		$current = array_search(get_the_ID(), $pages);
			$prevID = (isset($pages[$current-1])) ? $pages[$current-1] : '';
			$nextID = (isset($pages[$current+1])) ? $pages[$current+1] : '';
			
		if (!empty($prevID)) {
			$PreviusLink .= '<li class="page-item page-link"><a href="'. get_permalink($prevID) .'" title="'. get_the_title($prevID) .'"><span>&leftarrow;</span> '. get_the_title($prevID) .'</a></li>';
		}
		if (!empty($nextID)) {
			$NextLink .= '<li class="page-item page-link"><a href="'. get_permalink($nextID) .'" title="'. get_the_title($nextID) .'">'. get_the_title($nextID) .' <span>&rightarrow;</span></a></li>';
		}
				
	}

	if ( is_single() ){ 

		$PreviusLink = get_previous_post_link('<li class="page-item page-link">'.'%link'.'</li>', '<span>&leftarrow;</span> %title', TRUE); 
		$NextLink = get_next_post_link('<li class="page-item page-link">'.'%link'.'</li>', '%title <span>&rightarrow;</span>', TRUE);

	}


	/* Paginacion para listados: https://codex.wordpress.org/Function_Reference/paginate_links */

	if ( is_archive() || is_home() || is_search() ){
		
		global $wp_query;
		$big = 999999999;
		
		$pages = paginate_links(array(
					'base' => str_replace($big, '%#%', get_pagenum_link($big)),
					'format' => '?page=%#%',
					'current' => max(1, get_query_var('paged')),
					'total' => $wp_query->max_num_pages,
					'type' => 'array',
					'prev_next' => TRUE,
					'prev_text' => __( '&larr; Previous', 'ekiline' ),
					'next_text' => __( 'Next &rarr;', 'ekiline' ),
				));
				
		if ( is_array($pages) ) {
			
			$current_page = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');        
			
			foreach ($pages as $i => $page) {
	
				$page = str_replace( 'page-numbers', 'page-link', $page );			
				
				if ($current_page == 1 && $i == 0) {                
					$PreviusLink .= "<li class='page-item active'>$page</li>";                
				} else {                
					if ($current_page != 1 && $current_page == $i) {                    
						$PreviusLink .= "<li class='page-item active'>$page</li>";                    
					} else {                    
						$PreviusLink .= "<li class='page-item'>$page</li>";                    
					}
				}
				
			}			
		}
		
	}

	$thePages .= '<nav id="page-navigation" class="d-flex justify-content-center w-100" aria-label="Page navigation">';
	$thePages .= '<ul class="pagination justify-content-between">';
	$thePages .= $PreviusLink; 			    
	$thePages .= $NextLink;
	$thePages .= '</ul>';
	$thePages .= '</nav>';


	echo $thePages;

} 


/**
 * Crear un header dinamico y personalizable.
 * https://codex.wordpress.org/Plugin_API/Action_Reference/get_header
 **/

// function themeslug_header_hook() {
// 	get_template_part( 'template-parts/global-header' );
// }
// add_action( 'get_header', 'themeslug_header_hook' );

