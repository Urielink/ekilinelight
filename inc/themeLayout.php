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
function ekiline_widthControl() {
	$container = 'container';
	$fluid     = '-fluid';

	if ( is_front_page() || is_home() ) {
		$container .= ( true === get_theme_mod( 'ekiline_anchoHome' ) ) ? $fluid : '';
	}
	if ( is_archive() || is_category() ) {
		$container .= ( true === get_theme_mod( 'ekiline_anchoArchive' ) ) ? $fluid : '';
	}
	if ( is_singular() && ! is_front_page() ) {
		$container .= ( true === get_theme_mod( 'ekiline_anchoSingle' ) ) ? $fluid : '';
	}

	return $container;
}

/*
* Layout sin sidebars | No sidebars layout
*/
function viewSbarFilter( $wsbCtl ) {

	$opt = '';

	if ( is_front_page() || is_home() ) {
		$opt = get_theme_mod( 'ekiline_disableSbHome' );
	}

	if ( is_archive() || is_category() ) {
		$opt = get_theme_mod( 'ekiline_disableSbArchive' );
	}

	if ( is_singular() && ! is_front_page() ) {
		$opt = get_theme_mod( 'ekiline_disableSbSingle' );
	}

	switch ( $opt ) {
		case 1:
			unset( $wsbCtl['sidebar-1'] );
			break;
		case 2:
			unset( $wsbCtl['sidebar-2'] );
			break;
		case 3:
			unset( $wsbCtl['sidebar-1'] );
			unset( $wsbCtl['sidebar-2'] );
			break;
	}

	return $wsbCtl;

}
add_filter( 'sidebars_widgets', 'viewSbarFilter' );


/*
* 1) Orden de columnas | Columns order
* agregar contenedor a index.php
*/
function ekiline_main_columns( $tag ) {
	if ( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) ) {
		return;
	}
	// En caso de existir barras laterales agregar envoltorio
	if ( $tag === 'open' ) {
		echo '<div id="maincolumns" class="row mx-0 ' . esc_attr( ekiline_widthControl() ) . ' mx-auto px-0">';
	}
	if ( $tag === 'close' ) {
		echo '</div><!-- #maincolumns -->';
	}
}
/*
* 2) Agregar clases CSS a cada columna index.php y sidebar.php
*/
function orderCols( $css ) {
	$cssMain = ekiline_widthControl();//'container ';
	if ( is_active_sidebar( 'sidebar-1' ) || is_active_sidebar( 'sidebar-2' ) ) {
		// sidebars.
		$sbL = is_active_sidebar( 'sidebar-1' );
		$sbR = is_active_sidebar( 'sidebar-2' );
		// orden de columnas.
		$cssMain  = 'col-md-6 order-md-2';
		$cssLeft  = ' col-md-3 order-md-1';
		$cssRight = ' col-md-3 order-md-3';
		// aparicion de columnas
		if ( $sbL && ! $sbR ) {
			$cssMain = 'col-md-9 order-md-2';
			$cssLeft = ' col-md-3 order-md-1';
		} elseif ( ! $sbL && $sbR ) {
			$cssMain  = 'col-md-9';
			$cssRight = ' col-md-3';
		}
	}
	// imprimir
	if ( $css === 'main' ) {
		echo esc_attr( $cssMain );
	}
	if ( $css === 'left' ) {
		echo esc_attr( $cssLeft );
	}
	if ( $css === 'right' ) {
		echo esc_attr( $cssRight );
	}
}

/*
* 1) Vista de columnas | Columns view
* // loop_start, loop_end, podria romper la vista.
*/
function ekiline_show_columns( $tag ) {
	if ( is_singular() ) {
		return;
	}

	$colSet     = get_theme_mod( 'ekiline_Columns' );
	$colContain = ( $colSet === '4' ) ? 'card-columns' : 'row';

	if ( $colSet > '0' ) {
		if ( $tag === 'open' ) {
			echo '<div id="viewcolumns" class="' . esc_attr( $colContain ) . '">';
		}
		if ( $tag === 'close' ) {
			echo '</div><!-- #viewcolumns -->';
		}
	}
}
/*
* 2) Agregar clase a cada post para complementar la vista.
*/
function ekiline_show_columns_item( $classes ) {

	if ( is_singular() ) {
		return $classes;
	}

	$colSet  = get_theme_mod( 'ekiline_Columns' );
	$colView = '';

	switch ( $colSet ) {
		case '1':
			$colView = 'col-md-6';
			break;
		case '2':
			$colView = 'col-md-4';
			break;
		case '3':
			$colView = 'col-md-3';
			break;
		case '4':
			$colView = 'card';
			break;
	}

	$classes[] = $colView;
	return $classes;
}

add_filter( 'post_class', 'ekiline_show_columns_item' );
