<?php
/**
 * Objetos del tema || Theme objects
 *
 * @package ekiline
 */

/*
 * Funciones complementarias para el personalizador.
 * Customizer complementary functions.
 */

/* Ancho de layout | Layout width */

function widthControl(){
	$widthClass = 'container';
	$widthClassAdd = '-fluid';
	
	if( is_front_page() || is_home() ){
		$widthClass .= ( true === get_theme_mod('ekiline_anchoHome') ) ? $widthClassAdd : '' ;
	}
	if( is_archive() || is_category() ){
		$widthClass .= ( true === get_theme_mod('ekiline_anchoArchive') ) ? $widthClassAdd : '' ;
	}
	if( is_single() || is_page() && !is_front_page() ){
		$widthClass .= ( true === get_theme_mod('ekiline_anchoSingle') ) ? $widthClassAdd : '' ;
	}

	// proteccion a la lectura en caso de imagen
	$widthClass .= ( get_option('main_color') != '#f8f9fa' ) ? ' bg-main' : '' ;

	return $widthClass;
}

/* Ancho de layout sin sidebars | Layout width, no sidebars */

function viewSbarFilter($wsbCtl) {

	$opt = '';

	if( is_front_page() || is_home() ){
		$opt = get_theme_mod('ekiline_disableSbHome' );
	}

	if( is_archive() || is_category() ){
		$opt = get_theme_mod('ekiline_disableSbArchive' );
	}

	if( is_single() || is_page() && !is_front_page() ){
		$opt = get_theme_mod('ekiline_disableSbSingle' );
	}

	switch ( $opt ) {
		case 1:
			unset($wsbCtl['sidebar-1']);
			break;
		case 2:
			unset($wsbCtl['sidebar-2']);
			break;
		case 3:
			unset($wsbCtl['sidebar-1']);
			unset($wsbCtl['sidebar-2']);			
			break;
	}

	return $wsbCtl;	

}
add_filter( 'sidebars_widgets', 'viewSbarFilter' );

/* Orden de columnas | Columns order */

function mainCols($tag){
	if (!is_active_sidebar( 'sidebar-1') && !is_active_sidebar( 'sidebar-2')) return;
	// En caso de existir barras laterales agregar envoltorio
	if ($tag == 'open') echo '<div id="maincolumns" class="row mx-0 ' . widthControl() . ' mx-auto px-0">';
	if ($tag == 'close') echo '</div><!-- #maincolumns -->'; 
}

function orderCols($css){
	$cssMain = widthControl();//'container ';
	if (is_active_sidebar( 'sidebar-1') || is_active_sidebar( 'sidebar-2')) {
	// sidebars.
		$sbL = is_active_sidebar( 'sidebar-1');
		$sbR = is_active_sidebar( 'sidebar-2');
	// orden de columnas.	
		$cssMain = 'col-md-6 order-md-2';
		$cssLeft = ' col-md-3 order-md-1';
		$cssRight = ' col-md-3 order-md-3';	
	// aparicion de columnas
		if( $sbL && !$sbR ){
			$cssMain = 'col-md-9 order-md-2';
			$cssLeft = ' col-md-3 order-md-1';
		} elseif ( !$sbL && $sbR ){
			$cssMain = 'col-md-9';
			$cssRight = ' col-md-3';	
		}
	}	
// imprimir
	if ($css == 'main') echo $cssMain;
	if ($css == 'left') echo $cssLeft;
	if ($css == 'right') echo $cssRight;
}

/* Vista de columnas | Columns view */

function viewCols($tag){
	if ( is_single() || is_page() || is_search() ) return;

	$colSet = get_theme_mod('ekiline_Columns'); 
	$colContain = ( $colSet == 4 ) ? 'card-columns' : 'row' ;

	if ($colSet > 0){
		if ($tag == 'open') echo '<div id="viewcolumns" class="'.$colContain.'">';
		if ($tag == 'close') echo '</div><!-- #viewcolumns -->'; 
	}
}

function viewColsFilter($classes) {
	$colSet = get_theme_mod('ekiline_Columns'); 
	$colView = '';
	
	switch ($colSet) {
		case 1:
			$colView = 'col-md-6';
			break;
		case 2:
			$colView = 'col-md-4';
			break;
		case 3:
			$colView = 'col-md-3';
			break;
		case 4:
			$colView = 'card';
			break;
	}	
	
	if ( is_single() || is_page() || is_search() ) {
		$colView = '';
	}

	$classes[] = $colView;
    return $classes;
}

add_filter('post_class', 'viewColsFilter');

/**
 * Colores dinamicos: Customizer
 * functions #159 localize script = ekiline_themeColors().
 **/

function ekiline_themeColors(){
 	 	 	
	$colores = array(
		//pagina
	   'fondo' => get_option('back_color','#ffffff'),
	   'texto' => get_option('text_color','#333333'),
	   'main' => get_option('main_color','#f8f9fa'),
	   //navbar
	   'menu' => get_option('menu_color','#343a40'),
	   //footer
	   'footer' => get_option('footer_color','#343a40'),
	   'ftxt' => get_option('ftext_color','#ffffff'),
	   'flinks' => get_option('flinks_color','#007bff'),
	   //footer-bar
	   'fbar' => get_option('fbar_color','#6c757d'),
	   'fbartxt' => get_option('fbartxt_color','#ffffff'),
	   'fbarlks' => get_option('fbarlks_color','#007bff'),
	   //bootstrap
	   'b4primary' => get_option('b4_primary','#007bff'),
	   'b4secondary' => get_option('b4_secondary','#6c757d'),
	   'b4success' => get_option('b4_success','#28a745'),
	   'b4danger' => get_option('b4_danger','#dc3545'),
	   'b4warning' => get_option('b4_warning','#ffc107'),
	   'b4info' => get_option('b4_info','#17a2b8'),
	   'b4light' => get_option('b4_light','#f8f9fa'),
	   'b4dark' => get_option('b4_dark','#343a40')
   );
   return $colores;
} 

