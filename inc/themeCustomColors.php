<?php
/**
 * Custom Color CSS Bootstrap feature
 *
 * @package ekiline
 */

 /**
 * 1. Customizer, controles para cada color.
 */

function ekiline_custom_color_controls( $wp_customize ) {

    // Colores, reemplazar el controlador de color de fondo.
    $wp_customize->remove_control('background_color');	// se remueve el controlador.

    // Colores, agregar un panel con subsecciones: 
    // https://developer.wordpress.org/themes/customize-api/customizer-objects/
    $wp_customize->add_panel(
        'ekiline_ThemeColors', array(
            'title' => __( 'Colors', 'ekiline' ),
            'description' => __( 'Customize the Bootstrap color palette and use the CSS classes set in your design. Or adjust the colors per item.', 'ekiline' ),
            'priority' => 30,
        ) 
    );

        $wp_customize->add_section(
            'colors' , array(
                'title' => __( 'Customize the Bootstrap color palette', 'ekiline' ),
                'panel' => 'ekiline_ThemeColors',
            ) 
        );

        $wp_customize->add_section(
            'colors_extended' , array(
                'title' => __( 'Customize colors per item', 'ekiline' ),
                'panel' => 'ekiline_ThemeColors',
            ) 
        );

    
// Colores base
    $colors = array();
        //pagina
        $colors[] = array( 'slug'=>'back_color', 'default' => '#ffffff', 'label' => __( 'Background color and text', 'ekiline' ), 'description' => '', 'priority' => 20, 'section'=>'colors_extended' );
        $colors[] = array( 'slug'=>'text_color', 'default' => '#333333', 'label' => '', 'description' => '', 'priority' => 20, 'section'=>'colors_extended' );
        // contenedor main
        $colors[] = array( 'slug'=>'main_color', 'default' => '#f8f9fa', 'label' => '', 'description' => __( 'Color on main container', 'ekiline' ), 'priority' => 20, 'section'=>'colors_extended' );
        //navbar
        $colors[] = array( 'slug'=>'menu_color', 'default' => '#343a40', 'label' => __( 'Navbar background', 'ekiline' ), 'description' => '', 'priority' => 30, 'section'=>'colors_extended' );
        //footer-bar
        $colors[] = array( 'slug'=>'fbar_color', 'default' => '#6c757d', 'label' => __( 'Bottom bar', 'ekiline' ), 'description' => '', 'priority' => 40, 'section'=>'colors_extended' );
        $colors[] = array( 'slug'=>'fbartxt_color', 'default' => '#ffffff', 'label' => '', 'description' => '', 'priority' => 40, 'section'=>'colors_extended' );
        $colors[] = array( 'slug'=>'fbarlks_color', 'default' => '#007bff', 'label' => '', 'description' => '', 'priority' => 40, 'section'=>'colors_extended' );
        //footer
        $colors[] = array( 'slug'=>'footer_color', 'default' => '#343a40', 'label' => __( 'Footer', 'ekiline' ), 'description' => '', 'priority' => 40, 'section'=>'colors_extended' );
        $colors[] = array( 'slug'=>'ftext_color', 'default' => '#ffffff', 'label' => '', 'description' => '', 'priority' => 40, 'section'=>'colors_extended' );
        $colors[] = array( 'slug'=>'flinks_color', 'default' => '#007bff', 'label' => '', 'description' => '', 'priority' => 40, 'section'=>'colors_extended' );
        //bootstrap
        $colors[] = array( 'slug'=>'b4_primary', 'default' => '#007bff', 'label' => '', 'description' => __( 'Change Bootstrap color palette and use default classes', 'ekiline' ) . __('<br><code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-primary</code>','ekiline'), 'priority' => 10, 'section'=>'colors' );
        $colors[] = array( 'slug'=>'b4_secondary', 'default' => '#6c757d', 'label' => '', 'description' => __('<code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-secondary</code>', 'ekiline'), 'priority' => 10, 'section'=>'colors' );
        $colors[] = array( 'slug'=>'b4_success', 'default' => '#28a745', 'label' => '', 'description' => __('<code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-success</code>', 'ekiline'), 'priority' => 10, 'section'=>'colors' );
        $colors[] = array( 'slug'=>'b4_danger', 'default' => '#dc3545', 'label' => '', 'description' => __('<code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-danger</code>', 'ekiline'), 'priority' => 10, 'section'=>'colors' );
        $colors[] = array( 'slug'=>'b4_warning', 'default' => '#ffc107', 'label' => '', 'description' => __('<code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-warning</code>', 'ekiline'), 'priority' => 10, 'section'=>'colors' );
        $colors[] = array( 'slug'=>'b4_info', 'default' => '#17a2b8', 'label' => '', 'description' => __('<code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-info</code>', 'ekiline'), 'priority' => 10, 'section'=>'colors' );
        $colors[] = array( 'slug'=>'b4_light', 'default' => '#f8f9fa', 'label' => '', 'description' => __('<code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-light</code>', 'ekiline'), 'priority' => 10, 'section'=>'colors' );
        $colors[] = array( 'slug'=>'b4_dark', 'default' => '#343a40', 'label' => '', 'description' => __('<code style="float: right;margin: 6px 4px 0px 0px;width: 90px;">*-dark</code>', 'ekiline'), 'priority' => 10, 'section'=>'colors' );	

    	
    foreach($colors as $color){
        // add settings
        $wp_customize->add_setting(
        		$color['slug'], array( 
        				'default' => $color['default'], 
        				'type' => 'option', 
        				'capability' => 'edit_theme_options',
        				'sanitize_callback' => 'sanitize_hex_color',
                        'transport'   => 'refresh'
				)
		);

        // add controls
        $wp_customize->add_control(
        		new WP_Customize_Color_Control(
        				$wp_customize, $color['slug'], 
        				array( 'label' => $color['label'], 
                				'description' => $color['description'], 
        						'section' => $color['section'], 
                                'settings' => $color['slug'],
                                'priority' => $color['priority']
						) ) 
		);
    }
    
    // Bootstrap inverse menu
    $wp_customize->add_setting( 
        'ekiline_inversemenu', array(
    				'default' => '',
                    'sanitize_callback' => 'ekiline_sanitize_checkbox',
        )
    );
        
        $wp_customize->add_control(
            'ekiline_inversemenu', array(
                        'label'          => __( 'Use light navbar', 'ekiline' ),
                        'description'    => '',
                        'section'        => 'colors_extended',
                        'settings'       => 'ekiline_inversemenu',
                        'type'           => 'checkbox',
                        'priority'       => 30,
            )
        );  
    

    //Guardar variabe CSS 
    $wp_customize->add_setting( 
        'ekiline_textarea_css', array(
            'capability' => 'edit_theme_options',
            'default' => '',
            'sanitize_callback' => 'wp_strip_all_tags',
            'transport' => 'refresh',
          ) 
    );
        
        $wp_customize->add_control( 
            'ekiline_textarea_css', array(
                'type' => 'hidden',
                'section' => 'colors_extended',
            ) 
        );    
	
}
add_action('customize_register', 'ekiline_custom_color_controls');

