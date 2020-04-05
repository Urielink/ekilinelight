<?php
/**
 * Orden del tema || Theme Layout
 *
 * Funciones complementarias para el personalizador.
 * Customizer complementary functions.
 *  
 * @package ekiline
 */


/**  
 * Ancho de layout | Layout width 
 */

function ekiline_widthControl(){
	$widthClass = 'container';
	$widthClassAdd = '-fluid';
	
	if( is_front_page() || is_home() ){
		$widthClass .= ( true === get_theme_mod('ekiline_anchoHome') ) ? $widthClassAdd : '' ;
	}
	if( is_archive() || is_category() ){
		$widthClass .= ( true === get_theme_mod('ekiline_anchoArchive') ) ? $widthClassAdd : '' ;
	}
	if( is_singular() && !is_front_page() ){
		$widthClass .= ( true === get_theme_mod('ekiline_anchoSingle') ) ? $widthClassAdd : '' ;
	}

	// Agregar color de fondo a la lectura en caso de ocupar imagen de fondo (customizer)
	$widthClass .= ( get_option('main_color') != '#f8f9fa' ) ? ' bg-main' : '' ;

	return $widthClass;
}

/* 
 * Layout sin sidebars | No sidebars layout 
 */

function viewSbarFilter($wsbCtl) {

	$opt = '';

	if( is_front_page() || is_home() ){
		$opt = get_theme_mod('ekiline_disableSbHome' );
	}

	if( is_archive() || is_category() ){
		$opt = get_theme_mod('ekiline_disableSbArchive' );
	}

	if( is_singular() && !is_front_page() ){
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


/* 
 * Orden de columnas | Columns order 
 */

function ekiline_main_columns($tag){
	if (!is_active_sidebar( 'sidebar-1') && !is_active_sidebar( 'sidebar-2')) return;
	// En caso de existir barras laterales agregar envoltorio
	if ($tag == 'open') echo '<div id="maincolumns" class="row mx-0 ' . ekiline_widthControl() . ' mx-auto px-0">';
	if ($tag == 'close') echo '</div><!-- #maincolumns -->'; 
}

function orderCols($css){
	$cssMain = ekiline_widthControl();//'container ';
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

/* 
 * Vista de columnas | Columns view 
 */

function ekiline_show_columns($tag){
	if ( is_singular() || is_search() ) return;

	$colSet = get_theme_mod('ekiline_Columns'); 
	$colContain = ( $colSet == 4 ) ? 'card-columns' : 'row' ;

	if ($colSet > 0){
		if ($tag == 'open') echo '<div id="viewcolumns" class="'.$colContain.'">';
		if ($tag == 'close') echo '</div><!-- #viewcolumns -->'; 
	}
}

	function ekiline_show_columns_item($classes) {

		if ( is_singular() || is_search() ) return $classes;
		
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
		
		$classes[] = $colView;
		return $classes;
	}

	add_filter('post_class', 'ekiline_show_columns_item');

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