/*
 * Funciones complementarias para el marcado HTML.
 * HTML Markup complementary functions.
 */



/* Reemplazar el marcado para el enlace de leer más */

function overrideReadMoreLink(){
	return '<a class="more-link" href="' . get_permalink() . '" aria-label="' . sprintf( esc_html__( 'Continue reading %s', 'ekiline' ), wp_strip_all_tags( get_the_title() ) ) . '">'. __( 'Read more', 'ekiline') .'</a>';
}
add_filter( 'the_content_more_link', 'overrideReadMoreLink' );

/* Personalizar el titulo en las paginas de archivo */

function my_theme_archive_title( $title ) {
	if ( is_single() || is_page() ) return;
    // if ( is_category() ) {
    //     $title = single_cat_title( '', false );
    // } elseif ( is_tag() ) {
    //     $title = single_tag_title( '', false );
    // } elseif ( is_author() ) {
    //     $title = '<span class="vcard">' . get_the_author() . '</span>';
    // } elseif ( is_post_type_archive() ) {
    //     $title = post_type_archive_title( '', false );
    // } elseif ( is_tax() ) {
    //     $title = single_term_title( '', false );
    // } elseif ( is_home() ) {
    //     $title = get_bloginfo( 'name' );
	// }
	if ( is_home() ) {
		$title = get_bloginfo( 'name' );
	}  
    return $title;
}
 
add_filter( 'get_the_archive_title', 'my_theme_archive_title' );

 /* Widgets en footer */

function ekiline_countWidgets( $widgetZone ){

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
 * Tema: 
 * Textos como variables.
 **/
 
function ekiline_notes($text) {
	$item = ''; 	
	switch ($text) {
		case 'copyright':
			$item = sprintf( esc_html__( '&copy; Copyright %1$s.', 'ekiline' ), esc_attr( date('Y') . ' ' . get_bloginfo( 'name', 'display' ) ) );
			$item .= '&nbsp;';
			$item .= sprintf( esc_html__( 'Proudly powered by %1$s and %2$s.', 'ekiline' ),'<a href="'.__('https://wordpress.org/','ekiline').'" target="_blank">WordPress</a>','<a href="'.__('http://ekiline.com','ekiline').'" target="_blank">Ekiline</a>' );
		break;
	}	
    return $item;
}

/**
 * Tema: Obtener un id.
 **/
 
function ekiline_post_id(){
	$itemId = get_post_type() . '-' . get_the_ID();; 	
    return $itemId;
}

/**
 * Tema: Manipular el thumbnail
 * https://developer.wordpress.org/reference/functions/the_post_thumbnail/
 **/
function ekiline_thumbnail(){
	if ( !has_post_thumbnail() ) return;
	if ( is_single() || is_page() ) return;
	// tamaño de thumbnail	
	$thumbSize = ( is_search() ) ? 'thumbnail' : 'medium' ;
	// clase css varia por tipo de contenido.
	$imgClass = ( get_theme_mod('ekiline_Columns') == 4 ) ? 'card-img-top' : 'img-thumbnail' ;

	return the_post_thumbnail( $thumbSize, array( 'class' => $imgClass ) );
}

	/**
	 * Link all post thumbnails to the post permalink.
	 */
	function ekiline_link_thumbnail( $html, $post_id, $post_image_id ) {
		if ( is_single() ) return $html;
		// si es search, se añade una clase 
		$thumbClass = ( is_search() ) ? ' class="float-md-left pr-2"' : '' ;

		$html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '"' . $thumbClass . '>' . $html . '</a>';	
		return $html;
	}
	add_filter( 'post_thumbnail_html', 'ekiline_link_thumbnail', 10, 3 );



/**
 * Manipular el título
 * https://developer.wordpress.org/reference/functions/the_title_attribute/
 */

function ekiline_link_title( $title ) {

	$tagClass = ( get_theme_mod('ekiline_Columns') == 4 ) ? 'entry-title card-title' : 'entry-title' ;

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
 * Tema: 
 * Personalizar el formulario de busqueda
 * Override search form HTML
 **/
 
function ekiline_search_form( $form ) {
    
    $form = '<form role="search" method="get" id="searchform" class="searchform my-2" action="' . home_url( '/' ) . '" >
                <label class="screen-reader-text" for="s">' . esc_html__( 'Search Results for: %s', 'ekiline' ) . '</label>
                <div class="input-group">
                    <input class="form-control" type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_html__( 'Search Results for:', 'ekiline' ) . '"/>
                    <span class="input-group-append"><button class="btn btn-secondary" type="submit" id="searchsubmit"><i class="fa fa-search"></i> '. esc_attr__( 'Search', 'ekiline' ) .'</button></span>
                </div>
            </form>';

    return $form;
}
add_filter( 'get_search_form', 'ekiline_search_form' );


/* Tema: Personalizar el formulario de proteccion de lectura. */

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
* Expirar la sesion
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
 * Tema: 
 * Paginacion page & singles & archive
 * https://codex.wordpress.org/Next_and_Previous_Links
 **/

function ekiline_pages_navigation(){

	if ( is_front_page() ) return;	

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


	/**
	 * Paginacion para listados
	 * @link https://codex.wordpress.org/Function_Reference/paginate_links
	 **/

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



