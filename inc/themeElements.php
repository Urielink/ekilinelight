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
	if ($tag == 'open'){ echo '<div id="maincolumns" class="row mx-0 container mx-auto px-0">';
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
 * Colores dinámicos: Customizer
 **/

 function ekiline_themeColors(){

    $texto = get_option('text_color');
    $enlaces = get_option('links_color');
    $footer = get_option('footer_color');
    $ftxt = get_option('ftext_color');
    $menu = get_option('menu_color');
    $mgradient = get_option('menu_gradient');
	
	$colores = array($texto,$enlaces,$menu,$mgradient,$footer,$ftxt);
	$resultado = '';
	
	foreach ($colores as $i => $color) {
		$resultado .= "console.log(\"$color\");";		
	}

	echo "<script>".$resultado."</script>";		


 } 
 
 