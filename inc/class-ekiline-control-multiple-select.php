<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package ekiline
 */

/**
 * Contenido de widget
 *
 * @param string $wp_customize setup control.
 */
function ekiline_featured_categories( $wp_customize ) {
	// Front page categories.
	$wp_customize->add_setting(
		'ekiline_featuredcategories',
		array(
			'default'           => 0,
			'transport'         => 'refresh',
			'sanitize_callback' => 'ekiline_sanitize_multipleselect',
		)
	);

	$wp_customize->add_control(
		new Ekiline_Control_Multiple_Select(
			$wp_customize,
			'ekiline_featuredcategories',
			array(
				'settings' => 'ekiline_featuredcategories',
				'label'    => __( 'Featured category', 'ekiline' ),
				'section'  => 'static_front_page',
				'type'     => 'multiple-select',
				'choices'  => ekiline_list_categories(),
			)
		)
	);
}
add_action( 'customize_register', 'ekiline_featured_categories' );


/**
 * Customizer: Funcion para obtener los ids de categorias y la cantidad de publicaicones // get categories IDs.
 */
function ekiline_list_categories() {
	$cats    = array();
	$cats[0] = __( 'All', 'ekiline' );
	foreach ( get_categories() as $categories => $category ) {
		$cats[ $category->term_id ] = $category->name . ' ( ' . $category->count . ' )';
	}
	return $cats;
}

/**
 * Customizer: Función para elegir categorías predeterminadas // Frontpage featured categories.
 *
 * @param string $query retrieve categories.
 */
function ekiline_frontpage_featured( $query ) {

	$seleccion = get_theme_mod( 'ekiline_featuredcategories' );
	// crear un string con lo seleccionado.
	$str = 0;
	// Al instalar el tema por primera vez reacciona la falta de validar el campo por eso este if.
	if ( $seleccion ) {
		$str = array();
		$str = implode( ', ', $seleccion );
	}

	if ( $query->is_home() && $query->is_main_query() ) {
		$query->set( 'cat', $str );
	}

}
add_action( 'pre_get_posts', 'ekiline_frontpage_featured' );

/***
 * Nuevo ejercicio,
 * 1) extender la clase de selectores
 * 2) Solo se debe definir el tipo de formulario en ekiline_theme_customizer
 * 3) se crea el arreglo para desplegar las categories
 * https://stackoverflow.com/questions/38481936/multi-select-category-wordpress-customizer-control
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	/**
	 * Esta clse permite mostrar y seleccionar categorias en la pagina blog.
	 */
	class Ekiline_Control_Multiple_Select extends WP_Customize_Control {

		/**
		 * Establecer el tipo del control
		 *
		 * @var $type
		 */
		public $type = 'multiple-select';
		/**
		 * Genera el contenido
		 */
		public function render_content() {
			if ( empty( $this->choices ) ) {
				return;
			}
			?>

			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?> multiple="multiple" size="10">
					<?php
					foreach ( $this->choices as $value => $label ) {
						$thevalue = $this->value();
						$selected = ( ! empty( $thevalue ) && in_array( $value, $thevalue, true ) ) ? selected( 1, 1, false ) : '';
						echo '<option value="' . esc_attr( $value ) . '"' . esc_attr( $selected ) . '>' . esc_attr( $label ) . '</option>';
					}
					?>
				</select>
			</label>

			<?php
		}
	}
}

/**
 * Validar un multi-select
 *
 * @param string $input data Sanitization.
 */
function ekiline_sanitize_multipleselect( $input ) {
	$valid = ekiline_list_categories();
	foreach ( $input as $value ) {
		if ( ! array_key_exists( $value, $valid ) ) {
			return;
		}
	}
	return $input;
}
