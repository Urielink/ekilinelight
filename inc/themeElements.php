<?php
/**
 * Objetos del tema || Theme objects
 *
 * @package ekiline
 */

/**
 * Ancho de layout
 * Layout width
 **/
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

	return $widthClass;
}

/**
 * Ancho de layout sin sidebars
 * Layout width, no sidebars
 * https://chrisblackwell.me/hide-widgets-specific-wordpress-pages/
 **/

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

/**
 * Orden de columnas
 * Columns order
 **/
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

/**
 * Vista de columnas
 * Columns view
 **/
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
 * Reemplazar el marcado para el enlace de leer más.
 */
function overrideReadMoreLink(){
	return '<a class="more-link" href="' . get_permalink() . '" aria-label="' . sprintf( esc_html__( 'Continue reading %s', 'ekiline' ), get_the_title() ) . '">'. __( 'Read more', 'ekiline') .'</a>';
}
add_filter( 'the_content_more_link', 'overrideReadMoreLink' );


/**
 * Paginacion para listados
 * Paginate links
 * @link https://codex.wordpress.org/Function_Reference/paginate_links
 * @link https://brinidesigner.com/wordpress-custom-pagination-for-bootstrap/
 **/

function ekiline_archive_pagination() {
    
    global $wp_query;
    $big = 999999999;
    $pagination = '';
    
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
        $pagination .= '<nav id="page-navigation" class="d-flex justify-content-center w-100" aria-label="Page navigation"><ul class="pagination">';
        
        foreach ($pages as $i => $page) {

            $page = str_replace( 'page-numbers', 'page-link', $page );			
			
            if ($current_page == 1 && $i == 0) {                
                $pagination .= "<li class='page-item active'>$page</li>";                
            } else {                
                if ($current_page != 1 && $current_page == $i) {                    
                    $pagination .= "<li class='page-item active'>$page</li>";                    
                } else {                    
                    $pagination .= "<li class='page-item'>$page</li>";                    
                }
            }
            
        }
        
        $pagination .= '</ul></nav>';
        
    }
    
    echo $pagination;

}

/**
 * Colores dinamicos: Customizer
 * functions #159 localize script = ekiline_themeColors().
 **/

 function ekiline_themeColors(){
 	 	 	
 	$colores = array(
		 //pagina
	    'fondo' => get_option('back_color','#ffffff'),
		'texto' => get_option('text_color','#333333'),
		//navbar
		'menu' => get_option('menu_color','#f8f9fa'),
		//footer
	    'footer' => get_option('footer_color','#343a40'),
	    'ftxt' => get_option('ftext_color','#ffffff'),
		'flinks' => get_option('flinks_color','#007bff'),
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

 /**
 * Widgets en footer
 **/
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