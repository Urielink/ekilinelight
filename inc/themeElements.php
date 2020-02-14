<?php
/**
 * Objetos del tema || Theme objects
 *
 * @package ekiline
 */

/**
 * Orden de columnas, semantica
 * Columns order, semantics
 **/
function mainCols($tag){
	if (!is_active_sidebar( 'sidebar-1') && !is_active_sidebar( 'sidebar-2')) return;
	// ampliar esta funcion en customizer
	$widthClass = 'container ';
	if ($tag == 'open'){ echo '<div id="maincolumns" class="row mx-0 ' . $widthClass . 'mx-auto px-0">';
	} elseif ($tag == 'close'){ echo '</div><!-- #maincolumns -->'; }
}
function orderCols($css){
	// if (!is_active_sidebar( 'sidebar-1') && !is_active_sidebar( 'sidebar-2')) return;
	$cssMain = 'container';
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
	    'fondo' => get_option('back_color','#ffffff'),
	    'texto' => get_option('text_color','#333333'),
	    'b4primary' => get_option('b4_primary','#007bff'),
	    'b4secondary' => get_option('b4_secondary','#6c757d'),
	    'b4success' => get_option('b4_success','#28a745'),
	    'b4danger' => get_option('b4_danger','#dc3545'),
	    'b4warning' => get_option('b4_warning','#ffc107'),
	    'b4info' => get_option('b4_info','#17a2b8'),
	    'b4light' => get_option('b4_light','#f8f9fa'),
	    'b4dark' => get_option('b4_dark','#343a40')
		// estos valores se aplican independientes a bootstrap.
	    // 'enlaces' => get_option('links_color','#007bff'),
	    // 'footer' => get_option('footer_color','#eeeeee'),
	    // 'ftxt' => get_option('ftext_color','#333333'),
	    // 'menu' => get_option('menu_color'),
	    // 'mgradient' => get_option('menu_gradient')
    );
	return $colores;
 } 