/**
 * 2. Regsitro de script en personalizador.
 */
function tuts_customize_control_js() {
    // wp_enqueue_script( 'tuts_customizer_control', get_template_directory_uri() . '/assets/js/ekiline-themecustomizer.js', array('jquery'), null, true );
    wp_enqueue_script( 'tuts_customizer_control', get_template_directory_uri() . '/assets/js/ekiline-themecustomizer.min.js', array('jquery'), null, true );
}
add_action( 'customize_controls_enqueue_scripts', 'tuts_customize_control_js' ); 

/**
 * 3. Imprimir estilo CSS.
 */
function ekiline_styles_inline() {

    $ekilineTheme = '';
    $ekilineTheme .= get_theme_mod( 'ekiline_textarea_css' );

    $ekilineTheme .= ( get_option('main_color') != '#f8f9fa' ) ? '#primary{background-color:'. get_option('main_color') .';}' : '' ;
    $ekilineTheme .= ( get_option('menu_color') != '#343a40' ) ? '#primarySiteNavigation.navbar{background-color:'. get_option('menu_color') .'!important;}' : '' ;

    if( get_option('fbar_color') != '#6c757d' ||  get_option('fbartxt_color') != '#ffffff'){
        $fbBk = ( get_option('fbar_color') != '#6c757d' ) ? 'background-color:'. get_option('fbar_color') .'!important;' : '' ;
        $fbTc = ( get_option('fbartxt_color') != '#ffffff' ) ? 'color:'. get_option('fbartxt_color') .'!important;' : '' ;
            $ekilineTheme .= '.footer-bar{'. $fbBk . $fbTc .'}';
    }

    $ekilineTheme .= ( get_option('fbarlks_color') != '#007bff' ) ? '.footer-bar a{color:'. get_option('fbarlks_color') .'!important}' : '' ;

    if( get_option('footer_color') != '#343a40' ||  get_option('ftext_color') != '#ffffff' ){
        $fooBk = ( get_option('footer_color') != '#343a40' ) ? 'background-color:'. get_option('footer_color') .'!important;' : '' ;
        $fooTc = ( get_option('ftext_color') != '#ffffff' ) ? 'color:'. get_option('ftext_color') .'!important;' : '' ;
            $ekilineTheme .= '.site-footer{'. $fooBk . $fooTc .'}';
    }

    $ekilineTheme .= ( get_option('flinks_color') != '#007bff' ) ? '.site-footer a{color:'. get_option('flinks_color') .'!important}' : '' ;
    
    // echo '<style id="ekiline-theme">' . $ekilineTheme .'</style>'. "\n";
    return $ekilineTheme;

}
// add_action( 'wp_head', 'ekiline_styles_inline', 100);

/* 
 * Andar estilos css en linea
 * https://developer.wordpress.org/reference/functions/wp_add_inline_style/
 */
function wpdocs_styles_method() {

    // wp_enqueue_style( 'layout', get_template_directory_uri() . '/assets/css/ekiline.css', array(), '1.0', 'all' );	
    
    // posibles manejadores: bootstrap-4, layout o ekiline-style
    wp_add_inline_style( 'ekiline-style', ekiline_styles_inline() );

}
add_action( 'wp_enqueue_scripts', 'wpdocs_styles_method' );