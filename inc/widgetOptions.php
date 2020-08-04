<?php
/**
* Custom functions that act independently of the theme templates
*
* Eventually, some of the functionality here could be replaced by core features
*
* @package ekiline
*/

/**
* Extender funciones de widget, añadir CSS por cada item
* Extend widget functions
* @link http://wordpress.stackexchange.com/questions/134539/how-to-add-custom-fields-to-settings-in-widget-options-for-all-registered-widget
* @link https://github.com/lowhow/Whitecoat/blob/master/whitecoat2/functions-theme.php
*/

function ekiline_in_widget_form( $t,$return,$instance ) {
	$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'css_style' => '' ) );
	if ( !isset( $instance['css_style'] ) ) $instance['css_style'] = null;
	?>
	<p>
		<label for="<?php echo esc_attr( $t->get_field_id( 'css_style' ) ); ?>">
			<?php esc_html_e( 'CSS custom class (Ekiline)', 'ekiline' ) ?>
		</label>
		<input
			class="widefat" type="text"
			id="<?php echo esc_attr( $t->get_field_id( 'css_style' ) ); ?>"
			name="<?php echo esc_attr( $t->get_field_name( 'css_style' ) ); ?>"
			value="<?php echo esc_attr( $instance['css_style'] ); ?>" />
	</p>
	<?php
	$retrun = null;
	return array( $t,$return,$instance );
}

function ekiline_in_widget_form_update( $instance, $new_instance, $old_instance ) {
	$instance['css_style'] = strip_tags( $new_instance['css_style'] );
	return $instance;
}

function ekiline_dynamic_sidebar_params( $params ) {
	global $wp_registered_widgets;
	$widget_id = $params[0]['widget_id'];
	$widget_obj = $wp_registered_widgets[$widget_id];
	$widget_opt = get_option( $widget_obj['callback'][0]->option_name );
	$widget_num = $widget_obj['params'][0]['number'];
	// $css_style = '';

	if( isset( $widget_opt[$widget_num]['css_style'] ) ) {
		if( $widget_opt[$widget_num]['css_style'] == '' ) {
			$css_style = '';
		} else {
			$css_style = $widget_opt[$widget_num]['css_style'] . ' ';
		}
	} else {
		$css_style = '';
	}

	$params[0]['before_widget'] = preg_replace( '/class="/', 'class="'.$css_style,  $params[0]['before_widget'], 1 );

	return $params;
}

// callbacks y actualización

//Agregar el input: prioridad 5 y 3 parametros
add_action( 'in_widget_form', 'ekiline_in_widget_form',5,3 );
//Callback para actualización de parametros
add_filter( 'widget_update_callback', 'ekiline_in_widget_form_update',5,3 );
//Agregar los CSS con reemplazo.
add_filter( 'dynamic_sidebar_params', 'ekiline_dynamic_sidebar_params' );


/*
* Mejor es agregar un filtro de selección de presentación del widget.
* http://themefoundation.com/custom-widget-options/
* https://wordpress.stackexchange.com/questions/134539/how-to-add-custom-fields-to-settings-in-widget-options-for-all-registered-widget
* https://stackoverflow.com/questions/41113890/retrieve-value-widget-form-option-wordpress
*/

function ekiline_widgetView( $widget, $return, $instance ) {

	$instance = wp_parse_args( (array) $instance, array( 'viewFormat' => 'none' ) );
	if ( !isset( $instance['viewFormat'] ) ) $instance['viewFormat'] = null;

	?>
	<p>
		<label for="<?php echo esc_attr( $widget->get_field_id( 'viewFormat' ) ); ?>"><?php esc_html_e( 'Format (Ekiline)', 'ekiline' ) ?></label>

		<select id="<?php echo esc_attr( $widget->get_field_id( 'viewFormat' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'viewFormat' ) ); ?>">
			<option <?php selected( $instance['viewFormat'], 'none' ); ?> value="none"><?php esc_html_e( 'Default', 'ekiline' ) ?></option>
			<option <?php selected( $instance['viewFormat'], 'dropdown' ); ?>value="dropdown"><?php esc_html_e( 'Dropdown', 'ekiline' ) ?></option>
			<option <?php selected( $instance['viewFormat'], 'modal' ); ?> value="modal"><?php esc_html_e( 'Modal', 'ekiline' ) ?></option>
		</select>
	</p>
	<?php
}
add_action( 'in_widget_form', 'ekiline_widgetView',5,3 );

function ekiline_widgetViewSave( $instance, $new_instance, $old_instance ) {

	$instance['viewFormat'] = $new_instance['viewFormat'];
	return $instance;

}
add_filter( 'widget_update_callback', 'ekiline_widgetViewSave',5,3 );

function ekiline_widgetShow( $params ) {

	global $wp_registered_widgets;
	$widget_id = $params[0]['widget_id'];
	$widget_obj = $wp_registered_widgets[$widget_id];
	$widget_opt = get_option( $widget_obj['callback'][0]->option_name );
	$widget_num = $widget_obj['params'][0]['number'];

	// variables para modificar la estructura del widget
	$viewFormat = '';
	$befWdg = $params[0]['before_widget'];
	$befTtl = $params[0]['before_title'];
	$aftTtl = $params[0]['after_title'];
	$aftWdg = $params[0]['after_widget'];

	$widgetTitle = '';

	if( isset( $widget_opt[$widget_num]['title'] ) ) {
		if( $widget_opt[$widget_num]['title'] != '' ) {
			$widgetTitle = $widget_opt[$widget_num]['title'] ;
		}
	}


	if( isset( $widget_opt[$widget_num]['viewFormat'] ) ) {

		$viewFormat = $widget_opt[$widget_num]['viewFormat'];

		if( $viewFormat == 'dropdown' ) {

			$widgetTitle = ( $widgetTitle != '' ) ? '<h6 class="dropdown-header">' . $widgetTitle . '</h6>' : '' ;

			$befWdg = preg_replace( '/class="/', 'class="' . $viewFormat . ' ',  $params[0]['before_widget'], 1 );
			$befTtl = '<button class="btn btn-secondary btn-block dropdown-toggle" type="button" data-toggle="dropdown">';
			$aftTtl = '</button><div class="dropdown-menu">' . $widgetTitle;
			$aftWdg = '</div>' . $aftWdg;

		} elseif( $viewFormat == 'modal' ) {

			$widgetTitle = ( $widgetTitle != '' ) ? '<h5>' . $widgetTitle . '</h5>' : '' ;

			$befWdg = $befWdg;
			$befTtl = '<button class="btn btn-primary btn-block" type="button" data-toggle="modal" data-target="#wdgModal-'.$widget_id.'">';
			$aftTtl = '</button><div class="modal fade" id="wdgModal-'.$widget_id.'">';
				$aftTtl .= '<div class="modal-dialog"><div class="modal-content">';
				$aftTtl .= '<div class="modal-header">' . $widgetTitle . '<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button></div><div class="modal-body">';
			$aftWdg = '</div></div></div></div>' . $aftWdg;

		}

	}
	// Agrega etiquetas
	$params[0]['before_widget'] = $befWdg;
	$params[0]['before_title'] = $befTtl;
	$params[0]['after_title'] = $aftTtl;
	$params[0]['after_widget'] = $aftWdg ;

	return $params;

}
add_filter( 'dynamic_sidebar_params', 'ekiline_widgetShow' );
